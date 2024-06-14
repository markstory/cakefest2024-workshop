<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Enum\MemberRoleEnum;
use ArrayAccess;
use Authentication\IdentityInterface as AuthenticationIdentity;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authorization\AuthorizationServiceInterface;
use Authorization\IdentityInterface as AuthorizationIdentity;
use Authorization\Policy\ResultInterface;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use DateTime;
use InvalidArgumentException;
use RuntimeException;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property bool $email_verified
 * @property string $password
 * @property string|null $name
 * @property \Cake\I18n\DateTime|null $last_active
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $updated
 *
 * @property \App\Model\Entity\OrganizationMember[] $organization_members
 * @property \App\Model\Entity\UserEmail[] $user_emails
 */
class User extends Entity implements AuthenticationIdentity, AuthorizationIdentity
{
    public const PASSWORD_TOKEN_DURATION = '+4 hours';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'email' => true,
        'name' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
        'email_verified',
    ];

    /**
     * @var \Authorization\AuthorizationServiceInterface|null
     */
    protected ?AuthorizationServiceInterface $authorization = null;

    protected function _getAvatarHash()
    {
        if (!$this->email) {
            return null;
        }

        return md5(strtolower($this->email));
    }

    /**
     * Get the organization ids that the current user has membership in.
     *
     * Relies on data from findLogin()
     */
    protected function _getMemberOrganizationIds(): array
    {
        $memberships = $this->organization_members;
        if (empty($memberships)) {
            throw new InvalidArgumentException(
                'Organization memberships not loaded. Use findLogin() to ensure properties are loaded'
            );
        }

        return array_map(fn ($item) => $item->organization_id, $memberships);
    }

    /**
     * Hash password
     *
     * @param string $password
     * @return string|null
     */
    protected function _setPassword(string $password): ?string
    {
        if (mb_strlen($password) > 0) {
            $hash = $this->passwordHasher()->hash($password);

            return $hash ? $hash : null;
        }

        return null;
    }

    public function passwordHasher(): DefaultPasswordHasher
    {
        return new DefaultPasswordHasher();
    }

    /**
     * Create a password reset token.
     *
     * The token will be invalid if:
     *
     * - The user changes their email.
     * - It has been more than 4 hours from creation time.
     *
     * @return string
     */
    public function passwordResetToken(): string
    {
        $emailHash = hash_hmac('sha256', $this->email, Configure::read('Security.emailSalt'));
        // TODO use an option here.
        $expires = new DateTime(static::PASSWORD_TOKEN_DURATION);
        $data = [
            'uid' => $this->id,
            'val' => $emailHash,
            'exp' => $expires->getTimestamp(),
        ];

        return base64_encode(json_encode($data));
    }

    public static function decodePasswordResetToken(string $token): object
    {
        $decoded = base64_decode($token);
        if (empty($decoded)) {
            throw new RuntimeException(__('Invalid password reset token provided.'));
        }
        $data = json_decode($decoded);
        if (!$data || !isset($data->uid, $data->val, $data->exp)) {
            throw new RuntimeException(__('Invalid password reset token provided.'));
        }
        $now = (new DateTime('now'))->getTimestamp();
        if ($data->exp < $now) {
            throw new RuntimeException(__('Expired password reset token provided.'));
        }

        return $data;
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function getIdentifier(): int
    {
        return $this->get('id');
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function can($action, $resource): bool
    {
        if (!$this->authorization) {
            throw new RuntimeException('Cannot check authorization. AuthorizationService has not been set.');
        }

        return $this->authorization->can($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function canResult($action, $resource): ResultInterface
    {
        if (!$this->authorization) {
            throw new RuntimeException('Cannot check authorization. AuthorizationService has not been set.');
        }

        return $this->authorization->canResult($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function applyScope(string $action, mixed $resource, mixed ...$optionalArgs): mixed
    {
        if (!$this->authorization) {
            throw new RuntimeException('Cannot check authorization. AuthorizationService has not been set.');
        }

        return $this->authorization->applyScope($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function getOriginalData(): ArrayAccess|array
    {
        return $this;
    }

    /**
     * Setter to be used by the middleware.
     */
    public function setAuthorization(AuthorizationServiceInterface $service)
    {
        $this->authorization = $service;

        return $this;
    }

    /**
     * Check if the current user has membership in the provided orgId.
     */
    public function isMember(int $organizationId): bool
    {
        return in_array($organizationId, $this->member_organization_ids);
    }

    /**
     * Check if the current user has an owner role in the provided orgId.
     */
    public function isOwner(int $organizationId): bool
    {
        return $this->isRole($organizationId, MemberRoleEnum::Owner);
    }

    /**
     * Check if the current user has an owner role in the provided orgId.
     */
    public function isManager(int $organizationId): bool
    {
        return $this->isRole($organizationId, MemberRoleEnum::Manager);
    }

    /**
     * Check if the current user has an owner role in the provided orgId.
     */
    protected function isRole(int $organizationId, MemberRoleEnum $role): bool
    {
        // TODO this is O(n) it could be O(1)
        foreach ($this->organization_memberships as $membership) {
            if ($membership->organization_id !== $organizationId) {
                continue;
            }

            return $membership->role === $role;
        }

        return false;
    }

    /**
     * Check if the current user has any overlap in teams with the project.
     * Teams that are assigned to a project have read and write access to that project.
     *
     * We could change that access in the future.
     */
    public function isProjectMember(Project $project): bool
    {
        if (empty($project->teams)) {
            throw new InvalidArgumentException('Missing required association `Teams`. Add or update your contain()');
        }
        $projectTeamIds = array_map(fn ($item) => $item->id, $project->teams);
        $organizationId = $project->organization_id;
        foreach ($this->organization_memberships as $membership) {
            if ($membership->organization_id !== $organizationId) {
                continue;
            }

            if (empty($membership->teams)) {
                throw new InvalidArgumentException(
                    "Membership id={$membership->id} was not loaded with its `Teams` association. " .
                    'Add or update your contain().'
                );
            }

            $memberTeamIds = array_map(fn ($item) => $item->id, $membership->teams);
            $overlap = array_intersect($memberTeamIds, $projectTeamIds);

            return count($overlap) > 0;
        }

        return false;
    }

    /**
     * Check if the current user belongs to the provided team.
     *
     * We could change that access in the future.
     */
    public function isTeamMember(Team $team): bool
    {
        $organizationId = $team->organization_id;
        foreach ($this->organization_memberships as $membership) {
            if ($membership->organization_id !== $organizationId) {
                continue;
            }

            if (empty($membership->teams)) {
                throw new InvalidArgumentException(
                    "Membership id={$membership->id} was not loaded with its `Teams` association. " .
                    'Add or update your contain().'
                );
            }

            $memberTeamIds = array_map(fn ($item) => $item->id, $membership->teams);

            return in_array($team->id, $memberTeamIds, true);
        }

        return false;
    }
}

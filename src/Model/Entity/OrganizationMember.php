<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationMember Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property int $user_id
 * @property \App\Model\Enum\MemberRoleEnum $role
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrganizationInvite[] $organization_invites
 * @property \App\Model\Entity\TeamMember[] $team_members
 */
class OrganizationMember extends Entity
{
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
        'organization_id' => true,
        'user_id' => true,
        'role' => true,
        'created' => true,
        'modified' => true,
        'organization' => true,
        'user' => true,
        'organization_invites' => true,
        'team_members' => true,
    ];
}

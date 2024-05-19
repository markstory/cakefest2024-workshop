<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationInvite Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property string $email
 * @property string $role
 * @property string|null $teams
 * @property int|null $organization_member_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\OrganizationMember $organization_member
 */
class OrganizationInvite extends Entity
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
        'email' => true,
        'role' => true,
        'teams' => true,
        'organization_member_id' => true,
        'created' => true,
        'modified' => true,
        'organization' => true,
        'organization_member' => true,
    ];
}

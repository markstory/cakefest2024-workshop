<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity
 *
 * @property int $id
 * @property string $slug
 * @property string|null $name
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $updated
 *
 * @property \App\Model\Entity\OrganizationInvite[] $organization_invites
 * @property \App\Model\Entity\OrganizationMember[] $organization_members
 * @property \App\Model\Entity\OrganziationOption[] $organziation_options
 * @property \App\Model\Entity\Project[] $projects
 * @property \App\Model\Entity\Team[] $teams
 */
class Organization extends Entity
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
        'slug' => true,
        'name' => true,
        'created' => true,
        'updated' => true,
        'organization_invites' => true,
        'organization_members' => true,
        'organziation_options' => true,
        'projects' => true,
        'teams' => true,
    ];
}

<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property int $organization_id
 * @property string $slug
 * @property string|null $name
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Organization $organization
 * @property \App\Model\Entity\TeamMember[] $team_members
 * @property \App\Model\Entity\Project[] $projects
 */
class Team extends Entity
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
        'slug' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'organization' => true,
        'team_members' => true,
        'organization_members' => true,
        'projects' => true,
    ];
}

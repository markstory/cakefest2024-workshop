<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Query\SelectQuery;

/**
 * Projects policy
 */
class ProjectsTablePolicy
{
    public function scopeIndex(IdentityInterface $user, SelectQuery $query): SelectQuery
    {
        return $query->where(['Projects.organization_id IN' => $user->organization_membership_ids]);
    }
}

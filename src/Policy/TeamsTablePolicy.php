<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Query\SelectQuery;

/**
 * Teams policy
 */
class TeamsTablePolicy
{
    public function scopeIndex(IdentityInterface $user, SelectQuery $query): SelectQuery
    {
        return $query->where(['Teams.organnization_id IN' => $user->member_organization_ids]);
    }
}

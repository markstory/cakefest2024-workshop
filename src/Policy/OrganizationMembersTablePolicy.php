<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Query\SelectQuery;

/**
 * OrganizationMembers policy
 */
class OrganizationMembersTablePolicy
{
    public function scopeIndex(IdentityInterface $user, SelectQuery $query): SelectQuery
    {
        return $query->where(['OrganizationMembers.organization_id IN' => $user->member_organization_ids]);
    }
}

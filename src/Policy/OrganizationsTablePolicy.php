<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use Cake\ORM\Query\SelectQuery;

/**
 * Organizations policy
 */
class OrganizationsTablePolicy
{
    public function scopeIndex(IdentityInterface $user, SelectQuery $query): SelectQuery
    {
        return $query->where(['Organizations.id IN' => $user->member_organization_ids]);
    }
}

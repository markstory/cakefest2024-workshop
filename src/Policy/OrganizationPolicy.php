<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Organization;
use Authorization\IdentityInterface;

/**
 * Organization policy
 */
class OrganizationPolicy
{
    /**
     * Check if $user can add Organization
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Organization $organization
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Organization $organization)
    {
        // TODO This might not always be true.
        return true;
    }

    /**
     * Check if $user can edit Organization
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Organization $organization
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Organization $organization)
    {
        return $user->isOwner($organization->id);
    }

    /**
     * Check if $user can delete Organization
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Organization $organization
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Organization $organization)
    {
        return $this->canEdit($user, $organization);
    }

    /**
     * Check if $user can view Organization
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Organization $organization
     * @return bool
     */
    public function canView(IdentityInterface $user, Organization $organization)
    {
        return $user->isMember($organization->id);
    }
}

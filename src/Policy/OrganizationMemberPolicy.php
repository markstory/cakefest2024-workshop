<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\OrganizationMember;
use Authorization\IdentityInterface;

/**
 * OrganizationMember policy
 */
class OrganizationMemberPolicy
{
    /**
     * Check if $user can add OrganizationMember
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationMember $organizationMember
     * @return bool
     */
    public function canAdd(IdentityInterface $user, OrganizationMember $organizationMember)
    {
        return $user->isOwner($user, $organizationMember->organization_id);
    }

    /**
     * Check if $user can edit OrganizationMember
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationMember $organizationMember
     * @return bool
     */
    public function canEdit(IdentityInterface $user, OrganizationMember $organizationMember)
    {
        return $user->isOwner($organizationMember->organization_id);
    }

    /**
     * Check if $user can delete OrganizationMember
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationMember $organizationMember
     * @return bool
     */
    public function canDelete(IdentityInterface $user, OrganizationMember $organizationMember)
    {
        return $user->isOwner($organizationMember->organization_id);
    }

    /**
     * Check if $user can view OrganizationMember
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationMember $organizationMember
     * @return bool
     */
    public function canView(IdentityInterface $user, OrganizationMember $organizationMember)
    {
        return $user->isMember($organizationMember->organization_id);
    }
}

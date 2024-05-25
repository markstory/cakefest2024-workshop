<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\OrganizationInvite;
use Authorization\IdentityInterface;

/**
 * OrganizationInvite policy
 */
class OrganizationInvitePolicy
{
    /**
     * Check if $user can add OrganizationInvite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationInvite $organizationInvite
     * @return bool
     */
    public function canAdd(IdentityInterface $user, OrganizationInvite $organizationInvite)
    {
        return in_array($organizationInvite->organization_id, $user->member_organization_ids, true);
    }

    /**
     * Check if $user can edit OrganizationInvite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationInvite $organizationInvite
     * @return bool
     */
    public function canEdit(IdentityInterface $user, OrganizationInvite $organizationInvite)
    {
        return in_array($organizationInvite->organization_id, $user->member_organization_ids, true);
    }

    /**
     * Check if $user can delete OrganizationInvite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationInvite $organizationInvite
     * @return bool
     */
    public function canDelete(IdentityInterface $user, OrganizationInvite $organizationInvite)
    {
        return in_array($organizationInvite->organization_id, $user->member_organization_ids, true);
    }

    /**
     * Check if $user can view OrganizationInvite
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationInvite $organizationInvite
     * @return bool
     */
    public function canView(IdentityInterface $user, OrganizationInvite $organizationInvite)
    {
        return in_array($organizationInvite->organization_id, $user->member_organization_ids, true);
    }
}

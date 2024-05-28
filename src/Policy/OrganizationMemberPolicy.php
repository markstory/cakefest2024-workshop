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
    protected function isOrgMember(IdentityInterface $user, OrganizationMember $member): bool
    {
        return in_array($member->organization_id, $user->member_organization_ids);
    }

    /**
     * Check if $user can add OrganizationMember
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\OrganizationMember $organizationMember
     * @return bool
     */
    public function canAdd(IdentityInterface $user, OrganizationMember $organizationMember)
    {
        return $this->isOrgMember($user, $organizationMember);
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
        // TODO role requirements
        return $this->isOrgMember($user, $organizationMember);
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
        // TODO role requirements
        return $this->isOrgMember($user, $organizationMember);
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
        return $this->isOrgMember($user, $organizationMember);
    }
}

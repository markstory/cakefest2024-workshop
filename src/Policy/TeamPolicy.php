<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Team;
use Authorization\IdentityInterface;

/**
 * Team policy
 */
class TeamPolicy
{
    protected function isOrgMember(IdentityInterface $user, Team $team): bool
    {
        return in_array($team->organization_id, $user->organization_membership_ids);
    }

    /**
     * Check if $user can add Team
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Team $team
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Team $team)
    {
        return $this->isOrgMember($user, $team);
    }

    /**
     * Check if $user can edit Team
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Team $team
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Team $team)
    {
        return $this->isOrgMember($user, $team);
    }

    /**
     * Check if $user can delete Team
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Team $team
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Team $team)
    {
        return $this->isOrgMember($user, $team);
    }

    /**
     * Check if $user can view Team
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Team $team
     * @return bool
     */
    public function canView(IdentityInterface $user, Team $team)
    {
        return $this->isOrgMember($user, $team);
    }
}

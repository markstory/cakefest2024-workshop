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
    /**
     * Check if $user can add Team
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Team $team
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Team $team)
    {
        return $user->isMember($team->organization_id);
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
        return $user->isManager($team->organization_id);
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
        return $user->isManager($team->organization_id);
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
        return $user->isMember($team->organization_id);
    }
}

<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Project;
use Authorization\IdentityInterface;

/**
 * Project policy
 */
class ProjectPolicy
{
    /**
     * Check if $user can add Project
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Project $project
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Project $project)
    {
        return $user->isMember($project->organization_id);
    }

    /**
     * Check if $user can edit Project
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Project $project
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Project $project)
    {
        $isOwner = $user->isOwner($project->organization_id);
        $isManager = $user->isManager($project->organization_id);
        $isTeamMember = $user->isProjectMember($project);

        return $isOwner || ($isTeamMember && $isManager);
    }

    /**
     * Check if $user can delete Project
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Project $project
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Project $project)
    {
        $isOwner = $user->isOwner($project->organization_id);
        $isManager = $user->isManager($project->organization_id);
        $isTeamMember = $user->isProjectMember($project);

        return $isOwner || ($isTeamMember && $isManager);
    }

    /**
     * Check if $user can view Project
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Project $project
     * @return bool
     */
    public function canView(IdentityInterface $user, Project $project)
    {
        return $user->isMember($project->organization_id);
    }
}

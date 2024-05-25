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
    protected function isOrgMember(IdentityInterface $user, Project $project): bool
    {
        return in_array($project->organization_id, $user->member_organization_ids);
    }

    /**
     * Check if $user can add Project
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Project $project
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Project $project)
    {
        return $this->isOrgMember($user, $project);
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
        return $this->isOrgMember($user, $project);
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
        return $this->isOrgMember($user, $project);
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
        return $this->isOrgMember($user, $project);
    }
}

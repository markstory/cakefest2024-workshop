<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav" hx-boost="true">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Organization'), ['action' => 'edit', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Organization'), ['action' => 'delete', 'orgslug' => $organization->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->slug), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Organizations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Invite Member'), ['_path' => 'OrganizationInvites::add', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <?php if ($vip) : ?>
            <div class="warning">
            You are a VIP, get some good stuff!
            </div>
        <?php endif; ?>
        <div class="organizations view content">
            <h3><?= h($organization->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($organization->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($organization->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($organization->updated) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Pending Invites') ?></h4>
                <?php if (!empty($organization->organization_invites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->organization_invites as $organizationInvite) : ?>
                        <tr>
                            <td><?= h($organizationInvite->email) ?></td>
                            <td><?= h($organizationInvite->role->value) ?></td>
                            <td><?= h($organizationInvite->created) ?></td>
                            <td><?= h($organizationInvite->modified) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationInvites', 'action' => 'delete', 'orgslug' => $organization->slug, $organizationInvite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationInvite->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Members') ?></h4>
                <?php if (!empty($organization->organization_members)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->organization_members as $organizationMember) : ?>
                        <tr>
                            <td><?= h($organizationMember->user?->name) ?></td>
                            <td><?= h($organizationMember->role->value) ?></td>
                            <td><?= h($organizationMember->created) ?></td>
                            <td><?= h($organizationMember->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrganizationMembers', 'action' => 'edit','orgslug' => $organization->slug,  $organizationMember->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationMembers', 'action' => 'delete', 'orgslug' => $organization->slug, $organizationMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <?= $this->Html->link(__('Invite a new member'), ['_path' => 'OrganizationInvites::add']) ?>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($organization->projects)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->projects as $project) : ?>
                        <tr>
                            <td><?= h($project->name) ?></td>
                            <td><?= h($project->created) ?></td>
                            <td><?= h($project->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', 'orgslug' => $organization->slug, $project->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', 'orgslug' => $organization->slug, $project->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', 'orgslug' => $organization->slug, $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <?= $this->Html->link(__('Create new Project'), ['_path' => 'Projects::add']) ?>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Teams') ?></h4>
                <?php if (!empty($organization->teams)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->teams as $team) : ?>
                        <tr>
                            <td><?= h($team->name) ?></td>
                            <td><?= h($team->created) ?></td>
                            <td><?= h($team->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Teams', 'action' => 'view', 'orgslug' => $organization->slug, $team->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Teams', 'action' => 'edit', 'orgslug' => $organization->slug, $team->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teams', 'action' => 'delete', 'orgslug' => $organization->slug, $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <?= $this->Html->link(__('Create new Team'), ['_path' => 'Teams::add']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

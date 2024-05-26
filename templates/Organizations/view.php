<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Organization'), ['action' => 'edit', $organization->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Organization'), ['action' => 'delete', $organization->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organization->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Organizations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Organization'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organizations view content">
            <h3><?= h($organization->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($organization->slug) ?></td>
                </tr>
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
                <h4><?= __('Related Organization Invites') ?></h4>
                <?php if (!empty($organization->organization_invites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Teams') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->organization_invites as $organizationInvite) : ?>
                        <tr>
                            <td><?= h($organizationInvite->email) ?></td>
                            <td><?= h($organizationInvite->role) ?></td>
                            <td><?= h($organizationInvite->teams) ?></td>
                            <td><?= h($organizationInvite->created) ?></td>
                            <td><?= h($organizationInvite->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrganizationInvites', 'action' => 'view', $organizationInvite->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrganizationInvites', 'action' => 'edit', $organizationInvite->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationInvites', 'action' => 'delete', $organizationInvite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationInvite->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                    <?= $this->Html->link(__('Invite a new member'), ['_path' => 'OrganizationInvites::add', 'orgslug' => $organization->slug]) ?>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Organization Members') ?></h4>
                <?php if (!empty($organization->organization_members)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->organization_members as $organizationMember) : ?>
                        <tr>
                            <td><?= h($organizationMember->role) ?></td>
                            <td><?= h($organizationMember->created) ?></td>
                            <td><?= h($organizationMember->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrganizationMembers', 'action' => 'edit', $organizationMember->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationMembers', 'action' => 'delete', $organizationMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id)]) ?>
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
                <h4><?= __('Related Projects') ?></h4>
                <?php if (!empty($organization->projects)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->projects as $project) : ?>
                        <tr>
                            <td><?= h($project->slug) ?></td>
                            <td><?= h($project->name) ?></td>
                            <td><?= h($project->created) ?></td>
                            <td><?= h($project->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $project->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $project->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id)]) ?>
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
                <h4><?= __('Related Teams') ?></h4>
                <?php if (!empty($organization->teams)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organization->teams as $team) : ?>
                        <tr>
                            <td><?= h($team->slug) ?></td>
                            <td><?= h($team->name) ?></td>
                            <td><?= h($team->created) ?></td>
                            <td><?= h($team->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Teams', 'action' => 'view', $team->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Teams', 'action' => 'edit', $team->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teams', 'action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
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

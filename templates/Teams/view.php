<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Team'), ['action' => 'edit', $team->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Team'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Teams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Team'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teams view content">
            <h3><?= h($team->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Organization') ?></th>
                    <td><?= $team->hasValue('organization') ? $this->Html->link($team->organization->name, ['controller' => 'Organizations', 'action' => 'view', $team->organization->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($team->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($team->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($team->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Projects') ?></h4>
                <?php if (!empty($team->projects)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($team->projects as $project) : ?>
                        <tr>
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
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Team Members') ?></h4>
                <?php if (!empty($team->organization_members)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($team->organization_members as $teamMember) : ?>
                        <tr>
                            <td><?= h($teamMember->user->name) ?></td>
                            <td><?= h($teamMember->role) ?></td>
                            <td><?= h($teamMember->created) ?></td>
                            <td><?= h($teamMember->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TeamMembers', 'action' => 'view', $teamMember->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'TeamMembers', 'action' => 'edit', $teamMember->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'TeamMembers', 'action' => 'delete', $teamMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamMember->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

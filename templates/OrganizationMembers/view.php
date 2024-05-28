<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrganizationMember $organizationMember
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Organization Member'), ['action' => 'edit', $organizationMember->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Organization Member'), ['action' => 'delete', $organizationMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Organization Members'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Organization Member'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organizationMembers view content">
            <h3><?= h($organizationMember->role) ?></h3>
            <table>
                <tr>
                    <th><?= __('Organization') ?></th>
                    <td><?= $organizationMember->hasValue('organization') ? $this->Html->link($organizationMember->organization->name, ['controller' => 'Organizations', 'action' => 'view', $organizationMember->organization->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $organizationMember->hasValue('user') ? $this->Html->link($organizationMember->user->name, ['controller' => 'Users', 'action' => 'view', $organizationMember->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                <td><?= h($organizationMember->role->value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($organizationMember->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($organizationMember->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Organization Invites') ?></h4>
                <?php if (!empty($organizationMember->organization_invites)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Organization Member Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Verify Token') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organizationMember->organization_invites as $organizationInvite) : ?>
                        <tr>
                            <td><?= h($organizationInvite->email) ?></td>
                            <td><?= h($organizationInvite->role) ?></td>
                            <td><?= h($organizationInvite->organization_member_id) ?></td>
                            <td><?= h($organizationInvite->created) ?></td>
                            <td><?= h($organizationInvite->modified) ?></td>
                            <td><?= h($organizationInvite->verify_token) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrganizationInvites', 'action' => 'view', $organizationInvite->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrganizationInvites', 'action' => 'edit', $organizationInvite->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationInvites', 'action' => 'delete', $organizationInvite->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationInvite->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Team Memberships') ?></h4>
                <?php if (!empty($organizationMember->team_members)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Team') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($organizationMember->team_members as $teamMember) : ?>
                        <tr>
                            <td><?= h($teamMember->team->name) ?></td>
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

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Active') ?></th>
                    <td><?= h($user->last_active) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($user->updated) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Organization Members') ?></h4>
                <?php if (!empty($user->organization_members)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Organization Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->organization_members as $organizationMember) : ?>
                        <tr>
                            <td><?= h($organizationMember->id) ?></td>
                            <td><?= h($organizationMember->organization_id) ?></td>
                            <td><?= h($organizationMember->user_id) ?></td>
                            <td><?= h($organizationMember->role) ?></td>
                            <td><?= h($organizationMember->created) ?></td>
                            <td><?= h($organizationMember->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrganizationMembers', 'action' => 'view', $organizationMember->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrganizationMembers', 'action' => 'edit', $organizationMember->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrganizationMembers', 'action' => 'delete', $organizationMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Emails') ?></h4>
                <?php if (!empty($user->user_emails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Email Verified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Updated') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_emails as $userEmail) : ?>
                        <tr>
                            <td><?= h($userEmail->id) ?></td>
                            <td><?= h($userEmail->user_id) ?></td>
                            <td><?= h($userEmail->email) ?></td>
                            <td><?= h($userEmail->email_verified) ?></td>
                            <td><?= h($userEmail->created) ?></td>
                            <td><?= h($userEmail->updated) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserEmails', 'action' => 'view', $userEmail->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmails', 'action' => 'edit', $userEmail->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmails', 'action' => 'delete', $userEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmail->id)]) ?>
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

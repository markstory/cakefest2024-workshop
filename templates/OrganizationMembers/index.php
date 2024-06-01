<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrganizationMember> $organizationMembers
 */
$this->Paginator->options(['url' => ['orgslug' => $organization->slug]]);
?>
<div class="organizationMembers index content">
    <?= $this->Html->link(__('New Organization Member'), ['action' => 'add', 'orgslug' => $organization->slug], ['class' => 'button float-right']) ?>
    <h3><?= h($organization->slug) . ' / ' . __('Members') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($organizationMembers as $organizationMember): ?>
                <tr>
                    <td><?= $organizationMember->hasValue('user') ? $this->Html->link($organizationMember->user->name, ['controller' => 'Users', 'action' => 'view', $organizationMember->user->id]) : '' ?></td>
                    <td><?= h($organizationMember->role->value) ?></td>
                    <td><?= h($organizationMember->created) ?></td>
                    <td><?= h($organizationMember->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', 'orgslug' => $organization->slug, $organizationMember->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', 'orgslug' => $organization->slug, $organizationMember->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', 'orgslug' => $organization->slug, $organizationMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

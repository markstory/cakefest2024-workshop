<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var iterable<\App\Model\Entity\Team> $teams
 */
$this->Paginator->options(['url' => ['orgslug' => $organization->slug]]);
?>
<div class="teams index content">
    <?= $this->Html->link(__('New Team'), ['action' => 'add', 'orgslug' => $organization->slug], ['class' => 'button float-right']) ?>
    <h3><?= h($organization->slug) . ' / ' . __('Teams') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teams as $team): ?>
                <tr>
                    <td><?= h($team->name) ?></td>
                    <td><?= h($team->created) ?></td>
                    <td><?= h($team->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', 'orgslug' => $organization->slug,  $team->id]) ?>
                        <?php if ($user->can('edit', $team)) : ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit',  'orgslug' => $organization->slug, $team->id]) ?>
                        <?php endif; ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',  'orgslug' => $organization->slug, $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
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

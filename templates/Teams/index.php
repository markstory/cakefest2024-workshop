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
            <tbody hx-target="closest tr">
                <?php foreach ($teams as $team) : ?>
                    <tr>
                    <?= $this->element('Teams/table_row', [
                        'team' => $team,
                        'organizations' => $organization,
                        'user' => $user
                    ]) ?>
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

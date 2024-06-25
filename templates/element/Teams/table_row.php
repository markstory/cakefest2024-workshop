<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Organization $organization
 * @var iterable<\App\Model\Entity\Team> $teams
 */
$deleteConfirm = ['_name' => 'teams:deleteconfirm',  'orgslug' => $organization->slug, $team->id];
$inlineTeamEdit = ['_name' => 'teams:inlineedit', 'orgslug' => $organization->slug, $team->id];
?>
<td><?= h($team->name) ?></td>
<td><?= h($team->created) ?></td>
<td><?= h($team->modified) ?></td>
<td class="actions">
    <?= $this->Html->link(__('View'), ['action' => 'view', 'orgslug' => $organization->slug,  $team->id]) ?>
    <?php if ($user->can('edit', $team)) : ?>
        <?= $this->Html->link(
            __('Edit'),
            ['action' => 'edit',  'orgslug' => $organization->slug, $team->id],
            ['hx-get' => $this->Url->build($inlineTeamEdit)]
        ) ?>
    <?php endif; ?>

    <?= $this->Html->link(
    __('Delete'),
    $deleteConfirm,
    [
        'hx-get' => $this->Url->build($deleteConfirm),
        'hx-target' => 'body',
        'hx-swap' => 'beforeend',
    ]
    ) ?>
</td>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 * @var \App\Model\Entity\Organization $organization
 */

$this->setLayout('ajax');
?>
<td colspan="4">
    <?= $this->Form->create($team, [
        'hx-post' => $this->Url->build(),
    ]) ?>
    <fieldset>
        <legend><?= __('Edit Team') ?></legend>
        <?= $this->Form->control('name') ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</td>

<?php
declare(strict_types=1);
/**
* @var \App\Model\Entity\Team $team
* @var \App\Model\Entity\Organization $organization
*/
$this->setLayout('modal');

$title = 'Are you sure?';
$description = 'Deleting this team is permanent and could revoke access to projects for some members';
$target = ['_name' => 'teams:delete', 'orgslug' => $organization->slug, $team->id];
?>
<?= $this->Form->create(null, ['url' => $target]) ?>
<h2><?= $title ?></h2>
<p><?= $description ?></p>
<div class="button-bar-right">
    <?= $this->Html->link('Cancel', '#', [
        'modal-close' => '1',
        'class' => 'button button-muted',
        'data-testid' => 'confirm-cancel',
        'tabindex' => 0,
        'autofocus' => 1,
    ]) ?>
    <?= $this->Form->button('Ok', [
        'type' => 'submit',
        'class' => 'button button-danger',
        'data-testid' => 'confirm-proceed',
    ]) ?>
</div>
<?= $this->Form->end() ?>

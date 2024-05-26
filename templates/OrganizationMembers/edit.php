<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrganizationMember $organizationMember
 * @var string[]|\Cake\Collection\CollectionInterface $organizations
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $organizationMember->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $organizationMember->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Organization Members'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organizationMembers form content">
            <?= $this->Form->create($organizationMember) ?>
            <fieldset>
                <legend><?= __('Edit Organization Member') ?></legend>
                <?php
                    echo $this->Form->control('organization_id', ['options' => $organizations]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('role');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

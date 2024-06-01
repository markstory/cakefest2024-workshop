<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrganizationMember $organizationMember
 * @var \Cake\Collection\CollectionInterface|string[] $organizations
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Organization Members'), ['action' => 'index', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organizationMembers form content">
            <?= $this->Form->create($organizationMember) ?>
            <fieldset>
                <legend><?= __('Add Organization Member') ?></legend>
                <?php
                    echo $this->Form->hidden('organization_id', ['value' => $organization->id]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('role');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

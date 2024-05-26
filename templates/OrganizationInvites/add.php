<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrganizationInvite $organizationInvite
 * @var \Cake\Collection\CollectionInterface|string[] $organizations
 * @var \Cake\Collection\CollectionInterface|string[] $organizationMembers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Organization Invites'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="organizationInvites form content">
            <?= $this->Form->create($organizationInvite) ?>
            <fieldset>
                <legend><?= __('Add Organization Invite') ?></legend>
                <?php
                    echo $this->Form->control('organization_id', ['options' => $organizations]);
                    echo $this->Form->control('email');
                    echo $this->Form->control('role');
                    echo $this->Form->control('teams');
                    echo $this->Form->control('organization_member_id', ['options' => $organizationMembers, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

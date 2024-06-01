<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 * @var \App\Model\Entity\Organization $organization
 * @var \Cake\Collection\CollectionInterface|string[] $projects
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Teams'), ['action' => 'index', 'orgslug' => $organization->slug], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teams form content">
            <?= $this->Form->create($team) ?>
            <fieldset>
                <legend><?= __('Add Team') ?></legend>
                <?php
                    echo $this->Form->hidden('organization_id', ['value' => $organization->id]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('projects._ids', ['options' => $projects]);
                    echo $this->Form->control('organization_members._ids', ['options' => $members]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

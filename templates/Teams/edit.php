<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Team $team
 * @var string[]|\Cake\Collection\CollectionInterface $organizations
 * @var string[]|\Cake\Collection\CollectionInterface $projects
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $team->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $team->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Teams'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="teams form content">
            <?= $this->Form->create($team) ?>
            <fieldset>
                <legend><?= __('Edit Team') ?></legend>
                <?php
                    echo $this->Form->control('organization_id', ['options' => $organizations]);
                    echo $this->Form->control('slug');
                    echo $this->Form->control('name');
                    echo $this->Form->control('projects._ids', ['options' => $projects]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

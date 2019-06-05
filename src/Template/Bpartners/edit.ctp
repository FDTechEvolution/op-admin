<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bpartner $bpartner
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bpartner->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bpartner->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bpartners'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bpartner Addresses'), ['controller' => 'BpartnerAddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bpartner Address'), ['controller' => 'BpartnerAddresses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bpartners form large-9 medium-8 columns content">
    <?= $this->Form->create($bpartner) ?>
    <fieldset>
        <legend><?= __('Edit Bpartner') ?></legend>
        <?php
            echo $this->Form->control('org_id', ['options' => $orgs]);
            echo $this->Form->control('company');
            echo $this->Form->control('name');
            echo $this->Form->control('mobile');
            echo $this->Form->control('level');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

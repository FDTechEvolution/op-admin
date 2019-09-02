<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawOrder $rawOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Raw Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rawOrders form large-9 medium-8 columns content">
    <?= $this->Form->create($rawOrder) ?>
    <fieldset>
        <legend><?= __('Add Raw Order') ?></legend>
        <?php
            echo $this->Form->control('org_id', ['options' => $orgs]);
            echo $this->Form->control('orderno');
            echo $this->Form->control('data');
            echo $this->Form->control('createdby');
            echo $this->Form->control('status');
            echo $this->Form->control('lineid');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

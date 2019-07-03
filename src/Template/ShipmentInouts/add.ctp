<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShipmentInout $shipmentInout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Shipment Inouts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bpartners'), ['controller' => 'Bpartners', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bpartner'), ['controller' => 'Bpartners', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shipment Inout Lines'), ['controller' => 'ShipmentInoutLines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shipment Inout Line'), ['controller' => 'ShipmentInoutLines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shipmentInouts form large-9 medium-8 columns content">
    <?= $this->Form->create($shipmentInout) ?>
    <fieldset>
        <legend><?= __('Add Shipment Inout') ?></legend>
        <?php
            echo $this->Form->control('org_id', ['options' => $orgs]);
            echo $this->Form->control('docdate');
            echo $this->Form->control('from_warehouse_id');
            echo $this->Form->control('to_warehouse_id');
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('isshipment');
            echo $this->Form->control('bpartner_id', ['options' => $bpartners]);
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

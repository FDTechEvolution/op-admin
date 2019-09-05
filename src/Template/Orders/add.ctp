<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Raw Orders'), ['controller' => 'RawOrders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Raw Order'), ['controller' => 'RawOrders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Lines'), ['controller' => 'OrderLines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Line'), ['controller' => 'OrderLines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->control('documentno');
            echo $this->Form->control('org_id', ['options' => $orgs]);
            echo $this->Form->control('customer_id', ['options' => $customers]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('orderdate');
            echo $this->Form->control('payment_method');
            echo $this->Form->control('status');
            echo $this->Form->control('description');
            echo $this->Form->control('totalamt');
            echo $this->Form->control('shipping');
            echo $this->Form->control('trackingno');
            echo $this->Form->control('createdby');
            echo $this->Form->control('modifiedby');
            echo $this->Form->control('raw_order_id', ['options' => $rawOrders, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

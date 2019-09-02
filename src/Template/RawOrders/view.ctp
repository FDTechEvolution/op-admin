<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawOrder $rawOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Raw Order'), ['action' => 'edit', $rawOrder->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Raw Order'), ['action' => 'delete', $rawOrder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rawOrder->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Raw Orders'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Raw Order'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rawOrders view large-9 medium-8 columns content">
    <h3><?= h($rawOrder->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($rawOrder->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Org') ?></th>
            <td><?= $rawOrder->has('org') ? $this->Html->link($rawOrder->org->name, ['controller' => 'Orgs', 'action' => 'view', $rawOrder->org->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdby') ?></th>
            <td><?= h($rawOrder->createdby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($rawOrder->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lineid') ?></th>
            <td><?= h($rawOrder->lineid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Orderno') ?></th>
            <td><?= $this->Number->format($rawOrder->orderno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($rawOrder->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Data') ?></h4>
        <?= $this->Text->autoParagraph(h($rawOrder->data)); ?>
    </div>
</div>

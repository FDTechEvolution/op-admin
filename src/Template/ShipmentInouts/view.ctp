<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShipmentInout $shipmentInout
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shipment Inout'), ['action' => 'edit', $shipmentInout->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shipment Inout'), ['action' => 'delete', $shipmentInout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipmentInout->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shipment Inouts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shipment Inout'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orgs'), ['controller' => 'Orgs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Org'), ['controller' => 'Orgs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bpartners'), ['controller' => 'Bpartners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bpartner'), ['controller' => 'Bpartners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shipment Inout Lines'), ['controller' => 'ShipmentInoutLines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shipment Inout Line'), ['controller' => 'ShipmentInoutLines', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shipmentInouts view large-9 medium-8 columns content">
    <h3><?= h($shipmentInout->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($shipmentInout->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Org') ?></th>
            <td><?= $shipmentInout->has('org') ? $this->Html->link($shipmentInout->org->name, ['controller' => 'Orgs', 'action' => 'view', $shipmentInout->org->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From Warehouse Id') ?></th>
            <td><?= h($shipmentInout->from_warehouse_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To Warehouse Id') ?></th>
            <td><?= h($shipmentInout->to_warehouse_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $shipmentInout->has('user') ? $this->Html->link($shipmentInout->user->name, ['controller' => 'Users', 'action' => 'view', $shipmentInout->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isshipment') ?></th>
            <td><?= h($shipmentInout->isshipment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bpartner') ?></th>
            <td><?= $shipmentInout->has('bpartner') ? $this->Html->link($shipmentInout->bpartner->name, ['controller' => 'Bpartners', 'action' => 'view', $shipmentInout->bpartner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($shipmentInout->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($shipmentInout->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Docdate') ?></th>
            <td><?= h($shipmentInout->docdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($shipmentInout->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($shipmentInout->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Shipment Inout Lines') ?></h4>
        <?php if (!empty($shipmentInout->shipment_inout_lines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Shipment Inout Id') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shipmentInout->shipment_inout_lines as $shipmentInoutLines): ?>
            <tr>
                <td><?= h($shipmentInoutLines->id) ?></td>
                <td><?= h($shipmentInoutLines->shipment_inout_id) ?></td>
                <td><?= h($shipmentInoutLines->seq) ?></td>
                <td><?= h($shipmentInoutLines->product_id) ?></td>
                <td><?= h($shipmentInoutLines->qty) ?></td>
                <td><?= h($shipmentInoutLines->description) ?></td>
                <td><?= h($shipmentInoutLines->created) ?></td>
                <td><?= h($shipmentInoutLines->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ShipmentInoutLines', 'action' => 'view', $shipmentInoutLines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ShipmentInoutLines', 'action' => 'edit', $shipmentInoutLines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ShipmentInoutLines', 'action' => 'delete', $shipmentInoutLines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipmentInoutLines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

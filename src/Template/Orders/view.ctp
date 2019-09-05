<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<div class="productCategories view large-9 medium-8 columns content">
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>รายละเอียดคลังสินค้า <?= h($warehouse->name) ?></h3>
            <?= $this->Html->link(__('<i class="ti-arrow-circle-left"></i> คลังสินค้าทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= h($order->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Documentno') ?></th>
                        <td><?= h($order->documentno) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Org') ?></th>
                        <td><?= $order->has('org') ? $this->Html->link($order->org->name, ['controller' => 'Orgs', 'action' => 'view', $order->org->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Customer') ?></th>
                        <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('User') ?></th>
                        <td><?= $order->has('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Payment Method') ?></th>
                        <td><?= h($order->payment_method) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Status') ?></th>
                        <td><?= h($order->status) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Description') ?></th>
                        <td><?= h($order->description) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Shipping') ?></th>
                        <td><?= h($order->shipping) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Trackingno') ?></th>
                        <td><?= h($order->trackingno) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Createdby') ?></th>
                        <td><?= h($order->createdby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modifiedby') ?></th>
                        <td><?= h($order->modifiedby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Raw Order') ?></th>
                        <td><?= $order->has('raw_order') ? $this->Html->link($order->raw_order->id, ['controller' => 'RawOrders', 'action' => 'view', $order->raw_order->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Totalamt') ?></th>
                        <td><?= $this->Number->format($order->totalamt) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Orderdate') ?></th>
                        <td><?= h($order->orderdate) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($order->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($order->modified) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <th scope="row"><?= __('รายะเอียด') ?></th>
                    </tr>
                    <tr>
                        <?php if(isset($warehouse->description)) : ?>
                            <td style="padding-left: 20px;"><?= h($warehouse->description) ?></td>
                        <?php else : ?>
                            <td style="padding-left: 20px;">ไม่มีรายละเอียดใดๆเกี่ยวกับหมวดหมู่นี้.....</td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
    <div class="related">
        <h4><?= __('Related Order Lines') ?></h4>
        <?php if (!empty($order->order_lines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Org Id') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Discount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($order->order_lines as $orderLines): ?>
            <tr>
                <td><?= h($orderLines->id) ?></td>
                <td><?= h($orderLines->org_id) ?></td>
                <td><?= h($orderLines->order_id) ?></td>
                <td><?= h($orderLines->product_id) ?></td>
                <td><?= h($orderLines->qty) ?></td>
                <td><?= h($orderLines->price) ?></td>
                <td><?= h($orderLines->amount) ?></td>
                <td><?= h($orderLines->description) ?></td>
                <td><?= h($orderLines->discount) ?></td>
                <td><?= h($orderLines->created) ?></td>
                <td><?= h($orderLines->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderLines', 'action' => 'view', $orderLines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OrderLines', 'action' => 'edit', $orderLines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OrderLines', 'action' => 'delete', $orderLines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderLines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

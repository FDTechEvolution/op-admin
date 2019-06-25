<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<style>
    table.brand-table tbody tr {
        line-height: 30px;
    }
</style>
<div class="brands view large-9 medium-8 columns content">
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>รายละเอียดสินค้า <?= h($product->name) ?></h3>
            <?= $this->Html->link(__('<i class="ti-arrow-circle-left"></i> สินค้าทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-5">
                <table class="brand-table" style="margin-left: 20px;">
                    <tr>
                        <th style="width: 170px;" scope="row"><?= __('Org') ?></th>
                        <td><?= $product->has('org') ? $this->Html->link($product->org->name, ['controller' => 'Orgs', 'action' => 'view', $product->org->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('หมวดหมู่สินค้า') ?></th>
                        <td><?= $product->has('product_category') ? $this->Html->link($product->product_category->name, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->name]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ยี่ห้อสินค้า') ?></th>
                        <td><?= $product->has('brand') ? $this->Html->link($product->brand->name, ['controller' => 'Brands', 'action' => 'view', $product->brand->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ชื่อสินค้า') ?></th>
                        <td><?= h($product->name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('รหัสสินค้า') ?></th>
                        <td><?= h($product->code) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ราคาต้นทุน') ?></th>
                        <td><?= $this->Number->format($product->cost) ?>฿</td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ราคาขาย') ?></th>
                        <td><?= $this->Number->format($product->price) ?>฿</td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('เพิ่มสินค้าโดย') ?></th>
                        <td><?= h($product->createdby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ปรับปรุงสินค้าโดย') ?></th>
                        <td><?= h($product->modifiedby) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <th scope="row"><?= __('รายละเอียดสินค้า') ?></th>
                    </tr>
                    <tr>
                        <?php if($product->description != ""): ?>
                            <td style="padding-left: 20px;"><?= h($product->description) ?></td>
                        <?php else : ?>
                            <td style="padding-left: 20px;">ไม่มีรายละเอียดใดๆเกี่ยวกับสินค้า......</td>
                        <?php endif; ?>
                    </tr>
                </table>
        </div>
    </div>
</div>

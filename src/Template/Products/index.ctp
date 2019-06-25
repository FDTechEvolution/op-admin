<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Product</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="mdi mdi-plus-circle"></i> เพิ่มสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addProductModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?= __('org') ?></th>
                        <th scope="col"><?= __('หมวดหมู่') ?></th>
                        <th scope="col"><?= __('ยี่ห้อ') ?></th>
                        <th scope="col"><?= __('ชื่อสินค้า') ?></th>
                        <th scope="col" class="text-center"><?= __('รหัสสินค้า') ?></th>
                        <th scope="col" class="text-center"><?= __('ราคาต้นทุน (฿)') ?></th>
                        <th scope="col" class="text-center"><?= __('ราคาขาย (฿)') ?></th>
                        <th scope="col" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product->has('org') ? $this->Html->link($product->org->name, ['controller' => 'Orgs', 'action' => 'view', $product->org->id]) : '' ?></td>
                        <td><?= $product->has('product_category') ? $this->Html->link($product->product_category->name, ['controller' => 'Product_Categories', 'action' => 'view', $product->product_category->id]) : '' ?></td>
                        <td><?= $product->has('brand') ? $this->Html->link($product->brand->name, ['controller' => 'Brands', 'action' => 'view', $product->brand->id]) : '' ?></td>
                        <td><?= h($product->name) ?></td>
                        <td class="text-center"><?= h($product->code) ?></td>
                        <td class="text-center"><?= $this->Number->format($product->cost) ?></td>
                        <td class="text-center"><?= $this->Number->format($product->price) ?></td>
                            <?php
                                $modalProduct = [
                                    'data-id'=>$product->id,
                                    'data-name'=>$product->name,
                                    'data-code'=>$product->code,
                                    'data-cost'=>$product->cost,
                                    'data-price'=>$product->price,
                                    'data-description'=>h($product->description),
                                    'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#editProductModal',
                                    'escape' => false
                                ];
                            ?>
                        <td class="actions text-center">
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $product->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $product->id], $modalProduct) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $product->id], ['confirm' => __('ยืนยันการลบสินค้า # {0}?', $product->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD PRODUCT -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 45%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">เพิ่มรายการสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('product', ['url'=>['controller'=>'products', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">หมวดหมู่สินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('product_category_id', ['options' => $product_categories, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ยี่ห้อสินค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('brand_id', ['options' => $brands, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รหัส</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('code', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ต้นทุน</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('cost', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ราคา</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('price', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('org_id', ['type' => 'hidden', 'value' => $ORG_ID, 'label' => false]); ?>
                        </div>
                    </div>
                </fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<!-- EDIT PRODUCT -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 45%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">แก้ไขรายการสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('product', ['url'=>['controller'=>'products', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">หมวดหมู่</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('product_category_id', ['options' => $product_categories, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ยี่ห้อ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('brand_id', ['options' => $brands, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รหัส</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('code', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ต้นทุน</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('cost', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ราคา</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('price', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('productID', ['class' => 'form-control', 'type' => 'hidden', 'label' => false]); ?>
                        </div>
                    </div>
                </fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


<!-- Required datatable js -->
<?= $this->html->script('/plugins/datatables/jquery.dataTables.min') ?>
<?= $this->html->script('/plugins/datatables/dataTables.bootstrap4.min') ?>

<!-- Buttons examples -->
<?= $this->html->script('/plugins/datatables/dataTables.buttons.min') ?>
<?= $this->html->script('/plugins/datatables/buttons.bootstrap4.min') ?>
<?= $this->html->script('/plugins/datatables/jszip.min') ?>
<?= $this->html->script('/plugins/datatables/pdfmake.min') ?>
<?= $this->html->script('/plugins/datatables/vfs_fonts') ?>
<?= $this->html->script('/plugins/datatables/buttons.html5.min') ?>
<?= $this->html->script('/plugins/datatables/buttons.print.min') ?>
<?= $this->html->script('/plugins/datatables/buttons.colVis.min') ?>

<!-- Responsive examples -->
<?= $this->html->script('dataTables.responsive.min') ?>
<?= $this->html->script('responsive.bootstrap4.min') ?>

<!-- Custom JS 
<?= $this->html->script('mycustomjs') ?>
-->

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        $('#editProductModal').on('show.bs.modal', function (e) {
            var productId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var code = $(e.relatedTarget).data('code');
            var cost = $(e.relatedTarget).data('cost');
            var price = $(e.relatedTarget).data('price');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="productID"]').val(productId);
            $('#frm_edit input[name="name"]').val(name);
            $('#frm_edit input[name="code"]').val(code);
            $('#frm_edit input[name="cost"]').val(cost);
            $('#frm_edit input[name="price"]').val(price);
            $('#frm_edit textarea[name="description"]').val(description);
        });
    });

</script>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Brand $brand
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
            <h3>รายละเอียดยี่ห้อสินค้า <?= h($brand->name) ?></h3>
            <?= $this->Html->link(__('<i class="ti-arrow-circle-left"></i> Brand ทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <table class="brand-table" style="margin-left: 20px;">
                    <tr>
                        <th scope="row" style="width: 140px;"><?= __('Org') ?></th>
                        <td><?= $brand->has('org') ? $this->Html->link($brand->org->name, ['controller' => 'Orgs', 'action' => 'view', $brand->org->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ชื่อยี่ห้อ') ?></th>
                        <td><?= h($brand->name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('สร้างยี่ห้อโดย') ?></th>
                        <td><?= h($brand->createdby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ปรับปรุงโดย') ?></th>
                        <td><?= h($brand->modifiedby) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <table>
                    <tr>
                        <th scope="row"><?= __('รายละเอียด') ?></th>
                    </tr>
                    <tr>
                        <?php if($brand->description != "") : ?>
                            <td style="padding-left: 20px;"><?= h($brand->description) ?></td>
                        <?php else : ?>
                            <td style="padding-left: 20px;">ไม่มีรายละเอียดใดๆเกี่ยวกับยี่ห้อนี้.....</td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-box">
        <div class="related">
            <h4><?= __('สินค้าที่อยู่ในยี่ห้อนี้') ?></h4>
            <hr>
            <?php if (!empty($brand->products)): ?>
            <div class="row">
                <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><?= __('ชื่อสินค้า') ?></th>
                            <th scope="col" class="text-center"><?= __('รหัสสินค้า') ?></th>
                            <th scope="col" class="text-center"><?= __('ต้นทุน (฿)') ?></th>
                            <th scope="col" class="text-center"><?= __('ราคาขาย (฿)') ?></th>
                            <th scope="col" class="actions text-center"><?= __('การจัดการ') ?></th>
                        </tr>
                    <thead>
                    <tbody>
                        <?php foreach ($brand->products as $products): ?>
                        <tr>
                            <td><?= h($products->name) ?></td>
                            <td class="text-center"><?= h($products->code) ?></td>
                            <td class="text-center"><?= h($products->cost) ?></td>
                            <td class="text-center"><?= h($products->price) ?></td>
                            <td class="actions text-center">
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['controller' => 'Products', 'action' => 'view', $products->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['controller' => 'Products', 'action' => 'edit', $products->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('ยืนยันที่จะลบสินค้า # {0}?', $products->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
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
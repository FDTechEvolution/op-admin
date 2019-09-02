<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Warehouse $warehouse
 */
?>
<style>
    table.vertical-table tbody tr {
        line-height: 36px;
    }
</style>
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
                        <th scope="row" style="width: 180px;"><?= __('Org') ?></th>
                        <td><?= $warehouse->has('org') ? $this->Html->link($warehouse->org->name, ['controller' => 'Orgs', 'action' => 'view', $warehouse->org->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('ชื่อคลังสินค้า') ?></th>
                        <td><?= h($warehouse->name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('สร้างคลังสินค้าโดย') ?></th>
                        <td><?= h($warehouse->createdby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('แก้ไขคลังสินค้าโดย') ?></th>
                        <td><?= h($warehouse->modifiedby) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('สถานะ') ?></th>
                        <td>
                            <?php if(h($warehouse->isactive == 'Y')) { ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth"></i> เปิดใช้งาน'), ['class' => 'btn btn-success waves-effect waves-light', 'data-toggle' => 'modal', 'data-target' => '#statWHModal', 'data-id' => $warehouse->id, 'data-value' => 'N', 'escape' => false, 'title'=>'คลิกเพื่อปิดการใช้งาน']) ?>
                            <?php }else{ ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-earth-off"></i> ปิดการใช้งาน'), ['class' => 'btn btn-outline-secondary', 'data-toggle' => 'modal', 'data-target' => '#statWHModal', 'data-id' => $warehouse->id, 'data-value' => 'Y', 'escape' => false, 'title'=>'คลิกเพื่อเปิดใช้งาน']) ?>
                            <?php } ?>
                        </td>
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
    <div class="card-box">
        <div class="related">
            <h4><?= __('ราการสินค้าที่อยู่ในคลังสินค้านี้') ?></h4>
            <hr>
            <div class="row">
                <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><?=__('วันที่') ?></th>
                            <th scope="col" class="text-center"><?= __('ชื่อสินค้า') ?></th>
                            <th scope="col" class="text-center"><?= __('ต้นทุน (฿)') ?></th>
                            <th scope="col" class="text-center"><?= __('ราคาขาย (฿)') ?></th>
                            <th scope="col" class="text-center"><?= __('จำนวน') ?></th>
                            <th scope="col" class="text-center"><?= __('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($warehouseLine as $productLine) : ?>
                        <tr>
                            <td class="text-center"><?= $productLine->docdate; ?></td>
                            <td class="text-center"><?= $productLine->has('product') ? $this->Html->link($productLine->product->name, ['controller' => 'Products', 'action' => 'view', $productLine->product->id]) : '' ?></td>
                            <td class="text-center"><?= $productLine->has('product') ? $productLine->product->cost : '' ?></td>
                            <td class="text-center"><?= $productLine->has('product') ? $productLine->product->price : '' ?></td>
                            <td class="text-center"><?= $productLine->qty; ?></td>
                            <td class="text-center">รับเข้า / ส่งออก</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>


<!-- Change Stat warehouse -->
<div class="modal fade" id="statWHModal" tabindex="-1" role="dialog" aria-labelledby="statWHModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statWHModalLabel">เปลี่ยนสถานะ</h5>
            </div>
            <div class="modal-body">
                ยืนยันการเปลี่ยนแปลงสถานะ ?
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('wh', ['url'=>['controler'=>'warehouses', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_stat']) ?>
                <fieldset>
                    <?php echo $this->Form->control('WH_ID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                    <?php echo $this->Form->control('isactive', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> CONFIRM'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
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

        $('#statWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $(e.currentTarget).find('input[name="WH_ID"]').val(warehouseId);
            $('#frm_stat input[name="isactive"]').val(stat);
        });
    });

</script>

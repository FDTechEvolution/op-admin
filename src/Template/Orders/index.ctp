<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">ออเดอร์</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
        <?= $this->Form->create('orderChangeStatusArray' , ['url' => ['controller' => 'orders', 'action' => 'orderChangeStatusArray'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <div class="row">
                <div class="col-md-2">
                <?php echo $this->Form->control('status', ['options' => $status, 'empty' => '(choose once)', 'class' => 'form-control', 'data-live-search' => 'true', 'id' => 'province-select', 'label' => false, 'id' => 'province']); ?>
                </div>
                <div class="col-md-2">
                    <?= $this->Form->button(__('จัดการ'), ['class' => 'btn btn-secondary w-md waves-effect waves-light m-b-5', 'escape' => false]) ?>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6 text-right">
                    <?= $this->Html->link(__('<i class="fa fa-cart-plus"></i> เพิ่มออเดอร์'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addOrder', 'escape' => false]) ?>
                </div>
            </div>
            <hr/>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center"><?= __('วันที่ออเดอร์') ?></th>
                        <th scope="col"><?= __('ลูกค้า') ?></th>
                        <th scope="col" class="text-center"><?= __('การชำระเงิน') ?></th>
                        <th scope="col" class="text-center"><?= __('ราคารวม') ?></th>
                        <th scope="col" class="text-center"><?= __('การจัดส่ง') ?></th>
                        <th scope="col" class="text-center"><?= __('Tracking') ?></th>
                        <th scope="col" class="text-center"><i class="mdi mdi-check-all"></i></th>
                        <th scope="col" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td class="text-center"><?= $order->orderdate->i18nFormat(DATE_FORMATE, null, TH_DATE) ?></td>
                        <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                        <td class="text-center"><?= h($order->payment_method) ?></td>
                        <td class="text-center"><?= $this->Number->format($order->totalamt) ?> ฿</td>
                        <td class="text-center"><?= h($order->shipping) ?></td>
                        <td class="text-center"><?= isset($order->trackingno)?$order->trackingno.' '.$this->Html->link(__('<i class="mdi mdi-tooltip-edit" title="แก้ไข Tracking"></i>'), ['action' => 'editTracking'], ['data-toggle' => 'modal', 'data-target' => '#editTracking', 'data-id' => $order->id, 'data-tracking' => $order->trackingno, 'escape' => false]):$this->Html->link(__('<i class="mdi mdi-truck-delivery"></i> เพิ่ม Tracking'), ['action' => 'addTracking'], ['data-toggle' => 'modal', 'data-target' => '#addTracking', 'data-id' => $order->id, 'escape' => false]); ?></td>
                        <td class="text-center"><?=$this->Form->checkbox('orders[].order_id',['value' => $order->id, 'disabled'=>(in_array($order->status,['CO','VO'])?true:false)]); ?></td>
                        <td class="text-center">
                            <?php if(h($order->status) == "DR" || h($order->status) == "DX") :
                                echo "<button class='btn btn-success disabled m-b-5'><i class='mdi mdi-selection'></i> Draft</button>";
                            elseif(h($order->status) == "CO") :
                                echo "<button class='btn btn-primary disabled m-b-5'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                            elseif(h($order->status) == "VO") :
                                echo "<button class='btn btn-danger disabled m-b-5'><i class='mdi mdi-window-close'></i> Void</button>";
                            endif; ?>
                        </td>
                        <td class="actions text-center">
                            <?php if(h($order->status) == "DR" || h($order->status) == "DX") : ?>
                                    <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $order->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $order->id], ['confirm' => __('ยืนยันการลบรายการนี้ #{0}?', $order->documentno), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                <?php elseif(h($order->status) == "CO") : ?>
                                    <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'edit', $order->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $order->id], ['confirm' => __('ยืนยันการลบรายการนี้ #{0}?', $order->documentno), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                <?php elseif(h($order->status) == "VO") : ?>
                                    <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'edit', $order->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>


<!-- ADD ORDER -->
<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="addOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderLabel">เพิ่มรายการ Order</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('order', ['url'=>['controller'=>'orders', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายชื่อพนักงาน</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายชื่อลูกค้า</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('customer_id', ['options' => $customers, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">การชำระเงิน</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('payment_method', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">การจัดส่ง</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('shipping', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียด</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
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

<!-- ADD TRACKING -->
<div class="modal fade" id="addTracking" tabindex="-1" role="dialog" aria-labelledby="addTrackingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrackingLabel">เพิ่ม Tracking</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('tracking', ['url'=>['controller'=>'orders', 'action'=>'addTracking'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-4 col-form-label">หมายเลข Tracking</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('trackingno', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->control('order_id', ['type' => 'hidden', 'value' => $order->id]) ?>
                    <?= $this->Form->control('pointer', ['type' => 'hidden', 'value' => 'index']) ?>
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


<!-- EDIT TRACKING -->
<div class="modal fade" id="editTracking" tabindex="-1" role="dialog" aria-labelledby="editTrackingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTrackingLabel">แก้ไข Tracking</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('tracking', ['url'=>['controller'=>'orders', 'action'=>'addTracking'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'frm_edit']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="padding: 20px;">
                            <div class="form-group row">
                                <label class="col-4 col-form-label">หมายเลข Tracking</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('trackingno', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->control('order_id', ['type' => 'hidden', 'value' => $order->id]) ?>
                    <?= $this->Form->control('pointer', ['type' => 'hidden', 'value' => 'index']) ?>
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
    $('#addTracking').on('show.bs.modal', function (e) {
        var orderId = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="order_id"]').val(orderId);
    });
        
    $('#editTracking').on('show.bs.modal', function (e) {
        var orderId = $(e.relatedTarget).data('id');
        var tracking = $(e.relatedTarget).data('tracking');
                
        $(e.currentTarget).find('input[name="order_id"]').val(orderId);
        $(e.currentTarget).find('input[name="trackingno"]').val(tracking);
    });

    $(document).ready(function () {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });

</script>

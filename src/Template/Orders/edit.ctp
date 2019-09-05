<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<div class="productCategories view large-9 medium-8 columns content">
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>เพิ่มรายการออเดอร์สินค้า</h3>
            <?= $this->Html->link(__('<i class="ti-arrow-circle-left"></i> รายการออเดอร์ทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-8" style="border-radius: 5px; border: 1px solid #ddd; padding: 20px; margin-right: 20px;">
                <div class="row">
                    <div class="col-3">
                        <label class="col-12 col-form-label"><strong>วันที่</strong></label>
                        <div class="col-12">
                            <?= $order->orderdate->i18nFormat(DATE_FORMATE, null, TH_DATE) ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="col-12 col-form-label"><strong>ลูกค้า</strong></label>
                        <div class="col-12">
                            <?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="col-12 col-form-label"><strong>การชำระเงิน</strong></label>
                        <div class="col-12">
                            <?= $order->payment_method ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <label class="col-12 col-form-label"><strong>การขนส่ง</strong></label>
                        <div class="col-12">
                            <?= $order->shipping ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <label class="col-12 col-form-label"><strong>พนักงาน</strong></label>
                        <div class="col-12">
                            <?= $order->has('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <label class="col-12 col-form-label"><strong>Tracking</strong></label>
                        <div class="col-12">
                            <?= isset($order->trackingno)?$order->trackingno.'<br/>'.$this->Html->link(__('<i class="mdi mdi-truck-delivery"></i> แก้ไข Tracking'), ['action' => 'editTracking'], ['data-toggle' => 'modal', 'data-target' => '#editTracking', 'data-id' => $order->id, 'data-tracking' => $order->trackingno, 'escape' => false]):$this->Html->link(__('<i class="mdi mdi-truck-delivery"></i> เพิ่ม Tracking'), ['action' => 'addTracking'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addTracking', 'escape' => false]); ?>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <label class="col-12 col-form-label"><strong>ราคาทั้งหมด</strong></label>
                        <div class="col-12">
                            <?= $this->Number->format($order->totalamt).' ฿' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3" style="border-radius: 5px; border: 1px solid #ddd; padding: 20px;">
                <div class="row">
                    <label class="col-12 col-form-label text-center"><strong>สถานะออเดอร์</strong></label>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if(h($order->status) == "DR" || h($order->status) == "DX") :
                            echo "<button class='btn btn-success disabled m-b-5' style='width: 60%;'><i class='mdi mdi-selection'></i> Draft</button>";
                        elseif(h($order->status) == "CO") :
                            echo "<button class='btn btn-primary disabled m-b-5' style='width: 60%;'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                        elseif(h($order->status) == "VO") :
                            echo "<button class='btn btn-danger disabled m-b-5' style='width: 60%;'><i class='mdi mdi-window-close'></i> Void</button>";
                        endif; ?>
                    </div>
                </div>
                <hr>
                <?php if($order->status == "DR" || $order->status == "DX") : ?>
                    <div class="row">
                        <div class="col-12 text-center" style="padding-bottom: 0.3em;"><strong>การจัดการออเดอร์</strong></div>
                        <div class="col-6 text-center">
                            <?= $this->Form->create('orderConfirm' , ['url' => ['controller' => 'orders', 'action' => 'orderConfirm'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
                                <?php if(h($order->status) == "DR") : ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-briefcase-download"></i> บันทึก'), ['class' => 'btn btn-secondary btn-block disabled m-b-5', 'type' => 'button', 'escape' => false]) ?>
                                <?php elseif(h($order->status) == "DX") : ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-briefcase-download"></i> บันทึก'), ['class' => 'btn btn-primary btn-block m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                                <?php endif; ?>
                                <?= $this->Form->control('order_id', ['type' => 'hidden', 'value' => $order->id]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="col-6 text-center">
                            <?= $this->Form->create('orderCancel' , ['url' => ['controller' => 'Orders', 'action' => 'orderCancel'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-window-close"></i> ละทิ้ง'), ['confirm' => __('ยืนยันการยกเลิกรายการนี้ทั้งหมด ?'), 'class' => 'btn btn-danger btn-block m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                                <?= $this->Form->control('order_id', ['type' => 'hidden', 'value' => $order->id]) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3 style="margin-right: 20px;">รายการสินค้า</h3>
            <?php if($order->status == "DR" || $order->status == "DX") : ?>
                <button class='btn btn-primary m-b-5' style="cursor: pointer;" onclick="cloneRow()" style="margin-left: 20px;"><i class='mdi mdi-plus-circle'></i> เพิ่มรายการสินค้า</button>
                <button class='btn btn-danger m-b-5' style="cursor: pointer;" id="delRow[]" onclick="delRow()"><i class='mdi mdi-window-close'></i> ลบรายการสินค้า</button>
            <?php endif; ?>
        </div>
        <hr>
        <?= $this->Form->create('orderline', ['url' => ['controller' => 'orders', 'action' => 'addToOrderLines'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <table id="productTable" style="width: 80%;" cellpadding="5">
                <tbody id="tableToModify">
                    <?php
                    foreach($orderlines as $orderline) : ?>
                        <tr id="rowData" style="margin-bottom: 20px;">
                            <td width="150">
                                <strong style="vertical-align: middle;">สินค้า</strong>
                                <?php echo $this->Form->control('products[].product_id', ['options' => $products, 'class' => 'form-control select2', 'label' => false, 'val' => $orderline->product_id, 'disabled'=>(in_array($order->status,['CO','VO'])?true:false)]); ?>
                            </td>
                            <td width="100" class="text-center">
                                <strong style="vertical-align: middle;">จำนวน</strong>
                                <?php echo $this->Form->control('qtys[].qty', ['class' => 'form-control text-center', 'type' => 'number', 'value' => $orderline->qty, 'label' => false, 'disabled'=>(in_array($order->status,['CO','VO'])?true:false)]); ?>
                            </td>
                            <td width="100" class="text-center">
                                <strong style="vertical-align: middle;">ราคาต่อชิ้น (฿)</strong>
                                <p id="price"><?= number_format($orderline->price) ?></p>
                            </td>
                            <td width="100" class="text-center">
                                <strong style="vertical-align: middle;">ราคารวม (฿)</strong>
                                <p id="price-amount"><?= number_format($orderline->amount) ?></p>
                            </td>
                            <?php echo $this->Form->control('ODids[].ODid', ['type' => 'hidden', 'value' => $orderline->id]); ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php if($order->status == "DR" || $order->status == "DX") : ?>
                        <tr id="rowToClone" style="margin-bottom: 20px;">
                            <td width="150">
                                <strong style="vertical-align: middle;">สินค้า</strong>
                                <?php echo $this->Form->control('products[].product_id', ['options' => $products, 'class' => 'form-control select2', 'onChange' => 'productPrice();', 'id' => 'productname', 'label' => false]); ?>
                            </td>
                            <td width="100" class="text-center">
                                <strong style="vertical-align: middle;">จำนวน</strong>
                                <?php echo $this->Form->control('qtys[].qty', ['class' => 'form-control text-center', 'type' => 'number', 'label' => false]); ?>
                            </td>
                            <td width="100"></td>
                            <td width="100"></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo $this->Form->control('order_id', ['type' => 'hidden', 'value' => $order->id]); ?>
            <br>
            <hr>
            <br>
            <?php if($order->status == "DR" || $order->status == "DX") : ?>
                <div class="row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save-settings"></i> บันทึกรายการสินค้า'), ['class' => 'btn btn-primary m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?= $this->Form->end() ?>
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


<!--FooTable-->
<?= $this->html->script("/plugins/footable/js/footable.all.min.js") ?>
<!--FooTable Example-->
<?= $this->html->script("Shipment-jquery.footable.js") ?>

<?= $this->html->script("/plugins/switchery/switchery.min.js") ?>

<!-- Examples -->
<?= $this->html->script("/plugins/magnific-popup/dist/jquery.magnific-popup.min.js") ?>
<?= $this->html->script("/plugins/datatables/jquery.dataTables.min.js") ?>
<?= $this->html->script("/plugins/datatables/dataTables.bootstrap4.min.js") ?>
<?= $this->html->script("/plugins/tiny-editable/mindmup-editabletable.js") ?>
<?= $this->html->script("/plugins/tiny-editable/numeric-input-example.js") ?>

<?= $this->html->script("Shipment-datatables.editable.init.js") ?>

<?= $this->html->script("jquery.core.js") ?>
<?= $this->html->script("jquery.app.js") ?>

<script type="text/javascript">
    $('#editTracking').on('show.bs.modal', function (e) {
        var orderId = $(e.relatedTarget).data('id');
        var tracking = $(e.relatedTarget).data('tracking');
            
        $(e.currentTarget).find('input[name="order_id"]').val(orderId);
        $(e.currentTarget).find('input[name="trackingno"]').val(tracking);
    });

    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();

    function cloneRow() {
      var row = document.getElementById("rowToClone"); // find row to copy
      var table = document.getElementById("tableToModify"); // find table to append to
      var clone = row.cloneNode(true); // copy children too
      clone.id = "newID"; // change id or other attributes/contents
      table.appendChild(clone); // add new row to end of table
    }
    function delRow() {
        document.getElementById("newID").remove();
    }
</script>
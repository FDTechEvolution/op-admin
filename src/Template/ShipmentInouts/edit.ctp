<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ShipmentInout $shipmentInout
 */
?>
<div class="productCategories view large-9 medium-8 columns content">
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>เพิ่มรายการรับสินค้าเข้าสู่คลังสินค้า</h3>
            <?= $this->Html->link(__('<i class="ti-arrow-circle-left"></i> รายการรับสินค้าทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-8" style="border-radius: 5px; border: 1px solid #ddd; padding: 20px; margin-right: 20px;">
                <div class="row">
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>จากคลังสินค้า</strong></label>
                        <div class="col-12">
                        <?= $shipmentInout->has('FromWarehouses') ? $this->Html->link($shipmentInout->FromWarehouses->name, ['controller' => 'Warehouses', 'action' => 'view', $shipmentInout->FromWarehouses->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>ไปยังคลังสินค้า</strong></label>
                        <div class="col-12">
                        <?= $shipmentInout->has('ToWarehouses') ? $this->Html->link($shipmentInout->ToWarehouses->name, ['controller' => 'Warehouses', 'action' => 'view', $shipmentInout->ToWarehouses->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>วันที่</strong></label>
                        <div class="col-12">
                            <?= h($shipmentInout->docdate) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>พาร์ทเนอร์</strong></label>
                        <div class="col-12">
                        <?= $shipmentInout->has('bpartner') ? $this->Html->link($shipmentInout->bpartner->name, ['controller' => 'Bpartners', 'action' => 'view', $shipmentInout->bpartner->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>พนักงาน</strong></label>
                        <div class="col-12">
                        <?= $shipmentInout->has('user') ? $this->Html->link($shipmentInout->user->name, ['controller' => 'Users', 'action' => 'view', $shipmentInout->user->id]) : '' ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="col-12 col-form-label"><strong>รายละเอียด</strong></label>
                        <div class="col-12">
                            <?= h($shipmentInout->description); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3" style="border-radius: 5px; border: 1px solid #ddd; padding: 20px;">
                <div class="row">
                    <label class="col-12 col-form-label text-center"><strong>สถานะรายการรับสินค้า</strong></label>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if(h($shipmentInout->status) == "DR" || h($shipmentInout->status) == "DX") :
                            echo "<button class='btn btn-success disabled m-b-5' style='width: 60%;'><i class='mdi mdi-selection'></i> Draft</button>";
                        elseif(h($shipmentInout->status) == "CO") :
                            echo "<button class='btn btn-primary disabled m-b-5' style='width: 60%;'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                        elseif(h($shipmentInout->status) == "VO") :
                            echo "<button class='btn btn-danger disabled m-b-5' style='width: 60%;'><i class='mdi mdi-window-close'></i> Void</button>";
                        endif; ?>
                    </div>
                </div>
                <hr>
                <?php if($shipmentInout->status == "DR" || $shipmentInout->status == "DX") : ?>
                    <div class="row">
                        <div class="col-12 text-center" style="padding-bottom: 0.3em;"><strong>การจัดการคลังสินค้า</strong></div>
                        <div class="col-6 text-center">
                            <?= $this->Form->create('shipmentConfirm' , ['url' => ['controller' => 'shipmentInouts', 'action' => 'addtowarehouse'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
                                <?php if(h($shipmentInout->status) == "DR") : ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-briefcase-download"></i> นำเข้าสินค้า'), ['class' => 'btn btn-secondary btn-block disabled m-b-5', 'type' => 'button', 'escape' => false]) ?>
                                <?php elseif(h($shipmentInout->status) == "DX") : ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-briefcase-download"></i> นำเข้าสินค้า'), ['class' => 'btn btn-primary btn-block m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                                <?php endif; ?>
                                <?php echo $this->Form->control('shipment_inout_id', ['type' => 'hidden', 'value' => $shipmentInout->id]); ?>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="col-6 text-center">
                            <?= $this->Form->create('shipmentConfirm' , ['url' => ['controller' => 'shipmentInouts', 'action' => 'endofwarehouse'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
                                <?= $this->Form->button(__('<i class="mdi mdi-window-close"></i> ละทิ้ง'), ['confirm' => __('ยืนยันการยกเลิกรายการนี้ทั้งหมด ?'), 'class' => 'btn btn-danger btn-block m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                                <?php echo $this->Form->control('shipment_inout_id', ['type' => 'hidden', 'value' => $shipmentInout->id]); ?>
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
            <?php if($shipmentInout->status == "DR" || $shipmentInout->status == "DX") : ?>
                <button class='btn btn-primary m-b-5' style="cursor: pointer;" onclick="cloneRow()" style="margin-left: 20px;"><i class='mdi mdi-plus-circle'></i> เพิ่มรายการสินค้า</button>
                <button class='btn btn-danger m-b-5' style="cursor: pointer;" id="delRow[]" onclick="delRow()"><i class='mdi mdi-window-close'></i> ลบรายการสินค้า</button>
            <?php endif; ?>
        </div>
        <hr>
        <?= $this->Form->create('shipment', ['url' => ['controller' => 'shipmentInouts', 'action' => 'addShipment'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <table id="productTable" style="width: 70%;">
                <tbody id="tableToModify">
                    <?php
                    foreach($SMproducts as $SMproduct) : ?>
                        <tr id="rowData" style="margin-bottom: 20px;">
                            <td style="width: 5%;">
                                <strong style="vertical-align: middle;">สินค้า</strong>
                            </td>
                            <td style="width: 20%;">
                                <?php echo $this->Form->control('products[].product_id', ['options' => $products, 'class' => 'form-control select2', 'label' => false, 'val' => $SMproduct->product_id, 'disabled'=>(in_array($shipmentInout->status,['CO','VO'])?true:false)]); ?>
                            </td>
                            <td class="text-center" style="width: 5%;">
                                <strong style="vertical-align: middle;">จำนวน</strong>
                            </td>
                            <td class="text-center" style="width: 10%;">
                                <?php echo $this->Form->control('qtys[].qty', ['class' => 'form-control text-center', 'type' => 'number', 'value' => $SMproduct->qty, 'label' => false, 'disabled'=>(in_array($shipmentInout->status,['CO','VO'])?true:false)]); ?>
                            </td>
                            <?php echo $this->Form->control('SMids[].SMid', ['type' => 'hidden', 'value' => $SMproduct->id]); ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php if($shipmentInout->status == "DR" || $shipmentInout->status == "DX") : ?>
                        <tr id="rowToClone" style="margin-bottom: 20px;">
                            <td style="width: 5%;">
                                <strong style="vertical-align: middle;">สินค้า</strong>
                            </td>
                            <td style="width: 20%;">
                                <?php echo $this->Form->control('products[].product_id', ['options' => $products, 'class' => 'form-control select2', 'label' => false]); ?>
                            </td>
                            <td class="text-center" style="width: 5%;">
                                <strong style="vertical-align: middle;">จำนวน</strong>
                            </td>
                            <td class="text-center" style="width: 10%;">
                                <?php echo $this->Form->control('qtys[].qty', ['class' => 'form-control text-center', 'type' => 'number', 'label' => false]); ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo $this->Form->control('shipment_inout_id', ['type' => 'hidden', 'value' => $shipmentInout->id]); ?>
            <br>
            <hr>
            <br>
            <?php if($shipmentInout->status == "DR" || $shipmentInout->status == "DX") : ?>
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-2 text-center">
                        <?= $this->Form->button(__('<i class="mdi mdi-content-save-settings"></i> บันทึก'), ['class' => 'btn btn-primary btn-block m-b-5', 'style' => 'cursor: pointer;', 'escape' => false]) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?= $this->Form->end() ?>
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

<script>
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
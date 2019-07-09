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
                <hr>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php if(h($shipmentInout->status) == "DR") :
                            echo "<button class='btn btn-success disabled m-b-5' style='width: 60%;'><i class='mdi mdi-selection'></i> Draft</button>";
                        elseif(h($shipmentInout->status) == "CO") :
                            echo "<button class='btn btn-primary disabled m-b-5' style='width: 60%;'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                        elseif(h($shipmentInout->status) == "VO") :
                            echo "<button class='btn btn-danger disabled m-b-5' style='width: 60%;'><i class='mdi mdi-window-close'></i> Void</button>";
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>รายการสินค้า</h3>
            <button class='btn btn-primary m-b-5' onclick="cloneRow()" style="margin-left: 20px;"><i class='mdi mdi-plus-circle'></i> เพิ่มรายการสินค้า</button>
            <button class='btn btn-danger m-b-5' id="delRow[]" onclick="delRow()"><i class='mdi mdi-window-close'></i> ลบรายการสินค้า</button>
        </div>
        <hr>
        <?= $this->Form->create('shipment', ['url' => ['controller' => 'shipmentInouts', 'action' => 'addShipment'], 'class' => 'form-horizontal', 'role' => 'form']); ?>
            <table id="productTable" style="width: 70%;">
                <tbody id="tableToModify">
                    <tr id="rowToClone" style="margin-bottom: 20px;">
                        <td style="width: 5%;">
                            <strong style="vertical-align: middle;">สินค้า</strong>
                        </td>
                        <td style="width: 20%;">
                            <?php echo $this->Form->control('product_id[]', ['options' => $products, 'class' => 'form-control select2', 'label' => false]); ?>
                        </td>
                        <td class="text-center" style="width: 5%;">
                            <strong style="vertical-align: middle;">จำนวน</strong>
                        </td>
                        <td class="text-center" style="width: 10%;">
                            <?php echo $this->Form->control('qty[]', ['class' => 'form-control text-center', 'type' => 'number', 'label' => false]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php echo $this->Form->control('shipment_inout_id', ['type' => 'hidden', 'value' => $shipmentInout->id]); ?>
            <br>
            <hr>
            <br>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-2 text-center">
                    <?= $this->Form->button(__('<i class="mdi mdi-content-save-settings"></i> บันทึก'), ['class' => 'btn btn-primary btn-block m-b-5', 'escape' => false]) ?>
                </div>
                <div class="col-2 text-center">
                    <?= $this->Form->button(__('<i class="mdi mdi-window-close"></i> ละทิ้ง'), ['class' => 'btn btn-danger btn-block m-b-5', 'escape' => false]) ?>
                </div>
            </div>
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
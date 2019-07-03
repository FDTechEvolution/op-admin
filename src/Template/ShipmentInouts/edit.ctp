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
                    <div class="col-12 text-center">
                        <?php if(h($shipmentInout->status) == "DR") :
                            echo "<button class='btn btn-success disabled m-b-5'><i class='mdi mdi-selection'></i> Draft</button>";
                        elseif(h($shipmentInout->status) == "CO") :
                            echo "<button class='btn btn-primary disabled m-b-5'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                        elseif(h($shipmentInout->status) == "VO") :
                            echo "<button class='btn btn-danger disabled m-b-5'><i class='mdi mdi-window-close'></i> Void</button>";
                        endif; ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label class="col-12 col-form-label text-center"><strong>การจัดการ</strong></label>
                    <div class="col-6 text-center">
                        <button class='btn btn-primary disabled m-b-5'><i class='mdi mdi-content-save-settings'></i> บันทึก</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class='btn btn-danger disabled m-b-5'><i class='mdi mdi-window-close'></i> ละทิ้ง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box">
        <div class="row" style="display: -webkit-box;">
            <h3>เพิ่มรายการสินค้า</h3>
        </div>
    </div>
</div>

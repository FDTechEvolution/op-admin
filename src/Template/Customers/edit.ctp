<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Edit Customer</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-left">
                     <?= $this->Html->link(__('< ลูกค้าทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                        <?= $this->Form->create($customer, ['class'=>'form-horizontal', 'role'=>'form']) ?>
                        <fieldset>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">ชื่อลูกค้า</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('name', ['class'=>'form-control', 'label'=>false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">โทรศัพท์</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('mobile', ['class'=>'form-control', 'type' => 'number', 'label'=>false]); ?>
                                </div>
                            </div>
                    <?php
                        foreach ($addressTable as $address) :
                    ?>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">ที่อยู่</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('line1', ['class'=>'form-control', 'value' => $address->line1, 'label'=>false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">แขวง/ตำบล</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('subdistrict', ['class'=>'form-control', 'value' => $address->subdistrict, 'label'=>false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">เขต/อำเภอ</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('district', ['class'=>'form-control', 'value' => $address->district, 'label'=>false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">จังหวัด</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('province', ['class'=>'form-control', 'value' => $address->province, 'label'=>false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('zipcode', ['class'=>'form-control', 'value' => $address->zipcode, 'type' => 'number', 'label'=>false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('address_id', ['class'=>'form-control', 'value' => $address->id, 'type' => 'hidden', 'label'=>false]); ?>
                    <?php
                        endforeach;
                    ?>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">รายละเอียด</label>
                                <div class="col-8">
                                    <?php echo $this->Form->control('description', ['class'=>'form-control', 'label'=>false]); ?>
                                </div>
                            </div>
                        </fieldset>
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> UPDATE'), ['class'=>'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape'=>false]) ?>
                                </div>
                            </div>
                        <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

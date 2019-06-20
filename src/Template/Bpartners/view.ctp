<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bpartner $bpartner
 */
?>
<style>
    div#datatable-buttons_filter {
        display: none;
    }
    table.vertical-table tbody tr th {
        line-height: 36px;
        width: 200px;
    }
    .table td{
        vertical-align: middle;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <?php 
                $modalPartner = [
                    'data-id' => $bpartner->id,
                    'data-company' => $bpartner->company,
                    'data-name' => $bpartner->name,
                    'data-mobile' => $bpartner->mobile,
                    'data-level' => $bpartner->level,
                    'data-description' => $bpartner->description,
                    'class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5',
                    'data-toggle' => 'modal',
                    'data-target' => '#editPartnerModal',
                    'escape' => false
                    ];
            ?>
                <div class="bpartners view large-9 medium-8 columns content">
                    <div class="row">
                        <div class="col-6" style="display: -webkit-box;">
                            <h3><i class="fa fa-address-card-o"></i> รายละเอียด Partner</h3>
                            <?= $this->Html->link(__('<i class="mdi mdi-account-multiple"></i> All Partner'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'margin-left: 20px;', 'escape' => false]) ?>
                        </div>
                        <div class="col-6 text-right">
                            <?= $this->Html->link(__('<i class="fa fa-edit (alias)"></i> แก้ไขรายละเอียด Partner'), ['action' => 'edit'], $modalPartner) ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-5" style="padding: 0 0 0 30px;">
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('<i class="ti-home"></i> บริษัท/ห้างร้าน : ') ?></th>
                                    <td><?= h($bpartner->company) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('<i class="ti-user"></i> ชื่อผู้ติดต่อ : ') ?></th>
                                    <td><?= h($bpartner->name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('<i class="ti-mobile"></i> หมายเลขโทรศัพท์ : ') ?></th>
                                    <td><?= h($bpartner->mobile) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('<i class="ti-crown"></i> ระดับ : ') ?></th>
                                    <td><?= h($bpartner->level) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <table>
                                    <tr>
                                        <th><h5><?= __('<i class="mdi mdi-comment-text-outline"></i> รายละเอียดเพิ่มเติม....') ?></h5></th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 30px;">
                                            <?php
                                                if($bpartner->description != "") :
                                            ?>
                                                    <?= $this->Text->autoParagraph(h($bpartner->description)); ?>
                                            <?php
                                                else :
                                            ?>
                                                    <?= $this->Text->autoParagraph(h('ไม่มีการระบุรายละเอียดเพิ่มเติมใดๆ.......')); ?>
                                            <?php
                                                endif;
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="card-box">
            <div class="row">
                <div class="col-6">
                    <h3><i class="fa fa-map-marker"></i> รายละเอียดที่อยู่</h3>
                </div>
                <div class="col-6 text-right">
                    <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> เพิ่มที่อยู่'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addAddressPartnerModal', 'escape' => false]) ?>
                </div>
            </div>
            <hr>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;"><?= $this->Paginator->sort('ลำดับ') ?></th>
                        <th scope="col" style="width: 70%;" class="text-center"><?= __('ที่อยู่') ?></th>
                        <th scope="col" style="width: 25%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($bpartner->bpartner_addresses as $key => $bpAddress): ?>
                    <?php $address = $bpAddress->address;?>
                    <tr>
                        <td class="text-center"><?=($key+1)?></td>
                        <td><?= h($address->line1)." ต.".h($address->subdistrict)." อ.".h($address->district)." จ.".h($address->province)." ".h($address->zipcode)?></td>
                        <td class="actions text-center">
                            <?php
                                $modalOpts = [
                                    'data-id'=>$address->id,
                                    'data-line1'=>$address->line1,
                                    'data-subdistrict'=>$address->subdistrict,
                                    'data-district'=>$address->district,
                                    'data-province'=>$address->province,
                                    'data-zipcode'=>$address->zipcode,
                                    'data-partner' => $bpartner->id,
                                    'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                    'style' => 'margin-right: 20px;',
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#editPartnerAddress',
                                    'escape' => false
                                ];
                                $modalDelete = [
                                    'data-id'=>$address->id,
                                    'data-partner'=>$bpartner->id,
                                    'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5',
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#deletePartnerAddress',
                                    'escape' => false
                                ];
                            ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'index'], $modalOpts ) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delAddress'], $modalDelete) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Partner -->
<div class="modal fade" id="editPartnerModal" tabindex="-1" role="dialog" aria-labelledby="editPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartnerModalLabel">รายละเอียด</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url'=>['controler'=>'bpartners', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_edit']) ?>
                <fieldset>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><i class="ti-home"></i> บริษัท/ห้างร้าน</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('company', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><i class="ti-user"></i> ชื่อผู้ติดต่อ</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><i class="ti-mobile"></i> หมายเลขโทรศัพท์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><i class="ti-crown"></i> ระดับ</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('level', ['class' => 'form-control level-disable', 'label' => false, 'disabled']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label"><i class="mdi mdi-comment-text-outline"></i> รายละเอียดเพิมเติม</label>
                        <div class="col-9">
                            <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->control('partnerID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> UPDATE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<!-- Edit Partner Address -->
<div class="modal fade" id="editPartnerAddress" tabindex="-1" role="dialog" aria-labelledby="editPartnerAddressLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartnerAddressLabel">แก้ไขรายละเอียดที่อยู่</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('address', ['url'=>['controler'=>'bpartners', 'action'=>'editAddress'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_edit_address']) ?>
                <fieldset>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">เลขที่ ถนน อาคาร</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('line1', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">แขวง/ตำบล</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('subdistrict', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">เขต/อำเภอ</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('district', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">จังหวัด</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('province', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">รหัสไปรษณีย์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('zipcode', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                        <div class="col-9">
                            <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->control('addressID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                    <?php echo $this->Form->control('partnerID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> UPDATE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?= $this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<!-- ADD PARTNER ADDRESS -->
<div class="modal fade" id="addAddressPartnerModal" tabindex="-1" role="dialog" aria-labelledby="addAddressPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addPartnerModalLabel">เพิ่มรายละเอียดที่อยู่</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url'=>['controller'=>'bpartners', 'action'=>'addAddress'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-12" style="border-left: 1px solid #ddd; padding: 20px;">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">เลขที่ ถนน อาคาร</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('line1', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">แขวง/ตำบล</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('subdistrict', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">เขต/อำเภอ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('district', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">จังหวัด</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('province', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รหัสไปรษณีย์</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('zipcode', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->control('partnerID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden', 'value' => $bpartner->id]) ?>
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

<!-- DELETE ADDRESS -->
<div class="modal fade" id="deletePartnerAddress" tabindex="-1" role="dialog" aria-labelledby="deletePartnerAddressLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePartnerAddressLabel">ลบที่อยู่ Partner</h5>
            </div>
            <div class="modal-body">
                ยืนยันการลบที่อยู่นี้...?
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('user', ['url'=>['controler'=>'bpartners', 'action'=>'delAddress'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_del']) ?>
                <fieldset>
                    <?php echo $this->Form->control('addressID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
                    <?php echo $this->Form->control('partnerID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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
            lengthChange: false
            //buttons: ['copy', 'excel', 'pdf']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        $('#editPartnerModal').on('show.bs.modal', function (e) {
            var partnerId = $(e.relatedTarget).data('id');
            var company = $(e.relatedTarget).data('company');
            var name = $(e.relatedTarget).data('name');
            var mobile = $(e.relatedTarget).data('mobile');
            var level = $(e.relatedTarget).data('level');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="partnerID"]').val(partnerId);
            $('#frm_edit input[name="company"]').val(company);
            $('#frm_edit input[name="name"]').val(name);
            $('#frm_edit input[name="mobile"]').val(mobile);
            $('#frm_edit input[name="level"]').val(level);
            $('#frm_edit textarea[name="description"]').val(description);
        });

        $('#editPartnerAddress').on('show.bs.modal', function (e) {
            var addressId = $(e.relatedTarget).data('id');
            var line1 = $(e.relatedTarget).data('line1');
            var subdistrict = $(e.relatedTarget).data('subdistrict');
            var district = $(e.relatedTarget).data('district');
            var province = $(e.relatedTarget).data('province');
            var zipcode = $(e.relatedTarget).data('zipcode');
            var description = $(e.relatedTarget).data('description');
            var partnerId = $(e.relatedTarget).data('partner');
            
            $(e.currentTarget).find('input[name="addressID"]').val(addressId);
            $(e.currentTarget).find('input[name="partnerID"]').val(partnerId);
            $('#frm_edit_address input[name="line1"]').val(line1);
            $('#frm_edit_address input[name="subdistrict"]').val(subdistrict);
            $('#frm_edit_address input[name="district"]').val(district);
            $('#frm_edit_address input[name="province"]').val(province);
            $('#frm_edit_address input[name="zipcode"]').val(zipcode);
            $('#frm_edit_address textarea[name="description"]').val(description);
        });

        $('#deletePartnerAddress').on('show.bs.modal', function (e) {
            var addressId = $(e.relatedTarget).data('id');
            var partnerId = $(e.relatedTarget).data('partner');
            
            $(e.currentTarget).find('input[name="addressID"]').val(addressId);
            $(e.currentTarget).find('input[name="partnerID"]').val(partnerId);
        });
    });

</script>
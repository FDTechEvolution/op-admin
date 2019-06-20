<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bpartner[]|\Cake\Collection\CollectionInterface $bpartners
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Bussiness Partner</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="mdi mdi-account-multiple-plus"></i> เพิ่ม Partner'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addPartnerModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 15%;"><?= $this->Paginator->sort('org_id') ?></th>
                        <th scope="col" style="width: 20%;"><?= $this->Paginator->sort('บริษัท/ห้างร้าน') ?></th>
                        <th scope="col" style="width: 20%;"><?= $this->Paginator->sort('ชื่อผู้ติดต่อ') ?></th>
                        <th scope="col" style="width: 10%;" class="text-center"><?= $this->Paginator->sort('ระดับ') ?></th>
                        <th scope="col" style="width: 15%;" class="text-center"><?= __('โทรศัพท์') ?></th>
                        <th scope="col" style="width: 20%;" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bpartners as $bpartner): ?>
                    <tr>
                        <td><?= $bpartner->has('org') ? $this->Html->link($bpartner->org->name, ['controller' => 'Orgs', 'action' => 'view', $bpartner->org->id]) : '' ?></td>
                        <td>
                            <?php if($bpartner->company == ''){
                                echo "-----------";
                            }else{ ?>
                                <?= h($bpartner->company) ?>
                            <?php } ?>
                        </td>
                        <td><?= h($bpartner->name) ?></td>
                        <td class="text-center"><?= h($bpartner->level) ?></td>
                        <td class="text-center"><?= h($bpartner->mobile) ?></td>
                        <td class="actions text-center">
                            <?php
                                $modalOpts = [
                                    'data-id'=>$bpartner->id,
                                    'data-company'=>$bpartner->company,
                                    'data-name'=>$bpartner->name,
                                    'data-level'=>$bpartner->level,
                                    'data-mobile'=>$bpartner->mobile,
                                    'data-description'=>h($bpartner->description),
                                    'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5',
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#editPartnerModal',
                                    'escape' => false
                                ];
                            ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $bpartner->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'style' => 'margin-right: 10px;', 'escape' => false]) ?>
                                <!--<?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'index'], $modalOpts ) ?>-->
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $bpartner->id], ['confirm' => __('ยืนยันการลบ '.$bpartner->name.' ?', $bpartner->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD PARTNER -->
<div class="modal fade" id="addPartnerModal" tabindex="-1" role="dialog" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPartnerModalLabel">Add Bussiness Partner</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url'=>['controller'=>'bpartners', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row">
                        <div class="col-6" style="padding: 20px;">
                            <h3 style="margin-bottom: 20px;">รายละเอียดทั่วไป</h3>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Org</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('org_id', ['options' => $orgs, 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">บริษัท/ห้างร้าน (ถ้ามี)</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('company', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ชื่อ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ระดับ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->select('level', ['Vendor' => 'Vendor', 'Dealer' => 'Dealer'], ['empty' => '(choose one)', 'class' => 'form-control select2', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">โทรศัพท์</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">รายละเอียดเพิ่มเติม</label>
                                <div class="col-9">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6" style="border-left: 1px solid #ddd; padding: 20px;">
                            <h3 style="margin-bottom: 20px;">รายละเอียดที่อยู่</h3>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">ที่อยู่</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('line1', ['class' => 'form-control', 'placeholder' => 'เลขที่ ถนน หมู่บ้าน อาคาร ชั้น', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">แขวง/อำเภอ</label>
                                <div class="col-9">
                                    <?php echo $this->Form->control('subdistrict', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">เขต/ตำบล</label>
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

        $('#editPartnerModal').on('show.bs.modal', function (e) {
            var partnerId = $(e.relatedTarget).data('id');
            var company = $(e.relatedTarget).data('line1');
            var name = $(e.relatedTarget).data('name');
            var level = $(e.relatedTarget).data('level');
            var mobile = $(e.relatedTarget).data('mobile');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="partnerID"]').val(partnerId);
            $('#frm_edit input[name="company"]').val(company);
            $('#frm_edit input[name="name"]').val(name);
            $('#frm_edit select[name="level"]').val(level);
            $('#frm_edit input[name="mobile"]').val(mobile);
            $('#frm_edit textarea[name="description"]').val(description);
        });
    });

</script>

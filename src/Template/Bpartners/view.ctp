<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bpartner $bpartner
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('Edit'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addPartnerModal', 'escape' => false]) ?>
                </div>
            </div>

                <div class="bpartners view large-9 medium-8 columns content">
                    <h3><?= h($bpartner->name) ?></h3>
                    <table class="vertical-table">
                        <tr>
                            <th scope="row"><?= __('Company') ?></th>
                            <td><?= h($bpartner->company) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($bpartner->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Mobile') ?></th>
                            <td><?= h($bpartner->mobile) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Level') ?></th>
                            <td><?= h($bpartner->level) ?></td>
                        </tr>
                    </table>
                    <div class="row">
                        <h4><?= __('Description') ?></h4>
                        <?= $this->Text->autoParagraph(h($bpartner->description)); ?>
                    </div>
                </div>
        </div>

        <div class="card-box">
            <h3>Address</h3>
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('เพิ่มที่อยู่'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addPartnerModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;"><?= $this->Paginator->sort('ลำดับ') ?></th>
                        <th scope="col" style="width: 75%;" class="text-center"><?= __('ที่อยู่') ?></th>
                        <th scope="col" style="width: 20%;" class="actions text-center"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($addressTable as $address): ?>
                    <?php $no = 1; ?>
                    <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td><?= h($address->line1)." ".h($address->subdistrict)." ".h($address->district)." ".h($address->province)." ".h($address->zipcode)?></td>
                        <td class="actions text-center">
                            <?php
                                $modalOpts = [
                                    'data-id'=>$address->id,
                                    'data-line1'=>$address->line1,
                                    'data-subdistrict'=>$address->subdistrict,
                                    'data-district'=>$address->district,
                                    'data-province'=>$address->province,
                                    'data-zipcode'=>$address->zipcode,
                                    'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 
                                    'data-toggle' => 'modal', 
                                    'data-target' => '#editPartnerModal',
                                    'escape' => false
                                ];
                            ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'index'], $modalOpts ) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $bpartner->id], ['confirm' => __('ยืนยันการลบ '.$bpartner->name.' ?', $bpartner->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartnerModalLabel">รายละเอียดที่อยู่</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('partner', ['url'=>['controler'=>'bpartners', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_edit']) ?>
                <fieldset>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Address</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('line1', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Subdistrict</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('subdistrict', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">District</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('district', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Province</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('province', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Zipcode</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('zipcode', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Description</label>
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
            var line1 = $(e.relatedTarget).data('line1');
            var subdistrict = $(e.relatedTarget).data('subdistrict');
            var district = $(e.relatedTarget).data('district');
            var province = $(e.relatedTarget).data('province');
            var zipcode = $(e.relatedTarget).data('zipcode');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="partnerID"]').val(partnerId);
            $('#frm_edit input[name="line1"]').val(line1);
            $('#frm_edit input[name="subdistrict"]').val(subdistrict);
            $('#frm_edit input[name="district"]').val(district);
            $('#frm_edit input[name="province"]').val(province);
            $('#frm_edit input[name="zipcode"]').val(zipcode);
            $('#frm_edit textarea[name="description"]').val(description);
        });
    });

</script>
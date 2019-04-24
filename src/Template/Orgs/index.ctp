<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Organization</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('Add New'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" width="15%"><?= $this->Paginator->sort('ชื่อกลุ่ม') ?></th>
                        <th scope="col" width="15%"><?= $this->Paginator->sort('รหัสกลุ่ม') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= $this->Paginator->sort('createdby') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= $this->Paginator->sort('modifiedby') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= $this->Paginator->sort('สมาชิก') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orgs as $org): ?>
                        <tr>
                            <td><?= h($org->name) ?></td>
                            <td><?= h($org->code) ?></td>
                            <td><?= h($org->createdby) ?></td>
                            <td><?= h($org->modifiedby) ?></td>
                            <td></td>
                            <td class="text-center">
                                <?php if(h($org->isactive == 'Y')) { ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-earth"></i> เปิดใช้งาน'), ['class' => 'btn btn-success waves-effect waves-light', 'data-toggle' => 'modal', 'data-target' => '#statOrgModal', 'data-id' => $org->id, 'data-value' => 'N', 'escape' => false, 'title'=>'คลิกเพื่อปิดการใช้งาน']) ?>
                                <?php }else{ ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-earth-off"></i> ปิดการใช้งาน'), ['class' => 'btn btn-outline-secondary', 'data-toggle' => 'modal', 'data-target' => '#statOrgModal', 'data-id' => $org->id, 'data-value' => 'Y', 'escape' => false, 'title'=>'คลิกเพื่อเปิดใช้งาน']) ?>
                                <?php } ?>
                            </td>
                            <td class="actions text-center">
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $org->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $org->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $org->id], ['confirm' => __('ยืนยันการลบ {0} ? \n ข้อควรระวัง...สมาชิกทั้งหมดที่มีอยู่ในรายการนี้จะถูกลบไปด้วย', $org->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Change Stat org -->
<div class="modal fade" id="statOrgModal" tabindex="-1" role="dialog" aria-labelledby="statOrgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statOrgModalLabel">เปลี่ยนสถานะ</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    ยืนยันการเปลี่ยนแปลงสถานะ ?<br>
                    <span style="color: #dd0000;">ข้อควรระวัง...สมาชิกทั้งหมดที่มีอยู่ในรายการนี้จะถูกเปลี่ยนแปลงสถานะไปด้วย</span>
                </div>
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('org', ['url'=>['controler'=>'orgs', 'action'=>'setStat'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_stat']) ?>
                <fieldset>
                    <?php echo $this->Form->control('orgID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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


        $('#statOrgModal').on('show.bs.modal', function (e) {
        var orgId = $(e.relatedTarget).data('id');
        var stat = $(e.relatedTarget).data('value');
            
        $('#frm_stat input[name="orgID"]').val(orgId);
        $('#frm_stat input[name="isactive"]').val(stat);
    });
    });

</script>

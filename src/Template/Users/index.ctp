<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">User</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Form->button(__('<i class="fa fa-user-plus"></i> ADD NEW'), ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addUserModal', 'escape' => false]) ?>
                </div>
            </div>

            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('org_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('ชื่อ') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('อีเมล์') ?></th>
                        <th scope="col" class="text-center"><?= __('โทรศัพท์') ?></th>
                        <th scope="col" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->has('org') ? $this->Html->link($user->org->name, ['controller' => 'Orgs', 'action' => 'view', $user->org->id]) : '' ?></td>
                            <td><?= h($user->name) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td class="text-center"><?= h($user->mobile) ?></td>
                            <td class="text-center">
                                <?php if(h($user->isactive == 'Y')) { ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-earth"></i> เปิดใช้งาน'), ['class' => 'btn btn-success waves-effect waves-light', 'data-toggle' => 'modal', 'data-target' => '#statUserModal', 'data-id' => $user->id, 'data-value' => 'N', 'escape' => false, 'title'=>'คลิกเพื่อปิดการใช้งาน']) ?>
                                <?php }else{ ?>
                                    <?= $this->Form->button(__('<i class="mdi mdi-earth-off"></i> ปิดการใช้งาน'), ['class' => 'btn btn-outline-secondary', 'data-toggle' => 'modal', 'data-target' => '#statUserModal', 'data-id' => $user->id, 'data-value' => 'Y', 'escape' => false, 'title'=>'คลิกเพื่อเปิดใช้งาน']) ?>
                                <?php } ?>
                            </td>
                            <td class="actions text-center">
                                <?php
                                    $modalOpts = [
                                        'data-id'=>$user->id,
                                        'data-name'=>$user->name,
                                        'data-email'=>$user->email,
                                        'data-mobile'=>$user->mobile,
                                        'data-description'=>h($user->description),
                                        'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 
                                        'data-toggle' => 'modal', 
                                        'data-target' => '#editUserModal',
                                        'escape' => false
                                    ];
                                ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'index'], $modalOpts) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $user->id], ['confirm' => __('ยืนยันการลบ {0} ?', $user->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ADD USER -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">เพิ่มรายชื่อ USER</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('user', ['url'=>['controller'=>'users', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Org</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('org_id', ['options' => $orgs, 'class' => 'form-control select2', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">ชื่อ</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">อีเมล์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">โทรศัพท์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">รหัสผ่าน</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('password', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">สถานะการใช้งาน</label>
                        <div class="col-9">
                            <?php echo $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">รายละเอียด</label>
                        <div class="col-9">
                            <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                </fieldset>
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


<!-- Edit user -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">แก้ไขรายละเอียด USER</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('user', ['url'=>['controler'=>'users', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_edit']) ?>
                <fieldset>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">ชื่อ</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">อีเมล์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">โทรศัพท์</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">รายละเอียด</label>
                        <div class="col-9">
                            <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->control('userID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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


<!-- Change Stat user -->
<div class="modal fade" id="statUserModal" tabindex="-1" role="dialog" aria-labelledby="statUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statUserModalLabel">เปลี่ยนสถานะ</h5>
            </div>
            <div class="modal-body">
                ยืนยันการเปลี่ยนแปลงสถานะ ?
            </div>
            <div class="modal-footer">
            <?= $this->Form->create('user', ['url'=>['controler'=>'users', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form','id'=>'frm_stat']) ?>
                <fieldset>
                    <?php echo $this->Form->control('userID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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


        $('#editUserModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var email = $(e.relatedTarget).data('email');
            var mobile = $(e.relatedTarget).data('mobile');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="userID"]').val(userId);
            $('#frm_edit input[name="name"]').val(name);
            $('#frm_edit input[name="email"]').val(email);
            $('#frm_edit input[name="mobile"]').val(mobile);
            $('#frm_edit textarea[name="description"]').val(description);
        });

        $('#statUserModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $('#frm_stat input[name="userID"]').val(userId);
            $('#frm_stat input[name="isactive"]').val(stat);
        });

    });

    function chkfunc() {
        var chk_value = document.getElementById("chkedbox").checked;
            if(!confirm("ยืนยันการเปลี่ยนแปลง?" + chk_value)){
                return document.getElementById("chkedbox").removeAttr('checked');
            }else{
                return document.getElementById("chkedbox").attr("checked", "checked");
            }
    }


</script>

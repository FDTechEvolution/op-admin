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
                    <?=$this->Form->button(__('ADD NEW'), ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addUserModal']) ?>
                </div>
            </div>

            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?=$this->Paginator->sort('org_id') ?></th>
                        <th scope="col"><?=$this->Paginator->sort('name') ?></th>
                        <th scope="col"><?=$this->Paginator->sort('email') ?></th>
                        <th scope="col"><?=$this->Paginator->sort('mobile') ?></th>
                        <th scope="col"><?=__('isactive') ?></th>
                        <th scope="col" class="actions"><?=__('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?=$user->has('org') ? $this->Html->link($user->org->name, ['controller' => 'Orgs', 'action' => 'view', $user->org->id]) : '' ?></td>
                        <td><?=h($user->name) ?></td>
                        <td><?=h($user->email) ?></td>
                        <td><?=h($user->mobile) ?></td>
                        <td class="text-center"><?php if (h($user->isactive == 'Y')) { ?>
                                <?=$this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked', 'id' => 'chkedbox', 'onchange' => __('chkfunc()')]) ?>
                            <?php } else { ?>
                                <?=$this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'id' => 'chkbox', 'onchange' => __('unchkfunc()')]) ?>
                            <?php } ?>
                        </td>
                        <td class="actions">
                            <?=$this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?=$this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'index'], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'data-toggle' => 'modal', 'data-target' => '#editUserModal', 'data-id' => $user->id, 'escape' => false]) ?>
                            <?=$this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $user->id], ['confirm' => __('ยืนยันการลบ {0} ?', $user->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add New</h5>
      </div>
      <div class="modal-body">
        <?=$this->Form->create('user', ['class' => 'form-horizontal', 'role' => 'form']) ?>
            <fieldset>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Org</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('org_id', ['options' => $orgs, 'class' => 'form-control select2', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Name</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Mobile</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Password</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('password', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">isactive</label>
                    <div class="col-9">
                        <?php echo $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">description</label>
                    <div class="col-9">
                        <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
            </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?=$this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?=$this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
        <?=$this->Form->end() ?>
      </div>
    </div>
  </div>
</div>


<!-- Edit user -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit</h5>
      </div>
      <div class="modal-body">
        <?=$this->Form->create('user', ['class' => 'form-horizontal', 'role' => 'form']) ?>
            <fieldset>
                <div class="form-group row">
                    <label class="col-3 col-form-label">ID</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('userID', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Org</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('org_id', ['options' => $orgs, 'class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Name</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Mobile</label>
                    <div class="col-9">
                        <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">สถานะ</label>
                    <div class="col-9">
                        <?php if (h($user->isactive == 'Y')) { ?>
                            <?=$this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']) ?>
                        <?php } else { ?>
                            <?=$this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d']) ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                        </div>
                </div>
            </fieldset>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <?=$this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> UPDATE'), ['class' => 'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape' => false]) ?>
                        <?=$this->Form->button(__('<i class="mdi mdi-close-circle"></i> Cancel'), ['class' => 'btn btn-secondary btn-custom waves-effect w-md waves-light m-b-5', 'data-dismiss' => 'modal', 'escape' => false]) ?>
                    </div>
                </div>
        <?=$this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<!-- Required datatable js -->
<?=$this->html->script('/plugins/datatables/jquery.dataTables.min') ?>
<?=$this->html->script('/plugins/datatables/dataTables.bootstrap4.min') ?>

<!-- Buttons examples -->
<?=$this->html->script('/plugins/datatables/dataTables.buttons.min') ?>
<?=$this->html->script('/plugins/datatables/buttons.bootstrap4.min') ?>
<?=$this->html->script('/plugins/datatables/jszip.min') ?>
<?=$this->html->script('/plugins/datatables/pdfmake.min') ?>
<?=$this->html->script('/plugins/datatables/vfs_fonts') ?>
<?=$this->html->script('/plugins/datatables/buttons.html5.min') ?>
<?=$this->html->script('/plugins/datatables/buttons.print.min') ?>
<?=$this->html->script('/plugins/datatables/buttons.colVis.min') ?>

<!-- Responsive examples -->
<?=$this->html->script('dataTables.responsive.min') ?>
<?=$this->html->script('responsive.bootstrap4.min') ?>

<!-- Custom JS
<?=$this->html->script('mycustomjs') ?>
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
    });

    $('#editUserModal').on('show.bs.modal', function(e) {
        var userId = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="userID"]').val(userId);
    });
</script>

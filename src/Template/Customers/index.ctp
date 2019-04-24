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
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer->has('org') ? $this->Html->link($customer->org->name, ['controller' => 'Orgs', 'action' => 'view', $customer->org->id]) : '' ?></td>
                        <td><?= h($customer->name) ?></td>
                        <td><?= h($customer->mobile) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD CUSTOMER -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add Customer</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('customer', ['url'=>['controller'=>'customers', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
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
                        <label class="col-3 col-form-label">Mobile</label>
                        <div class="col-9">
                            <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'label' => false, 'type' => 'number']); ?>
                        </div>
                    </div>
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

</script>
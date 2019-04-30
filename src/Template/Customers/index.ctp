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
                    <?= $this->Form->button(__('<i class="fa fa-user-plus"></i> ADD NEW'), ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addCustomerModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('org_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                        <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer->has('org') ? $this->Html->link($customer->org->name, ['controller' => 'Orgs', 'action' => 'view', $customer->org->id]) : '' ?></td>
                        <td><?= h($customer->name) ?></td>
                        <td><?= h($customer->mobile) ?></td>
                        <td class="actions text-center">
                            <?php
                                    $modalOpts = [
                                        'data-id'=>$customer->id,
                                        'data-name'=>$customer->name,
                                        'data-mobile'=>$customer->mobile,
                                        'data-description'=>h($customer->description),
                                        'data-line1'=>$customer->address->line1,
                                        'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 
                                        'data-toggle' => 'modal', 
                                        'data-target' => '#editCustomerModal',
                                        'escape' => false
                                    ];
                                ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $customer->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $customer->id], $modalOpts ) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $customer->id], ['confirm' => __('ยืนยันการลบ # {0}?', $customer->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ADD CUSTOMER -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
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

<!-- EDIT CUSTOMER -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('customer', ['url'=>['controller'=>'customers', 'action'=>'edit'], 'class' => 'form-horizontal', 'role' => 'form', 'id'=>'frm_edit']) ?>
                <fieldset>
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
                    <?php echo $this->Form->control('customerID', ['class' => 'form-control', 'label' => false, 'type' => 'hidden']); ?>
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
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


        $('#editCustomerModal').on('show.bs.modal', function (e) {
            var customerId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var mobile = $(e.relatedTarget).data('mobile');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="customerID"]').val(customerId);
            $('#frm_edit input[name="name"]').val(name);
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
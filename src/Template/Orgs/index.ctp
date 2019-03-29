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
                    <?= $this->Form->button(__('ADD NEW'), ['class'=>'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle'=>'modal', 'data-target'=>'#exampleModal']) ?>
                    <?= $this->Html->link(__('Add New'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'style'=>'display: none;']) ?>
                </div>
            </div>
           
            
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" width="18%"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col" width="18%"><?= $this->Paginator->sort('code') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= $this->Paginator->sort('createdby') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= $this->Paginator->sort('modifiedby') ?></th>
                        <th scope="col" width="10%" class="text-center"><?= __('isactive') ?></th>
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
                            <td class="text-center"><?php if (h($org->isactive == 'Y')) { ?>
                                    <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked', 'id'=>'chkedbox', 'onchange'=>__('chkfunc()')]) ?>
                                <?php } else { ?>
                                    <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'id'=>'chkbox', 'onchange'=>__('unchkfunc()')]) ?>
                                <?php } ?>
                            </td>
                            <td class="actions text-center">
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $org->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $org->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $org->id], ['confirm' => __('ยืนยันการลบ {0} ?', $org->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
      </div>
      <div class="modal-body">
                        <?= $this->Form->create($org, ['class'=>'form-horizontal', 'role'=>'form']) ?>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Name</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('name', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Code</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('code', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">สถานะ</label>
                                    <div class="col-8">
                                        <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">createdby</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('createdby', ['class'=>'form-control', 'label'=>false, 'disabled']); ?>
                                    </div>
                                </div>
                                <?php echo $this->Form->control('modifiedby', ['class'=>'form-control', 'label'=>false, 'type'=>'hidden']); ?>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class'=>'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape'=>false]) ?>
                                    <?= $this->Form->button(__('Close'), ['class'=>'btn btn-secondary', 'data-dismiss'=>'modal']) ?>
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
    });

</script>

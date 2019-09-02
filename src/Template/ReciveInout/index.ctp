<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">รับสินค้า</h4> 
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-right">
                    <?= $this->Html->link(__('<i class="fa fa-cart-plus"></i> เพิ่มรายการรับสินค้า'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5', 'data-toggle' => 'modal', 'data-target' => '#addShipmentInoutModal', 'escape' => false]) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?= __('จากคลังสินค้า') ?></th>
                        <th scope="col"><?= __('ไปยังคลังสินค้า') ?></th>
                        <th scope="col" class="text-center"><?= __('พาร์ทเนอร์') ?></th>
                        <th scope="col" class="text-center"><?= __('พนักงาน') ?></th>
                        <th scope="col" class="text-center"><?= __('สถานะ') ?></th>
                        <th scope="col" class="actions text-center"><?= __('การจัดการ') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipmentInouts as $shipmentInout): 
                    if($shipmentInout->isshipment == 'N') : ?>
                    <tr>
                        <td><?= $shipmentInout->has('FromWarehouses') ? $this->Html->link($shipmentInout->FromWarehouses->name, ['controller' => 'Warehouses', 'action' => 'view', $shipmentInout->FromWarehouses->id]) : '' ?></td>
                        <td><?= $shipmentInout->has('ToWarehouses') ? $this->Html->link($shipmentInout->ToWarehouses->name, ['controller' => 'Warehouses', 'action' => 'view', $shipmentInout->ToWarehouses->id]) : '' ?></td>
                        <td class="text-center"><?= $shipmentInout->has('bpartner') ? $this->Html->link($shipmentInout->bpartner->name, ['controller' => 'Bpartners', 'action' => 'view', $shipmentInout->bpartner->id]) : '' ?></td>
                        <td class="text-center"><?= $shipmentInout->has('user') ? $this->Html->link($shipmentInout->user->name, ['controller' => 'Users', 'action' => 'view', $shipmentInout->user->id]) : '' ?></td>
                        <td class="text-center">
                            <?php if(h($shipmentInout->status) == "DR" || h($shipmentInout->status) == "DX") :
                                echo "<button class='btn btn-success disabled m-b-5'><i class='mdi mdi-selection'></i> Draft</button>";
                            elseif(h($shipmentInout->status) == "CO") :
                                echo "<button class='btn btn-primary disabled m-b-5'><i class='mdi mdi-content-save-settings'></i> Complete</button>";
                            elseif(h($shipmentInout->status) == "VO") :
                                echo "<button class='btn btn-danger disabled m-b-5'><i class='mdi mdi-window-close'></i> Void</button>";
                            endif; ?>
                        </td>
                        <td class="actions text-center">
                            <?php if(h($shipmentInout->status) == "DR" || h($shipmentInout->status) == "DX") : ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $shipmentInout->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $shipmentInout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipmentInout->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            <?php elseif(h($shipmentInout->status) == "CO") : ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'edit', $shipmentInout->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $shipmentInout->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shipmentInout->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                            <?php elseif(h($shipmentInout->status) == "VO") : ?>
                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'edit', $shipmentInout->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <div>
    </div>
</div>


<!-- ADD WAREHOUSE SHIPMENT -->
<div class="modal fade" id="addShipmentInoutModal" tabindex="-1" role="dialog" aria-labelledby="addShipmentInoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addShipmentInoutModalLabel">เพิ่มรายการรับสินค้าเข้าสู่คลังสินค้า</h5>
            </div>
            <div class="modal-body">
                <?= $this->Form->create('warehouse', ['url'=>['controller'=>'shipmentInouts', 'action'=>'add'], 'class' => 'form-horizontal', 'role' => 'form']) ?>
                <fieldset>
                    <div class="row" style="padding: 20px;">
                        <div class="col-4">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">จากคลังสินค้า</label>
                                <div class="col-12">
                                    <?php echo $this->Form->control('from_warehouse_id', ['options' => $warehouses, 'class'=>'form-control select2', 'label'=>false]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">ไปยังคลังสินค้า</label>
                                <div class="col-12">
                                    <?php echo $this->Form->control('to_warehouse_id', ['options' => $warehouses, 'class'=>'form-control select2', 'label'=>false]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">วันที่</label>
                                <div class="col-12">
                                    <?php echo $this->Form->control('docdate', ['class'=>'form-control', 'label'=>false, 'value' => date('Y-m-d'), 'readonly']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 20px;">
                        <div class="col-3">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">พาร์ทเนอร์</label>
                                <div class="col-12">
                                    <?php echo $this->Form->control('bpartner_id', ['options' => $bpartners, 'class'=>'form-control select2', 'label'=>false]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">พนักงาน</label>
                                <div class="col-12">
                                    <?php echo $this->Form->control('user_id', ['options' => $users, 'class'=>'form-control select2', 'label'=>false]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-12 col-form-label">รายละเอียด</label>
                                <div class="col-12">
                                    <?php echo $this->Form->textarea('description', ['class' => 'form-control', 'label' => false]); ?>
                                </div>
                            </div>
                        </div>
                            <?php echo $this->Form->control('org_id', ['type' => 'hidden', 'value' => $ORG_ID]); ?>
                            <?php echo $this->Form->control('status', ['type' => 'hidden', 'value' => 'DR']); ?>
                            <?php echo $this->Form->control('isshipment', ['type' => 'hidden', 'value' => 'N']); ?>
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

        $('#editWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var description = $(e.relatedTarget).data('description');
            
            $(e.currentTarget).find('input[name="WH_ID"]').val(warehouseId);
            $('#frm_edit input[name="name"]').val(name);
            $('#frm_edit textarea[name="description"]').val(description);
        });

        $('#statWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $(e.currentTarget).find('input[name="WH_ID"]').val(warehouseId);
            $('#frm_stat input[name="isactive"]').val(stat);
        });
    });

</script>
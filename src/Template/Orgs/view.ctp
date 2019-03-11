<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Org $org
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">View Organization</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-left">
                     <?= $this->Html->link(__('< List Orgs'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                        <div class="orgs view large-9 medium-8 columns content">
                            <h3><?= h($org->name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Code') ?></th>
                                    <td><?= h($org->code) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Isactive') ?></th>
                                    <td>
                                        <?php if (h($org->isactive == 'Y')) { ?>
                                            <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size'=>'small', 'checked', 'disabled']) ?>
                                        <?php } else { ?>
                                            <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size'=>'small', 'disabled']) ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Createdby') ?></th>
                                    <td><?= h($org->createdby) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Modifiedby') ?></th>
                                    <td><?= h($org->modifiedby) ?></td>
                                </tr>
                            </table>
                            <br>
                            <div class="related">
                                <h4><?= __('Related Users') ?></h4>
                                <?php if (!empty($org->users)): ?>
                                <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col"><?= __('Name') ?></th>
                                            <th scope="col"><?= __('Email') ?></th>
                                            <th scope="col"><?= __('Mobile') ?></th>
                                            <th scope="col"><?= __('Isactive') ?></th>
                                            <th scope="col"><?= __('Createdby') ?></th>
                                            <th scope="col"><?= __('Modifiedby') ?></th>
                                            <th scope="col"><?= __('Description') ?></th>
                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($org->users as $users): ?>
                                        <tr>
                                            <td><?= h($users->name) ?></td>
                                            <td><?= h($users->email) ?></td>
                                            <td><?= h($users->mobile) ?></td>
                                            <td>
                                                <?php if (h($org->isactive == 'Y')) { ?>
                                                    <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']) ?>
                                                <?php } else { ?>
                                                    <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d']) ?>
                                                <?php } ?>
                                            </td>
                                            <td><?= h($users->createdby) ?></td>
                                            <td><?= h($users->modifiedby) ?></td>
                                            <td><?= h($users->description) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                                <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                                <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('ยืนยันการลบ {0} ?', $users->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php else : ?>
                                    No Member.....
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
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

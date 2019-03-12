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
                     <?= $this->Html->link(__('Add New'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
            </div>

            <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('org_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                        <th scope="col"><?= __('isactive') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('createdby') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modifiedby') ?></th>
                        <th scope="col"><?= __('description') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->has('org') ? $this->Html->link($user->org->name, ['controller' => 'Orgs', 'action' => 'view', $user->org->id]) : '' ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->mobile) ?></td>
                        <td class="text-center"><?php if (h($user->isactive == 'Y')) { ?>
                                <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']) ?>
                            <?php } else { ?>
                                <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d']) ?>
                            <?php } ?>
                        </td>
                        <td><?= h($user->createdby) ?></td>
                        <td><?= h($user->modifiedby) ?></td>
                        <td><?= h($user->description) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $user->id], ['confirm' => __('ยืนยันการลบ {0} ?', $user->name), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

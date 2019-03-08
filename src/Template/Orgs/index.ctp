<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Org[]|\Cake\Collection\CollectionInterface $orgs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <h3><?= __('Organizetion') ?></h3>
    <div class="side-nav">
        <?= $this->Html->link(__('Add New'), ['action' => 'add'], ['class'=>'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
    </div>
</nav>
<div class="orgs index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('createdby') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modifiedby') ?></th>
                <th scope="col"><?= $this->Paginator->sort('isactive') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orgs as $org): ?>
            <tr>
                <td><?= h($org->name) ?></td>
                <td><?= h($org->code) ?></td>
                <td><?= h($org->createdby) ?></td>
                <td><?= h($org->modifiedby) ?></td>
                <td><?php if(h($org->isactive == 'Y')){ ?>
                        <?= $this->Form->checkbox('isactive', ['data-plugin'=>'switchery', 'data-color'=>'#00b19d', 'checked']) ?>
                    <?php }else{ ?>
                        <?= $this->Form->checkbox('isactive', ['data-plugin'=>'switchery', 'data-color'=>'#00b19d']) ?>
                    <?php } ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="mdi mdi-view-list"></i> รายละเอียด'), ['action' => 'view', $org->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape'=>false]) ?>
                    <?= $this->Html->link(__('<i class="mdi mdi-tooltip-edit"></i> แก้ไข'), ['action' => 'edit', $org->id], ['class'=>'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape'=>false]) ?>
                    <?= $this->Form->postLink(__('<i class="mdi mdi-delete-forever"></i> ลบ'), ['action' => 'delete', $org->id], ['confirm' => __('Are you sure you want to delete # {0}?', $org->id), 'class'=>'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape'=>false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
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

        <!-- App js -->
        <?= $this->html->script('jquery.core') ?>
        <?= $this->html->script('jquery.app') ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

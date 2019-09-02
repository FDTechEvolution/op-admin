<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RawOrder[]|\Cake\Collection\CollectionInterface $rawOrders
 */
?>
<div class="productCategories view large-9 medium-8 columns content">
    <div class="card-box">
        <hr>
        <div class="related">
            <h4><?= __('Raw Orders') ?></h4>
            <hr>
            <div class="row">
                <table cellpadding="0" cellspacing="0" id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"><?=__('Order No.') ?></th>
                            <th scope="col" class="text-center"><?= __('Data') ?></th>
                            <th scope="col" class="text-center"><?= __('Line ID') ?></th>
                            <th scope="col" class="text-center"><?= __('Status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rawOrders as $rowOrder) : ?>
                        <tr>
                            <td class="text-center"><?= $rowOrder->orderno; ?></td>
                            <td class="text-center"><?= $rowOrder->data; ?></td>
                            <td class="text-center"><?= $rowOrder->lineid; ?></td>
                            <td class="text-center"><?= $rowOrder->status; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

        $('#statWHModal').on('show.bs.modal', function (e) {
            var warehouseId = $(e.relatedTarget).data('id');
            var stat = $(e.relatedTarget).data('value');
            
            $(e.currentTarget).find('input[name="WH_ID"]').val(warehouseId);
            $('#frm_stat input[name="isactive"]').val(stat);
        });
    });

</script>
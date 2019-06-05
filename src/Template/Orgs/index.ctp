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
                    <?= $this->Html->link(__('Add New'), ['action' => 'add'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
            </div>
            <table cellpadding="0" cellspacing="0" id="datatable" class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Org Name</th>
                        <th>Org Code</th>
                        <th>Create By</th>
                        <th>Create Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orgs as $org): ?>
                        <tr>
                            <td><?= $this->Html->link($org->name,['controller'=>'orgs','action'=>'dashboard',$org->id],[]) ?></td>
                            <td><?= h($org->code) ?></td>
                            <td><?= h($org->createdby) ?></td>
                            <td><?= h($org->modifiedby) ?></td>
                           
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

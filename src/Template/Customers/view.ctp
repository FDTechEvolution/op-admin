<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">View Customer</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-left">
                     <?= $this->Html->link(__('< List Customers'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                        <div class="customers view large-9 medium-8 columns content">
                            <h3><?= h($customer->name) ?></h3>
                            <table class="vertical-table">
                                <tr>
                                    <th scope="row"><?= __('Name') ?></th>
                                    <td><?= h($customer->name) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Org Id') ?></th>
                                    <td><?= h($customer->org_id) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Mobile') ?></th>
                                    <td><?= h($customer->mobile) ?></td>
                                </tr>
                            <?php
                                foreach ($addressTable as $address) :
                            ?>
                                <tr>
                                    <th scope="row"><?= __('Line') ?></th>
                                    <td><?= h($address->line1) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Subdistrict') ?></th>
                                    <td><?= h($address->subdistrict) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('District') ?></th>
                                    <td><?= h($address->district) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Province') ?></th>
                                    <td><?= h($address->province) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"><?= __('Zipcode') ?></th>
                                    <td><?= h($address->zipcode) ?></td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                            </table>
                            <div class="row">
                                <h4><?= __('Description') ?></h4>
                                <?= $this->Text->autoParagraph(h($customer->description)); ?>
                            </div>
                        </div>
                    </div>
                <div>
            </div>
        </div>
    </div>
</div>

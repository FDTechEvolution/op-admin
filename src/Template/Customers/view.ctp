<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $customer
 */
?>
<style>
    table.vertical-table tbody tr th {
        line-height: 36px;
        width: 160px;
    }
    table.vertical-table{
        margin-left: 1.5em;
    }
</style>
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
                     <?= $this->Html->link(__('< ลูกค้าทั้งหมด'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                        <div class="customers view large-9 medium-8 columns content">
                            <div class="row">
                                <div class="col-5">
                                    <table class="vertical-table">
                                        <tr>
                                            <th scope="row"><?= __('<i class="ti-user"></i> ชื่อลูกค้า') ?></th>
                                            <td><?= h($customer->name) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('<i class="ti-mobile"></i> โทรศัพท์') ?></th>
                                            <td><?= h($customer->mobile) ?></td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table class="vertical-table">
                                        <h5><i class="ti-location-pin"></i> ที่อยู่ลูกค้า</h5>
                                    <?php
                                        foreach ($addressTable as $address) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= __('ที่อยู่') ?></th>
                                            <td><?= h($address->line1) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('แขวง/ตำบล') ?></th>
                                            <td><?= h($address->subdistrict) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('เขต/อำเภอ') ?></th>
                                            <td><?= h($address->district) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('จังหวัด') ?></th>
                                            <td><?= h($address->province) ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><?= __('รหัสไปรษณีย์') ?></th>
                                            <td><?= h($address->zipcode) ?></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <table>
                                            <tr>
                                                <th><h4><?= __('<i class="mdi mdi-comment-text-outline"></i> รายละเอียด') ?></h4></th>
                                            </tr>
                                            <tr>
                                                <td style="padding-left: 30px;">
                                                    <?php 
                                                        if($customer->description != "") :
                                                    ?>
                                                            <?= $this->Text->autoParagraph(h($customer->description)); ?>
                                                    <?php
                                                        else :
                                                            echo "ไม่มีการระบุรายละเอียดเพิ่มเติมใดๆ.......";
                                                        endif;
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
            </div>
        </div>
    </div>
</div>

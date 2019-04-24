<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Org $org
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Edit Organization</h4>
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
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <?= $this->Form->button(__('<i class=" mdi mdi-auto-upload"></i> UPDATE'), ['class'=>'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape'=>false]) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

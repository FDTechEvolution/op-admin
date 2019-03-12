<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Add User</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12 text-left">
                     <?= $this->Html->link(__('< List Users'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                        <?= $this->Form->create($user, ['class'=>'form-horizontal', 'role'=>'form']) ?>
                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Org</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('org_id', ['options' => $orgs, 'class'=>'form-control select2', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Name</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('name', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Email</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('email', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Mobile</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('mobile', ['class'=>'form-control', 'label'=>false, 'type'=>'number']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Password</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('password', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">isactive</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'checked']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">createdby</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->control('createdby', ['class'=>'form-control', 'label'=>false, 'disabled']); ?>
                                    </div>
                                </div>
                                <?php echo $this->Form->control('modifiedby', ['class'=>'form-control', 'label'=>false, 'type'=>'hidden']); ?>
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">description</label>
                                    <div class="col-8">
                                        <?php echo $this->Form->textarea('description', ['class'=>'form-control', 'label'=>false]); ?>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-12 text-center">
                                    <?= $this->Form->button(__('<i class="mdi mdi-content-save"></i> SAVE'), ['class'=>'btn btn-primary btn-custom waves-effect w-md waves-light m-b-5', 'escape'=>false]) ?>
                                </div>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div>

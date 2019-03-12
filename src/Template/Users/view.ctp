<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->html->css('/plugins/morris/morris') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">User Profile</h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="col-md-12 text-left">
    <?= $this->Html->link(__('< List Users'), ['action' => 'index'], ['class' => 'btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5']) ?>
</div>
<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <?= $this->Html->image('/images/users/avatar-1.jpg', ['alt' => 'profile-image', 'class' => 'rounded-circle img-thumbnail']); ?>
                </div>

                <div class="">
                    <h5 class="m-b-5"><?= h($user->name) ?></h5>
                        <p class="text-muted"><?= $user->has('org') ? $this->Html->link($user->org->name, ['controller' => 'Orgs', 'action' => 'view', $user->org->id]) : '' ?></p>
                    </div>

                    <p class="text-muted font-13"><strong>Active :</strong>
                        <span class="m-l-15">
                        <?php if (h($user->isactive == 'Y')) { ?>
                            <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size'=>'small', 'checked', 'disabled']) ?>
                        <?php } else { ?>
                            <?= $this->Form->checkbox('isactive', ['data-plugin' => 'switchery', 'data-color' => '#00b19d', 'data-size'=>'small', 'disabled']) ?>
                        <?php } ?>
                        </span>
                    </p>


                    <div class="text-left m-t-40">

                        <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15"><?= h($user->mobile) ?></span></p>

                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?= h($user->email) ?></span></p>

                        <p class="text-muted font-13"><strong>Created :</strong> <span class="m-l-15"><?= h($user->created) ?></span></p>

                        <p class="text-muted font-13"><strong>Created By :</strong> <span class="m-l-15"><?= h($user->createdby) ?></span></p>

                        <p class="text-muted font-13"><strong>Modified By :</strong> <span class="m-l-15"><?= h($user->modifiedby) ?></span></p>

                        <p class="text-muted font-13"><strong>Description :</strong> <span class="m-l-15"><?= h($user->description) ?></span></p>
                    </div>

                    <ul class="social-links list-inline m-t-30">
                        <li class="list-inline-item">
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                        </li>
                    </ul>

            </div>

        </div> <!-- end card-box -->
    </div>
    <div class="col-xl-9 col-lg-8">

                        <div class="row">
                            <div class="col-4">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-primary pull-left">
                                        <i class="ion-social-bitcoin text-info"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark m-t-10"><b class="counter">31,570</b> ฿</h3>
                                        <p class="text-muted mb-0">Total Revenue</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-danger pull-left">
                                        <i class="ti-shopping-cart text-pink"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark m-t-10"><b class="counter">280</b></h3>
                                        <p class="text-muted mb-0">Today's Sales</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-purple pull-left">
                                        <i class="ti-stats-up text-purple"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark m-t-10"><b class="counter">0.16</b>%</h3>
                                        <p class="text-muted mb-0">Conversion</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        
                            
                            <div class="col-7">
                        		<div class="card-box">
                        			<h4 class="text-dark  header-title m-t-0 m-b-30">Total Revenue</h4>

                        			<div class="widget-chart text-center">
                                        <div id="dashboard-chart-1" style="height: 300px;"></div>

                                	</div>
                        		</div>
                            </div>

                            <div class="col-5">
                        		<div class="card-box">
                        			<h4 class="text-dark  header-title m-t-0 m-b-30">Yearly Sales Report</h4>

                        			<div class="widget-chart text-center">
                                        <div id="morris-donut-example" style="height: 300px;"></div>

                                	</div>
                        		</div>
                            </div>
                        
                        </div>

                        </div>              
</div>

<script>
    var resizefunc = [];
</script>

<!-- Counter Up  -->
<?= $this->html->script('/plugins/waypoints/lib/jquery.waypoints.min') ?>
<?= $this->html->script('/plugins/counterup/jquery.counterup.min') ?>

<!--Morris Chart-->
<?= $this->html->script('/plugins/morris/morris.min') ?>
<?= $this->html->script('/plugins/raphael/raphael-min') ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>
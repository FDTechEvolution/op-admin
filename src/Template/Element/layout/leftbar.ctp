<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <?= $this->Html->link('<i class="ti-home"></i><span> Dashboard </span>', ['controller'=>'home'], ['class' => 'waves-effect waves-primary','escape'=>false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="ti-user"></i><span> User </span>', ['controller'=>'users'], ['class' => 'waves-effect waves-primary','escape'=>false]) ?>
                </li>
                <li>
                    <?= $this->Html->link('<i class="mdi mdi-group"></i><span> Organization </span>', ['controller'=>'orgs'], ['class' => 'waves-effect waves-primary','escape'=>false]) ?>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-paint-bucket"></i> <span> UI Kit </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="ui-buttons.html">Buttons</a></li>
                    </ul>
                </li>



            </ul>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
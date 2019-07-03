<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <?= $this->Html->link('<i class="ti-home"></i><span> Dashboard </span>', ['controller' => 'dashboard'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                </li>

                <li>
                    <?= $this->Html->link('<i class="mdi mdi-group"></i><span> Organization </span>', ['controller' => 'orgs'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                </li>
                <?php if ((isset($ORG_ID)) && !is_null($ORG_ID) && $ORG_ID != '') { ?>
                    <li>
                        <?= $this->Html->link('<i class="mdi mdi-group"></i><span> Bussiness Partner </span>', ['controller' => 'bpartners'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-users"></i><span> Customer </span>', ['controller' => 'customers'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="ti-user"></i><span> User </span>', ['controller' => 'users'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-product-hunt"></i> <span style="font-size: 14px;"> Product Management </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li>
                                <?= $this->Html->link('- Brand </span>', ['controller' => 'brands'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('- Category </span>', ['controller' => 'productCategories'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('- Product </span>', ['controller' => 'products'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ion-arrow-swap"></i> <span style="font-size: 14px;"> WH Management </span>
                            <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li>
                                <?= $this->Html->link('- Goods Shipment </span>', ['controller' => 'warehouses'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('- Goods Recieve </span>', ['controller' => 'shipmentInouts'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link('- Warehouse </span>', ['controller' => 'warehouses'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-paint-bucket"></i> <span> UI Kit </span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="ui-buttons.html">Buttons</a></li>
                    </ul>
                </li>

                <li>
                    <?= $this->Html->link('<i class="mdi mdi-group"></i><span> Log out </span>', ['controller' => 'logout'], ['class' => 'waves-effect waves-primary', 'escape' => false]) ?>
                </li>
            </ul>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Minton - Responsive Admin Dashboard Template</title>
        <?= $this->Html->css('/plugins/switchery/switchery.min.css') ?>
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('icons.css') ?>
        <?= $this->Html->css('style.css') ?>

        <?= $this->Html->script('modernizr.min.js') ?>

    </head>

    <body>

        <!-- Begin page -->

            <?= $this->fetch('content') ?>

        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <?= $this->Html->script('jquery.min.js') ?>
        <?= $this->Html->script('popper.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('detect.js') ?>
        <?= $this->Html->script('fastclick.js') ?>
        <?= $this->Html->script('jquery.slimscroll.js') ?>
        <?= $this->Html->script('jquery.blockUI.js') ?>
        <?= $this->Html->script('waves.js') ?>
        <?= $this->Html->script('wow.min.js') ?>
        <?= $this->Html->script('jquery.nicescroll.js') ?>
        <?= $this->Html->script('jquery.scrollTo.min.js') ?>
        <?= $this->Html->script('/plugins/switchery/switchery.min.js') ?>

        <?= $this->Html->script('jquery.core.js') ?>
        <?= $this->Html->script('jquery.app.js') ?>

    </body>
</html>
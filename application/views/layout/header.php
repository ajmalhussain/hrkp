<?php
//$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
//$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head>
        <title>HR KP</title>

        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

        <!-- Bootstrap -->
        <link href="<?php echo base_url('common/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('common/bootstrap/css/responsive.css') ?>" rel="stylesheet" />

        <!-- Glyphicons Font Icons -->
        <link href="<?php echo base_url('common/theme/css/glyphicons.css') ?>" rel="stylesheet" />

        <!-- Uniform Pretty Checkboxes -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css') ?>" rel="stylesheet" />

        <!-- PrettyPhoto -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css') ?>" rel="stylesheet" />

        <!-- Bootstrap Extended -->
        <link href="<?php echo base_url('common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('common/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('common/bootstrap/extend/bootstrap-select/bootstrap-select.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('common/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css') ?>" rel="stylesheet" />

        <!-- Select2 Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/forms/select2/select2.css') ?>" rel="stylesheet" />

        <!-- DateTimePicker Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css') ?>" rel="stylesheet" />

        <!-- JQueryUI -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css') ?>" rel="stylesheet" />

        <!-- MiniColors ColorPicker Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css') ?>" rel="stylesheet" />

        <!-- Notyfy Notifications Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.css') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('common/theme/scripts/plugins/notifications/notyfy/themes/default.css') ?>" rel="stylesheet" />

        <!-- Gritter Notifications Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css') ?>" rel="stylesheet" />

        <!-- Easy-pie Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.css') ?>" rel="stylesheet" />

        <!-- Google Code Prettify Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/other/google-code-prettify/prettify.css') ?>" rel="stylesheet" />

        <!-- DataTables Plugin -->
        <link href="<?php echo base_url('common/theme/scripts/plugins/tables/DataTables/media/css/DT_bootstrap.css') ?>" rel="stylesheet" />

        <!-- Main Theme Stylesheet :: CSS -->
        <link href="<?php echo base_url('common/theme/css/style-light.css?1369414384') ?>" rel="stylesheet" />
        <link href="<?php echo base_url('common/theme/css/green.css') ?>" rel="stylesheet" />

        <!-- LESS.js Library -->
        <script src="<?php echo base_url('common/theme/scripts/plugins/system/less.min.js') ?>"></script>
        <?php include 'css.php'; ?>
    </head>
    <body class="">

        <!-- Main Container Fluid -->
        <div class="container-fluid fluid menu-left">

            <div class="header navbar"> 
                <!-- BEGIN TOP NAVIGATION BAR -->
                <div class="header-inner">
                    <!-- BEGIN LOGO --> 
                    <a class="navbar-brand" href="http://c.lmis.gov.pk:80/" style="margin-top: -10px;"> <img src="http://c.lmis.gov.pk:80/public/assets/admin/layout/img/landing-images/contraceptive-logo.png" alt="vaccine LMIS" width="323" height="55"> </a> 
                    <!-- END LOGO --> 
                    <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
                    <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <img src="http://c.lmis.gov.pk:80/public/assets/img/menu-toggler.png" alt=""> </a>
                    <ul class="nav navbar-nav pull-right">
                        <li> <a href="http://c.lmis.gov.pk:80/manuals.php" class="ul-header"> <img src="http://c.lmis.gov.pk:80/public/assets/img/header-icon/training_manuals.png" alt=""> </a> </li>
                    </ul>
                    <!-- END RESPONSIVE MENU TOGGLER --> 
                </div>
                <!-- END TOP NAVIGATION BAR --> 
            </div>

            <?php include 'top-menu.php'; ?>

            <!-- Sidebar menu & content wrapper -->
            <div id="wrapper">

                <?php include 'left-menu.php'; ?>
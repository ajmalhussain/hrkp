<?php
$link = $_SERVER['REQUEST_URI'];
$link_array = explode('/', $link);
$page = end($link_array);
$config = false;

switch ($page) {
    case 'training_records':
    case 'specialities_record':
    case 'posting_place':
    case 'districts':
    case 'users':
    case 'university':
    case 'degree':
    case 'Cadre':
    case 'Category':
    case 'inactive_reason':
        $config = true;
        break;
}
?>
<!-- Sidebar Menu -->
<div id="menu" class="hidden-phone hidden-print">
    <!-- Scrollable menu wrapper with Maximum height -->
    <div class="slim-scroll" data-scroll-height="800px">
        <!-- Sidebar Profile -->
        <span class="profile">
                <!--<a class="img" href="my-account.php"><img src="#" alt="<?php echo $this->session->userdata('name'); ?>" /></a>-->
            <span>
                <strong>Welcome</strong>
                <a href="my-account.php" class="glyphicons right_arrow"><?php echo $this->session->userdata('name'); ?> <i></i></a>
            </span>
        </span>
        <!-- // Sidebar Profile END -->

        <!-- Regular Size Menu -->
        <ul>
            <!-- Menu Regular Item -->
            <li class="glyphicons display"><a href="#"><i></i><span>Dashboard</span></a></li>
            <!-- Components Submenu Level 1 -->
            <!-- Components Submenu Level 1 END -->
            <li class="glyphicons user_add"><a href="<?php echo base_url("profile/index"); ?>"><i></i><span>Profile</span></a></li>
            <li class="hasSubmenu <?php if ($config) { ?> active <?php } ?>">
                <a data-toggle="collapse" class="glyphicons notes" href="#menu_landing"><i></i><span>Configuration Management</span></a>
                <ul class="collapse <?php if ($config) { ?> in <?php } ?>" id="menu_landing">
                    <li class="<?php if ($page == 'training_records') { ?> active <?php } ?>"><a href="<?php echo base_url("training_records"); ?>"><span>Trainings Management</span></a></li>
                    <li class="<?php if ($page == 'specialities_record') { ?> active <?php } ?>"><a href="specialities_record"><span>Speciality/Skills Management</span></a></li>
                    <li class="<?php if ($page == 'posting_place') { ?> active <?php } ?>"><a href="posting_place"><span>Hospitals Management</span></a></li>
                    <li class="<?php if ($page == 'districts') { ?> active <?php } ?>"><a href="districts"><span>District Management</span></a></li>
                    <li class="<?php if ($page == 'users') { ?> active <?php } ?>"><a href="users"><span>Users Management</span></a></li>
                    <li class="<?php if ($page == 'university') { ?> active <?php } ?>"><a href="university"><span>University Management</span></a></li>
                    <li class="<?php if ($page == 'degree') { ?> active <?php } ?>"><a href="degree"><span>Degree Management</span></a></li>
                    <li class="<?php if ($page == 'Cadre') { ?> active <?php } ?>"><a href="Cadre"><span>Cadre Management</span></a></li>
                    <li class="<?php if ($page == 'Category') { ?> active <?php } ?>"><a href="Category"><span>Category Management</span></a></li>
                    <li class="<?php if ($page == 'inactive_reason') { ?> active <?php } ?>"><a href="inactive_reason"><span>Inactive Reason Management</span></a></li>
                </ul>
                <span class="count">10</span>
            </li>

            <li class=" glyphicons database_plus"><a href="posting_bi_tool"><i></i><span>Sanction Dataentry</span></a></li>
            <li class=" glyphicons dashboard"><a href="bi_tool"><i></i><span>BI Tool</span></a></li>

<!--            <li class="glyphicons calendar"><a href="<?php echo base_url("training_records/index"); ?>"><i></i><span>Training Management</span></a></li>
<li class="glyphicons gift"><a href="<?php echo base_url("specialities_record/index"); ?>"><i></i><span>Speciality/Skills Management</span></a></li>
<li class="glyphicons google_maps"><a href="<?php echo base_url("posting_place/index"); ?>"><i></i><span>Posting Place Management</span></a></li>
<li class="glyphicons notes"><a href="<?php echo base_url("district_management/index"); ?>"><i></i><span>District Management</span></a></li>
<li class="glyphicons lock"><a href="<?php echo base_url("users_management/index"); ?>"><i></i><span>Users Management</span></a></li>
<li class="glyphicons credit_card"><a href="<?php echo base_url("university_management/index"); ?>"><i></i><span>University Management</span></a></li>
<li class="glyphicons notes"><a href="<?php echo base_url("degree_management/index"); ?>"><i></i><span>Degree Management</span></a></li>
<li class="glyphicons log_book"><a href="<?php echo base_url("cadre_management/index"); ?>"><i></i><span>Cadre Management</span></a></li>
<li class="glyphicons notes"><a href="<?php echo base_url("category_management/index"); ?>"><i></i><span>Category Management</span></a></li>
<li class="glyphicons notes"><a href="<?php echo base_url("inactive_Reason/index"); ?>"><i></i><span>Inactive Reason</span></a></li>-->
        </ul>
        <!-- Larger Menu Style -->
        <!--			<ul>
                                        <li class="heading"><span>eDocs</span></li>
        <?php
        //echo $_SESSION['role'];
        if ($_SESSION['role'] == 3) {
            ?>
                                                
                                            <li class="large glyphicons file"><a href="user_personal_record.php"><i></i><span>Personal Record</span></a></li>
                
            <?php
        } else {
            ?>
                                            <li class="large glyphicons file"><a href="personal_record.php"><i></i><span>Personal Record</span></a></li>
                
        <?php }
        ?>
                                        <li class="large glyphicons file"><a href="training_record.php"><i></i><span>Trainings Management</span></a></li>
                                        <li class="large glyphicons file"><a href="specialities_record.php"><i></i><span>Speciality/Skills Management</span></a></li>
        
                                        <li class="large glyphicons file"><a href="posting_place.php"><i></i><span>Posting Place Management</span></a></li>
        <?php if ($_SESSION['role'] == 1) { ?>
                                                <li class="large glyphicons file"><a href="districts.php"><i></i><span>District Management</span></a></li>
                                                <li class="large glyphicons file"><a href="users.php"><i></i><span>Users Management</span></a></li>
        <?php } ?>
                                        <li class="large glyphicons file"><a href="university.php"><i></i><span>University Management</span></a></li>
                                        <li class="large glyphicons file"><a href="degree.php"><i></i><span>Degree Management</span></a></li>
                                        
                                        <li class="large hasSubmenu glyphicons log_book">
                                                <a data-toggle="collapse" href="#menu_tasks"><i></i><span>Task Management</span></a>
                                                <ul class="collapse" id="menu_tasks">
                                                        <li class=""><a href="tasks.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Tasks Overview</span></a></li>
                                                        <li class=""><a href="error.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Manage Projects</span></a></li>
                                                        <li class=""><a href="error.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Manage Team</span></a></li>
                                                </ul>
                                                <span class="count">3</span>
                                        </li>
                                </ul>-->

        <!-- Regular Size Menu -->
        <!--			<ul>
                                
                                                                        
                                                                         Menu Regular Item 
                                        <li class="glyphicons display"><a href="dashboard.php"><i></i><span>Dashboard</span></a></li>
                                        
                                         Landing Submenu Level 1 
                                        <li class="hasSubmenu">
                                                <a data-toggle="collapse" class="glyphicons notes" href="#menu_landing"><i></i><span>e Docs</span></a>
                                                <ul class="collapse" id="menu_landing">
                                                        <li class=""><a href="file-management.php"><span>File Management</span></a></li>
                                                        <li class=""><a href="file-tracking.php"><span>File Tracking</span></a></li>
                                                </ul>
                                                <span class="count">2</span>
                                        </li>
                                         // Gallery Submenu Level 1 END 
                                                                        
                                </ul>-->
        <div class="clearfix"></div>
        <div class="separator bottom"></div>
        <!-- // Regular Size Menu END -->

        <!-- Sidebar Stats Widgets -->
        <!--			<div class="widget-sidebar-stats">
                                        <strong>0</strong>
                                        <span>Messages</span>
                                        <span class="pull-right sparkline"></span>
                                        <div class="clearfix"></div>
                                </div>-->

        <div class="separator bottom"></div>
        <!-- // Sidebar Stats Widgets END -->

        <!-- Stats Widget -->
        <!--			<a href="" class="widget-stats widget-stats-2 widget-stats-easy-pie widget-sidebar-stats txt-single">
                                        <div data-percent="90" class="easy-pie primary"><span class="value">90</span>%</div>
                                        <span class="txt">Completed tasks</span>
                                        <div class="clearfix"></div>
                                </a>-->
        <!-- // Stats Widget END -->


        <div class="clearfix"></div>
        <!-- // Larger Menu Style END -->

        <!-- Sidebar Stats Widgets -->
        <!--			<div class="separator bottom"></div>
                                <div class="widget-sidebar-stats">
                                        <span>HDD <strong class="pull-right">80% used</strong></span>
                                        <div class="progress progress-danger">
                                                <div class="bar" style="width: 80%;"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                
                                </div>
                                <div class="widget-sidebar-stats">
                                        <span>Mail <strong class="pull-right">65% used</strong></span>
                                        <div class="progress progress-success">
                                                <div class="bar" style="width: 65%;"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                                <div class="widget-sidebar-stats">
                                        <h5>Generic widget</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>-->
        <!-- // Sidebar Stats Widgets END -->



    </div>
    <!-- // Scrollable Menu wrapper with Maximum Height END -->

</div>
<!-- // Sidebar Menu END -->
<!-- Top navbar -->
<div class="navbar main hidden-print">
    <!-- Brand -->
    <a href="#" class="appbrand pull-left"><span>HR KP</span></a>
    <!-- Menu Toggle Button -->
<!--    <button type="button" class="btn btn-navbar">
        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
    </button>-->
    <!-- // Menu Toggle Button END -->
    <!-- Top Menu -->
<!--    <ul class="topnav pull-left tn1">
         Themer 
        <li class="hidden-phone">
            <a href="#" data-target="#themer" data-toggle="collapse" class="glyphicons eyedropper"><i></i><span>Themer</span></a>
        </li>
         // Themer END 
    </ul>-->
    <!-- // Top Menu END -->
    <!-- Top Menu Right -->
    <ul class="topnav pull-right">
        <!-- Profile / Logout menu -->
        <li><a href="User_Guide.pdf" target="_blank">Download user guide</a></li>
        <li class="account">
            <a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span class="hidden-phone text"><?php echo $_SESSION['username']; ?></span><i></i></a>
            <ul class="dropdown-menu pull-right">
<!--						<li><a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light" class="glyphicons cogwheel">Settings<i></i></a></li>
                    <li><a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light" class="glyphicons camera">My Photos<i></i></a></li>-->
                <li class="highlight profile">
                    <span>
                        <span class="heading">Profile <a href="#" class="pull-right">edit</a></span>
                        <span class="img"></span>
                        <span class="details">
                            <a href="#"><?php echo $_SESSION['username']; ?></a>
                            <?php echo $_SESSION['email']; ?>
                        </span>
                        <span class="clearfix"></span>
                    </span>
                </li>
                <li>
                    <span>
                        <a class="btn btn-default btn-mini pull-right" href="logout.php">Sign Out</a>
                    </span>
                </li>
            </ul>
        </li>
        <!-- // Profile / Logout menu END -->
    </ul>
    <!-- // Top Menu Right END -->
</div>
<!-- Top navbar END -->
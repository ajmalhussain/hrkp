<!-- Sidebar Menu -->


		<div id="menu" class="hidden-phone hidden-print">
		
			<!-- Scrollable menu wrapper with Maximum height -->
			<div class="slim-scroll" data-scroll-height="800px">
			
			<!-- Sidebar Profile -->
			<span class="profile">
				<!--<a class="img" href="my-account.php"><img src="#" alt="<?php echo $_SESSION['username']; ?>" /></a>-->
				<span>
					<strong>Welcome</strong>
					<a href="my-account.php" class="glyphicons right_arrow"><?php echo $_SESSION['username']; ?> <i></i></a>
				</span>
			</span>
			<!-- // Sidebar Profile END -->
			
<!--			 Sidebar Mini Stats 
			<div id="notif">
				<ul>
					<li><a href="#" class="glyphicons envelope"><i></i> 5</a></li>
					<li><a href="#" class="glyphicons log_book"><i></i> 3</a></li>
				</ul>
			</div>-->
			<!-- // Sidebar Mini Stats END -->
			
                        <!-- Larger Menu Style -->
			<ul>
				<!--<li class="heading"><span>eDocs</span></li>-->
                            <?php
                            
                            //echo $_SESSION['role'];
                            if($_SESSION['role'] == 3){?>
                                
                            <li class="large glyphicons file"><a href="user_personal_record.php"><i></i><span>Personal Record</span></a></li>

                             <?php   
                            }else{
                                ?>
                            <li class="large glyphicons file"><a href="personal_record.php"><i></i><span>Personal Record</span></a></li>

                          <?php  }
                            
                            ?>
				<li class="large glyphicons file"><a href="<?php echo base_url("training_records/index"); ?>"><i></i><span>Trainings Management</span></a></li>
				<li class="large glyphicons file"><a href="specialities_record.php"><i></i><span>Speciality/Skills Management</span></a></li>

                                <li class="large glyphicons file"><a href="posting_place.php"><i></i><span>Posting Place Management</span></a></li>
                                <?php if($_SESSION['role'] == 1) { ?>
                                <li class="large glyphicons file"><a href="districts.php"><i></i><span>District Management</span></a></li>
                                <li class="large glyphicons file"><a href="users.php"><i></i><span>Users Management</span></a></li>
                                <?php } ?>
                                <li class="large glyphicons file"><a href="university.php"><i></i><span>University Management</span></a></li>
                                <li class="large glyphicons file"><a href="degree.php"><i></i><span>Degree Management</span></a></li>
                                
<!--				<li class="large hasSubmenu glyphicons log_book">
					<a data-toggle="collapse" href="#menu_tasks"><i></i><span>Task Management</span></a>
					<ul class="collapse" id="menu_tasks">
						<li class=""><a href="tasks.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Tasks Overview</span></a></li>
						<li class=""><a href="error.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Manage Projects</span></a></li>
						<li class=""><a href="error.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light"><span>Manage Team</span></a></li>
					</ul>
					<span class="count">3</span>
				</li>-->
			</ul>
                        
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
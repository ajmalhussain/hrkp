<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
<head>
	<title>HRKP - Admin</title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	
	<!-- Bootstrap -->
	<link href="common/bootstrap/css/bootstrap.css" rel="stylesheet" />
	<link href="common/bootstrap/css/responsive.css" rel="stylesheet" />
	
	<!-- Glyphicons Font Icons -->
	<link href="common/theme/css/glyphicons.css" rel="stylesheet" />
	
	<!-- Uniform Pretty Checkboxes -->
	<link href="common/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css" rel="stylesheet" />
	
	<!-- PrettyPhoto -->
    <link href="common/theme/scripts/plugins/gallery/prettyphoto/css/prettyPhoto.css" rel="stylesheet" />
	
	<!-- Bootstrap Extended -->
	<link href="common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="common/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
	<link href="common/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	<link href="common/bootstrap/extend/bootstrap-select/bootstrap-select.css" rel="stylesheet" />
	<link href="common/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" rel="stylesheet" />
	
	<!-- Select2 Plugin -->
	<link href="common/theme/scripts/plugins/forms/select2/select2.css" rel="stylesheet" />
	
	<!-- DateTimePicker Plugin -->
	<link href="common/theme/scripts/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" rel="stylesheet" />
	
	<!-- JQueryUI -->
	<link href="common/theme/scripts/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	
	<!-- MiniColors ColorPicker Plugin -->
	<link href="common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css" rel="stylesheet" />
	
	<!-- Notyfy Notifications Plugin -->
	<link href="common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.css" rel="stylesheet" />
	<link href="common/theme/scripts/plugins/notifications/notyfy/themes/default.css" rel="stylesheet" />
	
	<!-- Gritter Notifications Plugin -->
	<link href="common/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css" rel="stylesheet" />
	
	<!-- Easy-pie Plugin -->
	<link href="common/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.css" rel="stylesheet" />

	<!-- Google Code Prettify Plugin -->
	<link href="common/theme/scripts/plugins/other/google-code-prettify/prettify.css" rel="stylesheet" />

	<!-- Main Theme Stylesheet :: CSS -->
	<link href="common/theme/css/style-light.css?1369414383" rel="stylesheet" />
	
	
	<!-- LESS.js Library -->
	<script src="common/theme/scripts/plugins/system/less.min.js"></script>
</head>
<body class="">
	
		<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">
		
		<!-- Top navbar -->
		<div class="navbar main hidden-print">
		
			<!-- Brand -->
			<a href="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light" class="appbrand pull-left"><span>AdminKIT <span>v1.5</span></span></a>
			
						<!-- Menu Toggle Button -->
			<button type="button" class="btn btn-navbar">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
			</button>
			<!-- // Menu Toggle Button END -->
						
						<!-- Top Menu -->
			<ul class="topnav pull-left tn1">
			
								<!-- Themer -->
				<li class="hidden-phone">
					<a href="#" data-target="#themer" data-toggle="collapse" class="glyphicons eyedropper"><i></i><span>Themer</span></a>
				</li>
				<!-- // Themer END -->
								
								
			</ul>
			<!-- // Top Menu END -->
						
						
			<!-- Top Menu Right -->
			<?php include 'template/top-menu.php'; ?>
			<!-- // Top Menu Right END -->
			
						
		</div>
		<!-- Top navbar END -->
		
				<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">
		
		<!-- Sidebar Menu -->
		<?php include 'template/left-menu.php'; ?>
		<!-- // Sidebar Menu END -->
				
		<!-- Content -->
		<div id="content">
	<!-- Breadcrumb -->
<ul class="breadcrumb">
	<li><a href="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left&amp;style=style-light" class="glyphicons home"><i></i> AdminKIT</a></li>
	<li class="divider"></li>
	<li>Form Wizards</li>
</ul>
<!-- // Breadcrumb END -->

<h3 class="heading-mosaic">Form Wizards</h3>
<div class="innerLR">

	
	<!-- Form Wizard / Widget Tabs / Simple -->
	<div class="wizard">
		<div class="widget widget-tabs">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<ul>
					<li class="active"><a href="#tab1-1" class="glyphicons home" data-toggle="tab"><i></i>First</a></li>
					<li><a href="#tab2-1" class="glyphicons umbrella" data-toggle="tab"><i></i>Second</a></li>
					<li><a href="#tab3-1" class="glyphicons fishes" data-toggle="tab"><i></i>Third</a></li>
					<li><a href="#tab4-1" class="glyphicons car" data-toggle="tab"><i></i>Fourth</a></li>
					<li><a href="#tab5-1" class="glyphicons leaf" data-toggle="tab"><i></i>Fifth</a></li>
					<li><a href="#tab6-1" class="glyphicons cup" data-toggle="tab"><i></i>Sixth</a></li>
					<li><a href="#tab7-1" class="glyphicons tie" data-toggle="tab"><i></i>Seventh</a></li>
				</ul>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
				<div class="tab-content">
				
					<!-- Step 1 -->
					<div class="tab-pane active" id="tab1-1">
						<div class="row-fluid">
							<div class="span3">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span3">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span3">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span3">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span9">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span9">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
							<div class="span9">
								<label for="inputTitle">Title</label>
								<input type="text" id="inputTitle" class="span6" value="" placeholder="Enter product title ..." />
								<div class="separator"></div>
							</div>
						</div>
					</div>
					<!-- // Step 1 END -->
					
					<!-- Step 2 -->
					<div class="tab-pane" id="tab2-1">
						<div class="row-fluid">
							<div class="span3">
								<strong>Description</strong>
								<p class="muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							</div>
							<div class="span9">
								<label for="textDescription">Description</label>
								<textarea id="textDescription" class="wysihtml5" style="width: 96%;" rows="5">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</textarea>
							</div>
						</div>
					</div>
					<!-- // Step 2 END -->
					
					<!-- Step 3 -->
					<div class="tab-pane" id="tab3-1">
						<h4>Third tab</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices libero vel massa egestas facilisis. Mauris convallis augue nec dolor dignissim vestibulum. Praesent imperdiet elit posuere arcu posuere consectetur. Morbi dignissim eleifend nibh, eget tincidunt nibh dignissim hendrerit. Cras iaculis congue lorem, eget gravida augue vehicula sed. Nam lorem sem, consectetur ac tempus quis, consectetur ut lectus. In bibendum luctus pharetra. Morbi lacinia sem sem. Phasellus quis tellus magna.</p>
					</div>
					<!-- // Step 3 END -->
					
					<!-- Step 4 -->
					<div class="tab-pane" id="tab4-1">
						<h4>Fourth tab</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices libero vel massa egestas facilisis. Mauris convallis augue nec dolor dignissim vestibulum. Praesent imperdiet elit posuere arcu posuere consectetur. Morbi dignissim eleifend nibh, eget tincidunt nibh dignissim hendrerit. Cras iaculis congue lorem, eget gravida augue vehicula sed. Nam lorem sem, consectetur ac tempus quis, consectetur ut lectus. In bibendum luctus pharetra. Morbi lacinia sem sem. Phasellus quis tellus magna.</p>
					</div>
					<!-- // Step 4 END -->
					
					<!-- Step 5 -->
					<div class="tab-pane" id="tab5-1">
						<h4>Fifth tab</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices libero vel massa egestas facilisis. Mauris convallis augue nec dolor dignissim vestibulum. Praesent imperdiet elit posuere arcu posuere consectetur. Morbi dignissim eleifend nibh, eget tincidunt nibh dignissim hendrerit. Cras iaculis congue lorem, eget gravida augue vehicula sed. Nam lorem sem, consectetur ac tempus quis, consectetur ut lectus. In bibendum luctus pharetra. Morbi lacinia sem sem. Phasellus quis tellus magna.</p>
					</div>
					<!-- // Step 5 END -->
					
					<!-- Step 6 -->
					<div class="tab-pane" id="tab6-1">
						<h4>Sixth tab</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices libero vel massa egestas facilisis. Mauris convallis augue nec dolor dignissim vestibulum. Praesent imperdiet elit posuere arcu posuere consectetur. Morbi dignissim eleifend nibh, eget tincidunt nibh dignissim hendrerit. Cras iaculis congue lorem, eget gravida augue vehicula sed. Nam lorem sem, consectetur ac tempus quis, consectetur ut lectus. In bibendum luctus pharetra. Morbi lacinia sem sem. Phasellus quis tellus magna.</p>
					</div>
					<!-- // Step 6 END -->
					
					<!-- Step 7 -->
					<div class="tab-pane" id="tab7-1">
						<h4>Seventh tab</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices libero vel massa egestas facilisis. Mauris convallis augue nec dolor dignissim vestibulum. Praesent imperdiet elit posuere arcu posuere consectetur. Morbi dignissim eleifend nibh, eget tincidunt nibh dignissim hendrerit. Cras iaculis congue lorem, eget gravida augue vehicula sed. Nam lorem sem, consectetur ac tempus quis, consectetur ut lectus. In bibendum luctus pharetra. Morbi lacinia sem sem. Phasellus quis tellus magna.</p>
					</div>
					<!-- // Step 7 END -->
					
				</div>
				
				<!-- Wizard pagination controls -->
				<div class="pagination margin-bottom-none">
					<ul>
						<li class="primary previous first"><a href="javascript:;">First</a></li>
						<li class="primary previous"><a href="javascript:;">Previous</a></li>
						<li class="last primary"><a href="javascript:;">Last</a></li>
					  	<li class="next primary"><a href="javascript:;">Next</a></li>
						<li class="next finish primary" style="display:none;"><a href="javascript:;">Finish</a></li>
					</ul>
				</div>
				<!-- // Wizard pagination controls END -->
				
			</div>
		</div>
	</div>
	<!-- // Form Wizard / Widget Tabs / Simple END -->
	
	

	<!-- JQuery -->
	<script src="common/theme/scripts/plugins/system/jquery.min.js"></script>
	
	<!-- JQueryUI -->
	<script src="common/theme/scripts/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script>
	
	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="common/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- Modernizr -->
	<script src="common/theme/scripts/plugins/system/modernizr.js"></script>
	
	<!-- Bootstrap -->
	<script src="common/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- SlimScroll Plugin -->
	<script src="common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js"></script>
	
	<!-- Common Demo Script -->
	<script src="common/theme/scripts/demo/common.js?1369414383"></script>
	
	<!-- Holder Plugin -->
	<script src="common/theme/scripts/plugins/other/holder/holder.js"></script>
	
	<!-- Uniform Forms Plugin -->
	<script src="common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script>
	
	<!-- PrettyPhoto -->
	<script src="common/theme/scripts/plugins/gallery/prettyphoto/js/jquery.prettyPhoto.js"></script>
	
	<!-- Global -->
	<script>
	var basePath = 'common/';
	</script>

	<!-- Bootstrap Extended -->
	<script src="common/bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="common/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="common/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
	<script src="common/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js"></script>
	<script src="common/bootstrap/extend/bootbox.js"></script>
	<script src="common/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js"></script>
	<script src="common/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js"></script>
	
	<!-- Google Code Prettify -->
	<script src="common/theme/scripts/plugins/other/google-code-prettify/prettify.js"></script>
	
	<!-- Gritter Notifications Plugin -->
	<script src="common/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js"></script>
	
	<!-- Notyfy Notifications Plugin -->
	<script src="common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.js"></script>
	
	<!-- MiniColors Plugin -->
	<script src="common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js"></script>
	
	<!-- DateTimePicker Plugin -->
	<script src="common/theme/scripts/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Cookie Plugin -->
	<script src="common/theme/scripts/plugins/system/jquery.cookie.js"></script>
	
	<!-- Colors -->
	<script>
	var primaryColor = '#e25f39',
		dangerColor = '#bd362f',
		successColor = '#609450',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	</script>
	
	<!-- Themer -->
	<script>
	var themerPrimaryColor = primaryColor;
	</script>
	<script src="common/theme/scripts/demo/themer.js"></script>
	
	<!-- Twitter Feed -->
	<script src="common/theme/scripts/demo/twitter.js"></script>
	
	<!-- Easy-pie Plugin -->
	<script src="common/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.js"></script>
	
	<!-- Sparkline Charts Plugin -->
	<script src="common/theme/scripts/plugins/charts/sparkline/jquery.sparkline.min.js"></script>
	
	<!-- Ba-Resize Plugin -->
	<script src="common/theme/scripts/plugins/other/jquery.ba-resize.js"></script>
	
	<!-- Optional Resizable Sidebars -->
	<!--[if gt IE 8]><!--><script src="common/theme/scripts/demo/resizable.js?1369414383"></script><!--<![endif]-->
	
	<!-- Bootstrap Form Wizard Plugin -->
	<script src="common/bootstrap/extend/twitter-bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
	
	<!-- Form Wizards Page Demo Script -->
	<script src="common/theme/scripts/demo/form_wizards.js"></script>

</body>
</html>
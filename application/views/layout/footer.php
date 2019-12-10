	
</div></div>
<div class="clearfix"></div>
<!-- // Sidebar menu & content wrapper END -->

<div id="footer" class="hidden-print">

    <!--  Copyright Line -->
    <div class="copy">&copy; <?php echo date("Y"); ?> - <a href="#">HR KP</a> - All Rights Reserved.</div>
    <!--  End Copyright Line -->

</div>
<!-- // Footer END -->

</div>
<!-- // Main Container Fluid END -->

<div id="themer" class="collapse">
    <div class="wrapper">
        <span class="close2">&times; close</span>
        <h4>Themer <span>color options</span></h4>
        <ul>
            <li>Theme: <select id="themer-theme" class="pull-right"></select><div class="clearfix"></div></li>
            <li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" /><div class="clearfix"></div></li>
            <li>
                <span class="link" id="themer-custom-reset">reset theme</span>
                <span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
            </li>
        </ul>
        <div id="themer-getcode" class="hide">
            <hr class="separator" />
            <button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
            <button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
            <div class="clearfix"></div>
        </div>
    </div>
</div>


<!-- JQuery -->
<script src="<?php echo base_url('common/theme/scripts/plugins/system/jquery.min.js') ?>"></script>

<!-- JQueryUI -->
<script src="<?php echo base_url('common/theme/scripts/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>

<!-- JQueryUI Touch Punch -->
<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
<script src="<?php echo base_url('common/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') ?>"></script>

<!-- Modernizr -->
<script src="<?php echo base_url('common/theme/scripts/plugins/system/modernizr.js') ?>"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url('common/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- SlimScroll Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js') ?>"></script>

<!-- Common Demo Script -->
<script src="<?php echo base_url('common/theme/scripts/demo/common.js?1369414384') ?>"></script>

<!-- Holder Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/other/holder/holder.js') ?>"></script>

<!-- Uniform Forms Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js') ?>"></script>

<!-- PrettyPhoto -->
<script src="<?php echo base_url('common/theme/scripts/plugins/gallery/prettyphoto/js/jquery.prettyPhoto.js') ?>"></script>

<!-- Global -->
<script>
    var basePath = 'common/';
</script>

<!-- Bootstrap Extended -->
<script src="<?php echo base_url('common/bootstrap/extend/bootstrap-select/bootstrap-select.js') ?>"></script>
<script src="<?php echo base_url('common/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js') ?>"></script>
<!--<script src="<?php echo base_url('common/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js') ?>"></script>-->
<script src="<?php echo base_url('common/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('common/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js') ?>"></script>
<script src="<?php echo base_url('common/bootstrap/extend/bootbox.js') ?>"></script>
<script src="<?php echo base_url('common/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js') ?>"></script>
<script src="<?php echo base_url('common/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js') ?>"></script>

<!-- Google Code Prettify -->
<script src="<?php echo base_url('common/theme/scripts/plugins/other/google-code-prettify/prettify.js') ?>"></script>

<!-- Gritter Notifications Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js') ?>"></script>

<!-- Notyfy Notifications Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.js') ?>"></script>

<!-- MiniColors Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js') ?>"></script>

<!-- Cookie Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/system/jquery.cookie.js') ?>"></script>

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
<script src="<?php echo base_url('common/theme/scripts/demo/themer.js') ?>"></script>

<!-- Twitter Feed -->
<!--<script src="<?php echo base_url('common/theme/scripts/demo/twitter.js') ?>"></script>-->

<!-- Easy-pie Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.js') ?>"></script>

<!-- Sparkline Charts Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/charts/sparkline/jquery.sparkline.min.js') ?>"></script>

<!-- Ba-Resize Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/other/jquery.ba-resize.js') ?>"></script>




<!-- DataTables Tables Plugin -->
<script src="<?php echo base_url('common/theme/scripts/plugins/tables/DataTables/media/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('common/theme/scripts/plugins/tables/DataTables/media/js/DT_bootstrap.js') ?>"></script>

<!-- Tables Demo Script -->
<script src="<?php echo base_url('common/theme/scripts/demo/tables.js') ?>"></script>
<script src="<?php echo base_url('common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js') ?>"></script>
<!-- Optional Resizable Sidebars -->
<!--[if gt IE 8]><!--><script src="<?php echo base_url('common/theme/scripts/demo/resizable.js?1369414384') ?>"></script><!--<![endif]-->

<?php include 'js.php'; ?>
</body>
</html>

<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url("profile/index"); ?>" class="glyphicons home"><i></i> Home</a></li>
        <li class="divider"></li>
        <li>Manage HR</li>
    </ul>
    <div class="separator bottom"></div>
    <!-- // Breadcrumb END -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'status') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> Record has been deleted successfully!
        </div>
    <?php } ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'file') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <!-- <?php echo $_SESSION['msg']; ?> -->
        </div>
    <?php } ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'forbidden') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Forbidden!</strong> You don't have permission to do this! Please contact your administrator!
        </div>
    <?php } ?>
    <!-- Heading -->
    <div class="heading-buttons">
        <h3>Manage Districts</h3>
        <div class="buttons pull-right">
            <a href="#add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i>Add</a>
            <a href="<?php echo base_url("district_management/export_excel")?>" class="btn btn-primary btn-icon glyphicons download"><i></i>Export to Excel</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">
        <?php
//        require_once 'classes/district.php';
//        require_once 'classes/datetime.php';
//
//        $doc = new district();
//
//        $result = $doc->find_all();
//        if ($result) {
        if ($result) {
        $data = $result->result_array();

            ?>
            <!-- Table -->

            <table class="dynamicTable table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>District Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table row -->
                    <?php
                   $array_replace = array(2=> 'Province',3=> 'District',6=> 'Tehsil/Town');
                   $count = 1;
                   foreach ($data as $row) {

                       $class = "gradeX";
                       if ($count % 2 == 0) {
                           $class = "gradeC";
                       }
                        //$attchment = new attachments();
                        //$att_count = $attchment->count_all($row['pk_id']);
                        ?>
                        <tr class="<?php  echo $class; ?>">
                            <td class="center"><?php  echo $count; ?></td>
                            <td><?php  echo $row['LocName']; ?></td>
                            <td class="important"><?php // echo $array_replace[$row['LocLvl']]; ?></td>
                            <td class="important"><?php // echo $row['pro']; ?></td>
                            <td class="center" style="width: 200px;">
                                <a href="#edit" data-toggle="modal" id="<?php  echo $row['PkLocID']; ?>-did" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                <a onclick="return confirm('Are you sure you want to <?php// echo ($row['status'] == 0 ? 'activate' : 'delete'); ?>?');" href="districts_status.php?id=<?php //echo $row['PkLocID']; ?>&status=<?php  //echo ($row['status'] == 1 ? '0' : '1'); ?>" class="btn-action glyphicons bin" ><i></i></a>
                                <a onclick="return confirm('Are you sure you want to delete?');" href="delete_district.php?id=<?php echo $row['PkLocID']; ?>" class="btn-action glyphicons bin" title="delete"><i></i></a>
                            </td>
                        </tr>
                        <?php
                       $count++;
                   }
                    ?>
                    <!-- // Table row END -->
                    <!-- Table row -->

                    <!-- // Table row END -->
                </tbody>
            </table>
            <!-- // Table END -->
            <?php
       } else {
           echo "<hr><h5> No records found!</h5>";
       }
        ?>

   

    </div>

</div>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="<?php echo base_url('district_management/add'); ?>">
    <div class="modal hide fade" id="add">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Add district</h3>
        </div>
        <div class="modal-body">
            <!-- Row -->
            <div class="row-fluid">

                <!-- Column -->
                <div class="span12">

                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="LocName">District Name</label>
                        <div class="controls"><input class="span12" id="LocName" name="LocName" type="text" /></div>
                        <!--<div class="pull-right" style=" color: red;"> <?php echo "district already exist"; ?></div>-->
                        
                    </div>                        
<!--                    <div class="control-group">
                        <label class="control-label" for="lvl">Level</label>
                        <div class="controls">
                            <select name="lvl" id="lvl" class="span12">
                                <option value="National">National</option>
                                <option value="Province">Province</option>
                                <option value="">Select</option>
                                <option value="District">District</option>
                                <option value="Posting Place">Posting Place</option>
                                <option value="Received From">Received From</option>
                            </select>
                            </div>
                    </div>  -->
                  
<!--                    <div class="control-group">
                        <label class="control-label" for="district_of_domicile1" id="district_of_domicile1" style=" display:none;">District</label>
                        <div class="controls">
                            <select class="span12" id="district_of_domicile" name="district_of_domicile" style=" display:none;">
                                <option value="">Select</option>
                                <?php
//                                $location = new locations();
//                                $result = $location->districtdropdown2();
//                                while ($row = $result->fetch_assoc()) {
//                                    ?>
                                    <option value="//<?php // echo $row['PkLocID']; ?>"><?php // echo $row['LocName']; ?></option>
                                    //<?php
//                                }
//                                ?>
                            </select></div>
                    </div>-->
         
                </div>
                <!-- // Column END -->

<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

            </div>
 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_district.php">
    <div class="modal hide fade" id="edit">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Edit</h3>
        </div>
        <div class="modal-body" id="editdiv">
            <div class="center"><img src="<?php echo base_url('common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif'); ?>" /></div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="upload.php">
    <div class="modal hide fade" id="upload">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Upload picture</h3>
        </div>
        <div class="modal-body" id="uploaddiv">
            <div class="center"><img src="common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif"/></div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Upload</button>
        </div>
    </div>
</form>

<form class="form-horizontal" style="margin-bottom: 0;" id="validateForm" method="post" autocomplete="off" action="#" enctype="multipart/form-data">
    <div class="modal hide fade" id="detail">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>View Detail</h3>
        </div>
        <div class="modal-body" id="detaildiv">
            <div class="center"><img src="common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif"/></div>
        </div>
        <div class="modal-footer">
            <!--<button disabled="" id="submit" type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>-->
        </div>
    </div>
</form>


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
    <?php if (isset($_GET['is_active']) && $_GET['is_active'] == 'is_active') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> Record has been deleted successfully!
        </div>
    <?php } ?>
    <?php if (isset($_GET['is_active']) && $_GET['is_active'] == 'file') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo $_SESSION['msg']; ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['is_active']) && $_GET['is_active'] == 'forbidden') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Forbidden!</strong> You don't have permission to do this! Please contact your administrator!
        </div>
    <?php } ?>
    <!-- Heading -->
    <div class="heading-buttons">
        <h3>Training Record</h3>
        <div class="buttons pull-right">
            <a href="#add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i>Add</a>
            <a href="export.php" class="btn btn-primary btn-icon glyphicons download"><i></i>Export to Excel</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">
        <?php
//        require_once 'classes/training.php';
//        require_once 'classes/datetime.php';
//
//        $doc = new training();
//
//        $result = $doc->find_all();
//  
       if ($result) {
        $data = $result->result_array();
        
        ?>
        <!-- Table -->

        <table class="dynamicTable table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th style="width: 1%;" class="center">No.</th>
                    <th>title</th>
                    <th>Training Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table row -->
                <?php
                 $count = 1;
                   foreach ($data as $row) {

                       $class = "gradeX";
                       if ($count % 2 == 0) {
                           $class = "gradeC";
                       }
                //$attchment = new attachments();
                //$att_count = $attchment->count_all($row['pk_id']);
                ?>
                <tr class="<?php echo $class;  ?>">
                    <td class="center"><?php echo $count;  ?></td>
                    <td><?php echo $row['title'];  ?></td>
                    <td class="important"><?php echo $row['training_date'];  ?></td>
                    <td class="center" style="width: 200px;">
                        <a onclick="return confirm('Are you sure you want to <?php echo ($row['is_active'] == 0 ? 'activate' : 'delete');  ?>?');" href="<?php echo base_url('training_records/delete'); ?>?id=<?php echo $row['pk_id'];  ?>&is_active=<?php echo ($row['is_active'] == 1 ? '0' : '1');  ?>" class="btn-action glyphicons bin" ><i></i></a>
                        <a href="#edit" data-toggle="modal" id="<?php echo $row['pk_id'];  ?>-fid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                        <a onclick="return confirm('Are you sure you want to delete?');" href="<?php echo base_url('training_records/delete'); ?>?id=<?php echo $row['pk_id'];  ?>" class="btn-action glyphicons bin" title="delete"><i></i></a>
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

        <!--         With selected options 
                <div class="separator top form-inline small">
                    <div class="pull-left checkboxs_actions hide">
                        <label class="strong">With selected:</label>
                        <select class="selectpicker" data-style="btn-default btn-small" onchange="return confirm('Do you want to delete all the files?')">
                            <option>Select</option>
                            <option>Delete All</option>
                        </select>
                    </div>
                     // With selected options END 
                    <div class="clearfix"></div>
                </div>
                 // Pagination END -->

    </div>

</div>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="<?php echo base_url("training_records/add"); ?>">
    <div class="modal hide fade" id="add">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Add Training</h3>
        </div>
        <div class="modal-body">
            <!-- Row -->
            <div class="row-fluid">

                <!-- Column -->
                <div class="span12">

                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="title">Title</label>
                        <div class="controls"><input class="span12" id="title" name="title" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="training_date">Training Date</label>
                        <div class="controls"><input class="span12" id="training_date" name="training_date" type="text" /></div>
                    </div>          
                </div>
                <!-- // Column END -->

                <!-- CSRF token -->
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />


            </div>
            <!-- // Row END -->



        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="<?php echo base_url('training_records/add'); ?>">
    <div class="modal hide fade" id="edit">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Edit</h3>
        </div>
        <div class="modal-body" id="editdiv">
            <div class="center"><img src="<?php echo base_url('common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif'); ?>"/></div>
        </div>
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
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
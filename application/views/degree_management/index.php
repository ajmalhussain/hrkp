<?php // include 'template/header.php'; ?>
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
        <h3>Degree</h3>
        <div class="buttons pull-right">
            <a href="#add" data-toggle="modal" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i>Add</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">
        <?php
//        require_once 'classes/degree.php';
//        require_once 'classes/datetime.php';
//
//        $doc = new degree();
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
                        <th>Degree Title</th>
                        <th>Duration</th>
                        <th>Degree Recognised By</th>
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

                       $status_del = ($row['is_active'] == 1 ? '0' : '1');
                       $pk_id = $row['pk_id'];
                        //$attchment = new attachments();
                        //$att_count = $attchment->count_all($row['pk_id']);
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <td class="center"><?php  echo $count; ?></td>
                            <td><?php  echo $row['degree_title']; ?></td>                         
                            <td class="important"><?php  echo $row['duration']; ?></td>
                            <td class="important"><?php  echo $row['degree_recognised_by']; ?></td>
                            <td class="center" style="width: 200px;">
                                <a href="#edit" data-toggle="modal" id="<?php  echo $row['pk_id']; ?>-deid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                <a onclick="return confirm('Are you sure you want to <?php  echo ($row['is_active'] == 0 ? 'activate' : 'delete'); ?>?');" href="<?php echo base_url("degree_management/delete")? id=".$pk_id.")&is_active=".$status_del."); ?>" class="btn-action glyphicons bin" ><i></i></a>

                                <!-- <a onclick="return confirm('Are you sure you want to delete?');" href="delete_degree.php?id=<?php  //echo $row['pk_id']; ?>" class="btn-action glyphicons bin" title="delete"><i></i></a> -->
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

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="<?php echo base_url("degree_management/add"); ?>">
    <div class="modal hide fade" id="add">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Add degree</h3>
        </div>
        <div class="modal-body">
            <!-- Row -->
            <div class="row-fluid">

                <!-- Column -->
                <div class="span12">

                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="degree_title">Degree Title</label>
                        <div class="controls"><input class="span12" id="degree_title" name="degree_title" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="duration">Duration</label>
                        <div class="controls"><input class="span12" id="duration" name="duration" type="text" /></div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label" for="degree_recognised_by">Degree Recognised  By</label>
                        <div class="controls"><input class="span12" id="degree_recognised_by" name="degree_recognised_by" type="text" /></div>
                    </div>  
              
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

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_degree.php">
    <div class="modal hide fade" id="edit">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Edit</h3>
        </div>
        <div class="modal-body" id="editdiv">
            <div class="center"><img src="common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif"/></div>
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


<!-- // Content END -->
<?php // include 'template/footer.php'; ?>
<script>
//    $("a[id$='-fid']").click(function () {
//        var value = $(this).attr("id");
//        var id = value.replace("-fid", "");
//
//        $.ajax({
//            type: "POST",
//            url: "ajax-edit-degree.php",
//            data: {
//                id: id
//            },
//            dataType: 'html',
//            success: function (data) {
//                $('#editdiv').html(data);
//                $('#submit').removeAttr("disabled");
//                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
//            }
//        });
//    });
//
//    $("a[id$='-pid']").click(function () {
//        var value = $(this).attr("id");
//        var id = value.replace("-pid", "");
//
//        $.ajax({
//            type: "POST",
//            url: "ajax-upload.php",
//            data: {
//                id: id
//            },
//            dataType: 'html',
//            success: function (data) {
//                $('#uploaddiv').html(data);
//                $('#submit').removeAttr("disabled");
//            }
//        });
//    });
//
//    function minmax(value, min, max)
//    {
//        if (parseInt(value) < min || isNaN(parseInt(value)))
//            return min;
//        else if (parseInt(value) > max)
//            return max;
//        else
//            return value;
//    }
//
//    function emailIsValid(email) {
//        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
//    }
//
//    function cnicIsValid(cnic) {
//        return /\d{5}-\d{7}-\d/.test(cnic)
//    }
//
//    $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
//
//    $("a[id$='-did']").click(function () {
//        var value = $(this).attr("id");
//        var id = value.replace("-did", "");
//
//        $.ajax({
//            type: "POST",
//            url: "ajax-detail.php",
//            data: {
//                id: id
//            },
//            dataType: 'html',
//            success: function (data) {
//                $('#detaildiv').html(data);
//                $('#submit').removeAttr("disabled");
//            }
//        });
//    });
</script>
</body>
</html>
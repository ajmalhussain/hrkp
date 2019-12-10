<?php

include 'template/header.php'; 
require_once 'classes/locations.php';


?>
<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="#" class="glyphicons home"><i></i> Home</a></li>
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
        <h3>Manage Posting Place</h3>
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
        require_once 'classes/posting_place.php';
        require_once 'classes/datetime.php';

        $doc = new posting_place();

        $result = $doc->find_all();
        if ($result) {
            ?>
            <!-- Table -->

            <table class="dynamicTable table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>Posting Place Name</th>
                        <th>District Name</th><!--
                        <th>District</th>-->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table row -->
                    <?php
//                    $array_replace = array(2=> 'Province',3=> 'District',6=> 'Tehsil/Town');
                    $count = 1;
                    while ($row = $result->fetch_array()) {

                        $class = "gradeX";
                        if ($count % 2 == 0) {
                            $class = "gradeC";
                        }
                        //$attchment = new attachments();
                        //$att_count = $attchment->count_all($row['pk_id']);
                        ?>
                        <tr class="<?php echo $class; ?>">
                            <td class="center"><?php echo $count; ?></td>
                            <td><?php echo $row['wh_name']; ?></td>
                            <td class="important"><?php echo $row['District']; ?></td>
                            <!--<td class="important"><?php // echo $row['pro']; ?></td>-->
                            <td class="center" style="width: 200px;">
                                <a href="#edit" data-toggle="modal" id="<?php echo $row['wh_id']; ?>-fid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                <!--<a onclick="return confirm('Are you sure you want to <?php echo ($row['status'] == 0 ? 'activate' : 'delete'); ?>?');" href="posting_place_status.php?id=<?php echo $row['wh_id']; ?>&status=<?php echo ($row['status'] == 1 ? '0' : '1'); ?>" class="btn-action glyphicons bin" title="<?php echo ($row['status'] == 1 ? 'active' : 'Inactive'); ?>"><i></i></a>-->
                                
                                <a onclick="return confirm('Are you sure you want to <?php echo ($row['is_active'] == 0 ? 'activate' : 'delete'); ?>?');" href="posting_place_status.php?id=<?php echo $row['wh_id']; ?>&is_active=<?php echo ($row['is_active'] == 1 ? '0' : '1'); ?>" class="btn-action glyphicons bin" ><i></i></a>

                                <!--<a onclick="return confirm('Are you sure you want to delete?');" href="delete_posting_place.php?id=<?php echo $row['wh_id']; ?>" class="btn-action glyphicons bin" title="delete"><i></i></a>-->
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

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_posting_place.php">
    <div class="modal hide fade" id="add">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Add Posting Place</h3>
        </div>
        <div class="modal-body">
            <!-- Row -->
            <div class="row-fluid">

                <!-- Column -->
                <div class="span12">

                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="wh_name">Posting Place Name</label>
                        <div class="controls"><input class="span12" id="wh_name" name="wh_name" type="text" /></div>
                    </div>    

                                     <div class="control-group">
                        <label class="control-label" for="district_of_domicile1" id="district_of_domicile1" >District Name</label>
                        <div class="controls">
                            <select class="span12" id="district_of_domicile" name="district_of_domicile">
                                <option value="">Select</option>
                                <?php
                                $location = new locations();
                                $result = $location->districtdropdown2();
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['PkLocID']; ?>"><?php echo $row['LocName']; ?></option>
                                    <?php
                                }
                                ?>
                            </select></div>
                    </div>                   
                    
                </div>
                <!-- // Column END -->



            </div>
 
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_posting_place.php">
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
<?php include 'template/footer.php'; ?>

<script>
     
//  $(document).ready(function(){
//    
//    $('#lvl').on('change',function(){
//           var val = $(this).val();
//           console.log('V:'+val);                                
//            $.ajax({
//                success:function(html){          
//                     if(val == 'District')
//                    {
//                   
//                    $('#district_of_domicile').hide();
//                    $('#district_of_domicile1').hide();
//                   
//                    }
//                    else
//                    {
//                   $('#district_of_domicile').show();
//                   $('#district_of_domicile1').show();
//          
//                    }
//                    }
//                
//            }); 
//    });
//      });
    
    $("a[id$='-fid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-fid", "");

        $.ajax({
            type: "POST",
            url: "ajax-edit-posting-place.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });
    
        $("a[id$='-pid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-pid", "");

        $.ajax({
            type: "POST",
            url: "ajax-upload.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#uploaddiv').html(data);
                $('#submit').removeAttr("disabled");
            }
        });
    });

    function minmax(value, min, max)
    {
        if (parseInt(value) < min || isNaN(parseInt(value)))
            return min;
        else if (parseInt(value) > max)
            return max;
        else
            return value;
    }

    function emailIsValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }
    
    function cnicIsValid(cnic) {
        return /\d{5}-\d{7}-\d/.test(cnic)
    }

    $("#dob,#date_of_appointment").datepicker({dateFormat: 'dd/mm/yy'});

    $("a[id$='-did']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-did", "");

        $.ajax({
            type: "POST",
            url: "ajax-detail.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#detaildiv').html(data);
                $('#submit').removeAttr("disabled");
            }
        });
    });
</script>
</body>
</html>
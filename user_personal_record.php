<?php

include 'template/header.php';
// Include pagination library file
require_once 'classes/pagination.class.php';
require_once 'classes/personal.php';
require_once 'classes/datetime.php';

error_reporting(0);

$personal = new personal();
//error_reporting(0);

?>
<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="user_personal_record.php" class="glyphicons user"><i></i>Personal Record</a></li>
    </ul>
    <div class="separator bottom"></div>
    <!-- // Breadcrumb END -->
    <?php if (isset($_GET['status']) && $_GET['status'] == 'status') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success!</strong> Status has been updated successfully!
        </div>
    <?php } ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'file') { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo $_SESSION['msg']; ?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'forbidden') { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Forbidden!</strong> You don't have permission to do this! Please contact your administrator!
        </div>
    <?php } ?>
    <?php
    $wherestr = '';
    $where = '';
    $submit = false;
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        $submit = true;
        if (isset($_POST['personal']) && !empty($_POST['personal'])) {
            switch ($_POST['personal1']) {
                case 'district_of_domicile':
                case 'residential_city':
                case 'current_city':
                    $where[] = "locations.location_name LIKE '%" . $_POST['personal'] . "%'";
                    break;
                case 'gender':
                    $where[] = "user_personal_record." . $_POST['personal1'] . " LIKE '" . $_POST['personal'] . "%'";
                    break;
                default:
                    $where[] = "user_personal_record." . $_POST['personal1'] . " LIKE '%" . $_POST['personal'] . "%'";
                    break;
            }
        }
        if (isset($_POST['training']) && !empty($_POST['training'])) {
            $where[] = "trainings_record." . $_POST['training1'] . " LIKE '%" . $_POST['training'] . "%'";
        }
        if (isset($_POST['education']) && !empty($_POST['education'])) {
            $where[] = "educational_record." . $_POST['education1'] . " LIKE '%" . $_POST['education'] . "%'";
        }
        if (isset($_POST['children']) && !empty($_POST['children'])) {
            $where[] = "childrens_record." . $_POST['children1'] . " LIKE '%" . $_POST['children'] . "%'";
            //$doc->$_POST['children1'] = $_POST['children'];
        }
        if (isset($_POST['speciality']) && !empty($_POST['speciality'])) {
            switch ($_POST['speciality1']) {
                case 'specility':
                    $where[] = "specialities_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                    break;
                case 'title':
                case 'training_date':
                    $where[] = "trainings_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                    break;
                default:
                    $where[] = "specialities_record." . $_POST['speciality1'] . " LIKE '%" . $_POST['speciality'] . "%'";
                    break;
            }
            //$doc->$_POST['speciality1'] = $_POST['speciality'];
        }

        if (isset($_POST['posting']) && !empty($_POST['posting'])) {
            switch ($_POST['posting1']) {
                case 'name':
                case 'designation':
                case 'bps':
                    $where[] = "posts_record." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                    break;
                case 'location_name':
                    $where[] = "postplace." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                    break;
                default:
                    $where[] = "posting_record." . $_POST['posting1'] . " LIKE '%" . $_POST['posting'] . "%'";
                    break;
            }

            //$doc->$_POST['posting1'] = $_POST['posting'];
        }
    }

    if (isset($_SESSION['district_id']) && !empty($_SESSION['district_id'])) {
        $where[] = "postplace.parent_id =" . $_SESSION['district_id'];
        $submit = true;
    }

    if (is_array($where)) {
        $wherestr = " WHERE " . implode(" AND ", $where);
    }

    $personalarray = array(
        "name" => "Name",
        "father_name" => "Father Name",
        "gender" => "Gender",
        "cnic" => "CNIC",
        "district_of_domicile" => "District of domicile",
        "date_of_birth" => "Date of birth",
        "contact_no" => "Contact no",
        "email" => "Email",
        "postal_address" => "Postal address",
        "pmdc_registration" => "PMDC registration",
        "marital_status" => "Marital status",
        "residential_address" => "Residential address",
        "current_address" => "Current address",
        "residential_city" => "Residential city",
        "current_city" => "Current city"
    );

    $childrenarray = array(
        "name" => "Name",
        "date_of_birth" => "Date of birth",
        "school_name" => "School name"
    );

    $educationarray = array(
        "degree_name" => "Degree name",
        "start_date" => "Start date",
        "completion_date" => "Completion date",
        "hec_attestation_no" => "HEC attestation no"
    );

    $postingarray = array(
        "name" => "Name",
        "designation" => "Designation",
        "bps" => "BPS",
        "location_name" => "Posting place",
        "date_of_appointment" => "Date of appointment"
    );

    $otherarray = array(
        "specility" => "Specility",
        "title" => "Training title",
        "training_date" => "Training date"
    );

    // Set some useful configuration
    $baseURL = 'user_personal_record.php';
    $limit = '50';

    // Paging limit & offset
    $offset = !empty($_GET['page']) ? (($_GET['page'] - 1) * $limit) : 0;

    $limitstr = '';
    if (!$submit) {
        $limitstr = "LIMIT $offset,$limit";
    }

    $result = $personal->export_all($wherestr, $limitstr);

    // Initialize pagination class
    if ($submit) {
        $pagConfig = array(
            'baseURL' => $baseURL,
            'totalRows' => $result->num_rows,
            'perPage' => $limit
        );
    } else {
        $pagConfig = array(
            'baseURL' => $baseURL,
            'perPage' => $limit
        );
    }
    $pagination = new Pagination($pagConfig);

    //        $result = $doc->find_all();
    ?>

    <!-- Heading -->
    <div class="heading-buttons">
        <h3>Human Resource - Khyber Pakhtunkhwa</h3>
        <div class="clearfix"></div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">


        <!-- Form -->
        <form class="form-horizontal" style="margin-bottom: 0;" id="validateSubmitForm" method="POST" action="" autocomplete="off">

            <!-- Widget -->
            <div class="widget">

                <!-- Widget heading -->
                <div class="widget-head">
                    <h4 class="heading">Advance Search</h4>
                </div>
                <!-- // Widget heading END -->

                <div class="widget-body">

                    <!-- Row -->
                    <div class="row-fluid">

                        <!-- Column -->
                        <div class="span6">

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" >Personal Information</label>
                                <div class="controls">
                                    <select  id="personal1" name="personal1" class="span6">
                                        <?php foreach ($personalarray as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $_POST['personal1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                                        <?php } ?>                                            
                                    </select>
                                    <input class="span6"   name="personal" type="text"  placeholder="Enter Personal Info" value="<?php echo $_POST['personal']; ?>"  />
                                </div>
                            </div>

                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" for="lastname">Education Information</label>
                                <div class="controls">
                                    <select  id="education1" name="education1" class="span6">
                                        <?php foreach ($educationarray as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $_POST['education1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                                        <?php } ?> 
                                    </select>
                                    <input class="span6"  name="education" type="text"  placeholder="Enter Education Info" value="<?php echo $_POST['education']; ?>" />
                                </div>                               
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" >Others</label>
                                <div class="controls">
                                    <select  id="speciality1" name="speciality1" class="span6">
                                        <?php foreach ($otherarray as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $_POST['speciality1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                                        <?php } ?> 
                                    </select>
                                    <input class="span6"  name="speciality" type="text"  placeholder="Enter Specialities Info"  value="<?php echo $_POST['speciality']; ?>" />
                                </div>                                
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- // Column END -->

                        <!-- Column -->
                        <div class="span6">

                            <!-- Group -->
                            <!--                                <div class="control-group">
                                                                <label class="control-label" >Training <br>Information</label>
                                                                <div class="controls">
                                                                    <select  id="training1" name="training1" class="span6">
                            <?php foreach ($personalarray as $key => $value) { ?>
                                                                                                                                                    <option value="<?php echo $key; ?>" <?php if ($key == $_POST['personal1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                            <?php } ?> 
                                                                    </select>
                                                                    <input class="span6"  name="training" type="text"  placeholder="Enter Training Info"  value="<?php echo $_POST['training']; ?>"/>
                                                                </div>                                
                                                            </div>-->
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" >Children Information</label>
                                <div class="controls">
                                    <select  id="children1" name="children1" class="span6">
                                        <?php foreach ($childrenarray as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $_POST['children1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                                        <?php } ?> 
                                    </select>
                                    <input  class="span6" name="children" type="text"  placeholder="Enter Children Info" value="<?php echo $_POST['children']; ?>"/>
                                </div>                                
                            </div>
                            <!-- // Group END -->

                            <!-- Group -->
                            <div class="control-group">
                                <label class="control-label" >Posting <br>Information</label>
                                <div class="controls">
                                    <select  id="posting1" name="posting1" class="span6">
                                        <?php foreach ($postingarray as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php if ($key == $_POST['posting1']) { ?> selected=""<?php } ?>><?php echo $value; ?></option>
                                        <?php } ?> 
                                    </select>
                                    <input class="span6"  name="posting" type="text"  placeholder="Enter Posting Info"  value="<?php echo $_POST['posting']; ?>"/>
                                </div>                                 
                            </div>
                            <!-- // Group END -->

                        </div>
                        <!-- // Column END -->

                    </div>
                    <!-- // Row END -->
                    <hr class="separator" />
                    <!-- Form actions -->
                    <div class="row-fluid">
                        <div class="span12 right">
                            <input type="submit" value="Search" name="submit" id='submit' class="btn btn-primary">
                        </div>
                    </div>
                    <!-- // Form actions END -->

                </div>
            </div>
            <!-- // Widget END -->

        </form>
        <!-- // Form END -->
        <br>
        <!-- Table -->
        <?php
        if ($result) {
            ?>
            <div class="buttons left" style="margin-bottom: 5px;">
            <a href="export.php?data=<?php echo $wherestr; ?>" class="btn btn-primary btn-icon glyphicons download"><i></i>Export to Excel</a>
          
            <!--<a href="print_personal.php"><button class="btn btn-primary">Print</button></a>-->
             <input type="button" value="print" class="btn btn-primary" onclick="PrintDiv();" />
            </div>
        <div id="divToPrint">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>Name of Doctor</th>
                        <th>Designation/Post</th>
                        <th>Place of Posting</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table row -->
                    <?php
                    $count = $offset + 1;
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
                            <td><?php echo $row['name']; ?></td>
                            <td class="important"><?php echo $row['designation']; ?></td>
                            <td class="important"><?php echo $row['place_of_posting']; ?></td>
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
            </div>
            <div class="row-fluid">
                <div class="span12 right">
                    <?php
                    if (!$submit) {
                        echo $pagination->createLinks();
                    }
                    ?>
                </div>
            </div>
            <!-- // Table END -->
            <?php
        } else {
            echo "<hr><h5>No data found!</h5>";
        }
        ?>

    </div>

</div>

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
    
      function PrintDiv() {
          
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=1750,height=800');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
        
            } 

    $("a[id$='-fid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-fid", "");

        $.ajax({
            type: "POST",
            url: "ajax-edit.php",
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
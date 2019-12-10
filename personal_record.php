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
        <li><a href="personal_record.php" class="glyphicons user"><i></i>Personal Record</a></li>
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
                    $where[] = "personal_record." . $_POST['personal1'] . " LIKE '" . $_POST['personal'] . "%'";
                    break;
                default:
                    $where[] = "personal_record." . $_POST['personal1'] . " LIKE '%" . $_POST['personal'] . "%'";
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

    if (isset($_SESSION['userid']) && !empty($_SESSION['userid']) && $_SESSION['role'] != 1) {
        $where[] = "personal_record.created_by =" . $_SESSION['userid'];
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
    $baseURL = 'personal_record.php';
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
        <div class="buttons pull-right">
            <a href="add_personal_record.php" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i>Add</a>
        </div>
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
          
            <a><button class="btn btn-primary btn-icon glyphicons print" onclick="PrintDiv();" ><i></i>Print</button></a>
             <!--<input type="button" value="Print" class="btn btn-primary" onclick="PrintDiv();" />-->
            </div>
        <div id="divToPrint">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>Name of Doctor</th>
                        <th>Father/Husband Name</th>
                        <th>Domicile District</th>
                        <th>Designation/Post</th>
                        <th>Place of Posting</th>
                        <th>Picture</th>
                        <th class="right">Actions</th>
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
                            <td class="important"><?php echo $row['father_name']; ?></td>
                            <td class="important"><?php echo $row['district_dom_name']; ?></td>
                            <td class="important"><?php echo $row['designation']; ?></td>
                            <td class="important"><?php echo $row['place_of_posting']; ?></td>

                                                                                                                        <!--<td class="important"><?php echo $row['mbbs_bds_md']; ?></td>-->
                                                                                                                        <!--<td class="important"><?php echo $row['speciality']; ?></td>-->
                            <td class="important"><?php if (!empty($row['picture'])) { ?><a href="upload/<?php echo $row['picture']; ?>" target="_blank"><img src="upload/<?php echo $row['picture']; ?>" width="48" height="48"/></a> <?php }; ?></td>
                            <td class="center" style="width: 200px;">
                                <a href="#upload" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-pid" class="btn-action glyphicons upload" title="picture"><i></i></a>
                                <a onclick="return confirm('Are you sure you want to <?php echo ($row['status'] == 0 ? 'activate' : 'Inactivate'); ?>?');" href="status.php?id=<?php echo $row['pk_id']; ?>&status=<?php echo ($row['status'] == 1 ? '0' : '1'); ?>" class="btn-action glyphicons <?php echo ($row['status'] == 0 ? 'thumbs_down' : 'thumbs_up'); ?>" title="<?php echo ($row['status'] == 1 ? 'active' : 'Inactive'); ?>"><i></i></a>
                                <!--<a href="view_personal_record.php?id=<?php echo $row['pk_id']; ?>" class="btn-action glyphicons more" title="detail"><i></i></a>-->
                                <!--<a href="#edit" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-fid" class="btn-action glyphicons pen" title="edit"><i></i></a>-->
                                <a href="edit_personal_record.php?id=<?php echo $row['pk_id']; ?>" class="btn-action glyphicons more" title="view & edit" ><i></i></a>
                                <!--href="edit_all.php?id=<?php echo $row['pk_id']; ?>"-->
                                <!--<a onclick="return confirm('Are you sure you want to delete?');" href="delete.php?id=<?php echo $row['pk_id']; ?>" class="btn-action glyphicons bin" title="delete"><i></i></a>-->
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

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add.php">
    <div class="modal hide fade" id="add">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Add doctor</h3>
        </div>
        <div class="modal-body">
            <!-- Row -->
            <div class="row-fluid">

                <!-- Column -->
                <div class="span12">

                    <!-- Group -->
                    <div class="control-group">
                        <label class="control-label" for="name_of_doctor">Name of Doctor</label>
                        <div class="controls"><input class="span12" id="name_of_doctor" name="name_of_doctor" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="father_name">Father Name</label>
                        <div class="controls"><input class="span12" id="father_name" name="father_name" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="gender">Gender</label>
                        <div class="controls">
                            <select class="span12" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="cnic">CNIC (00000-0000000-0)</label>
                        <div class="controls"><input class="span12" id="cnic" name="cnic" type="text" onchange="if (!cnicIsValid(this.value))
                                    alert('Please enter valid CNIC i.e. 00000-0000000-0');
                                this.focus()" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="district_of_domicile">District of Domicile</label>
                        <div class="controls"><input class="span12" id="district_of_domicile" name="district_of_domicile" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="dob">Date of Birth (dd/mm/yyyy)</label>
                        <div class="controls"><input class="span12" id="dob" name="dob" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date_of_appointment">Date of Appointment (dd/mm/yyyy)</label>
                        <div class="controls"><input class="span12" id="date_of_appointment" name="date_of_appointment" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="contact_no">Contact No.</label>
                        <div class="controls"><input class="span12" id="contact_no" name="contact_no" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls"><input class="span12" id="email" name="email" type="text" onchange="if (!emailIsValid(this.value))
                                    alert('Please enter valid email');
                                this.focus()" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="postal_address">Postal Address</label>
                        <div class="controls"><input class="span12" id="postal_address" name="postal_address" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="pmdc_registration">PMDC Registration</label>
                        <div class="controls"><input class="span12" id="pmdc_registration" name="pmdc_registration" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="current_designation">Current Designation</label>
                        <div class="controls"><input class="span12" id="current_designation" name="current_designation" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="place_of_posting">Place of Posting</label>
                        <div class="controls"><input class="span12" id="place_of_posting" name="place_of_posting" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="bps">BPS</label>
                        <div class="controls"><input class="span12" id="bps" name="bps" type="text" onkeyup="this.value = minmax(this.value, 1, 22)" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mbbs_bds_md">MBBS/BDS/MD</label>
                        <div class="controls"><input class="span12" id="mbbs_bds_md" name="mbbs_bds_md" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ms">MS (Y/N)</label>
                        <div class="controls">
                            <select class="span12" id="ms" name="ms">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fcps_i">FCPS-I (YES/NO)</label>
                        <div class="controls">
                            <select class="span12" id="fcps_i" name="fcps_i">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fcps_ii">FCPS-II (YES/NO)</label>
                        <div class="controls">
                            <select class="span12" id="fcps_ii" name="fcps_ii">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mcps_dimploma">MCPS / DIPLOMA</label>
                        <div class="controls"><input class="span12" id="mcps_dimploma" name="mcps_dimploma" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="other">OTHER</label>
                        <div class="controls"><input class="span12" id="other" name="other" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="speciality">Speciality</label>
                        <div class="controls"><input class="span12" id="speciality" name="speciality" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="marital_status">Marital Status (Single / Married)</label>
                        <div class="controls">
                            <select class="span12" id="marital_status" name="marital_status">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="spouse_applicable">Spouse Applicable (Yes/No)</label>
                        <div class="controls">
                            <select class="span12" id="spouse_applicable" name="spouse_applicable">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="spouse_designation">Spouse Designation</label>
                        <div class="controls"><input class="span12" id="spouse_designation" name="spouse_designation" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="place_of_posting1">Place of Posting</label>
                        <div class="controls"><input class="span12" id="place_of_posting1" name="place_of_posting1" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="bps1">BPS</label>
                        <div class="controls"><input class="span12" id="bps1" name="bps1" type="text" onkeyup="this.value = minmax(this.value, 1, 22)" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="qualification">Qualification</label>
                        <div class="controls"><input class="span12" id="qualification" name="qualification" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="training_complete">Training Complete</label>
                        <div class="controls"><input class="span12" id="training_complete" name="training_complete" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="speciality1">Speciality</label>
                        <div class="controls"><input class="span12" id="speciality1" name="speciality1" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="others">Others</label>
                        <div class="controls"><input class="span12" id="others" name="others" type="text" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="received_from">Received From</label>
                        <div class="controls"><input class="span12" id="received_from" name="received_from" type="text" /></div>
                    </div>
                </div>
                <!-- // Column END -->



            </div>
            <!-- // Row END -->

            <!--<hr class="separator" />-->

            <!-- Row -->
            <!--                <div class="row-fluid uniformjs">
            
                                 Column 
                                <div class="span4">
                                    <h4 style="margin-bottom: 10px;">Policy &amp; Newsletter</h4>
                                    <label class="checkbox" for="agree">
                                        <input type="checkbox" class="checkbox" id="agree" name="agree" />
                                        Please agree to our policy
                                    </label>
                                    <label class="checkbox" for="newsletter">
                                        <input type="checkbox" class="checkbox" id="newsletter" name="newsletter" />
                                        Receive Newsletter
                                    </label>
                                </div>
                                 // Column END 
            
                                 Column 
                                <div class="span8">
                                    <div id="newsletter_topics">
                                        <h4>Topics</h4>
                                        <p>Select at least two topics you would like to receive in the newsletter.</p>
                                        <label for="topic_marketflash">
                                            <input type="checkbox" id="topic_marketflash" value="marketflash" name="topic" />
                                            Marketflash
                                        </label>
                                        <label for="topic_fuzz">
                                            <input type="checkbox" id="topic_fuzz" value="fuzz" name="topic" />
                                            Latest fuzz
                                        </label>
                                        <label for="topic_digester">
                                            <input type="checkbox" id="topic_digester" value="digester" name="topic" />
                                            Mailing list digester
                                        </label>
                                    </div>
                                </div>
                                 // Column END 
            
                            </div>-->
            <!-- // Row END -->



        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add.php">
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
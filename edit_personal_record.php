<?php
include 'template/header.php';
require_once 'classes/specialities.php';
require_once 'classes/personal_specility.php';
require_once 'classes/personal_training.php';
require_once 'classes/family.php';
require_once 'classes/education.php';
require_once 'classes/training.php';
require_once 'classes/personal.php';
require_once 'classes/childrens.php';
require_once 'classes/post.php';
require_once 'classes/posting.php';
require_once 'classes/locations.php';
require_once 'classes/university.php';
require_once 'classes/degree.php';
require_once 'classes/warehouse.php';
require_once 'classes/datetime.php';

if (empty($_GET['id'])) {
    echo "<script>window.location.href='personal_record.php'; </script>";
}

$personal_id = $_GET['id'];
$personal = new personal();
$result = $personal->find_by_id($personal_id);
$data = $result->fetch_assoc();

?>

<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="personal_record.php" class="glyphicons user"><i></i>Personal Record</a></li>
        <li class="divider"></li>
        <li>View & Edit</li>
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
    <!-- Heading -->
    <div class="heading-buttons">
        <h3><?php echo $data['name']; ?>'s Profile</h3>
        <div class="buttons pull-right">
            <a href="export.php?id=<?php echo $personal_id; ?>" class="btn btn-primary btn-icon glyphicons download"><i></i>Export to Excel</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">

        <!-- Widget -->
        <div class="widget personal row-fluid" data-toggle="collapse-widget">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">View and Update Personal Record</h3>

            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form method="post" id="addpersonalform" name="addpersonalform">
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="name">Name</label>
                                <div class="controls"><input class="span12" id="name" name="name" minlength="2" value="<?php echo $data['name']; ?>" type="text" required /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="father_name">Father/Husband Name</label>
                                <div class="controls"><input class="span12" minlength="2" id="father_name" name="father_name" value="<?php echo $data['father_name']; ?>" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="gender">Gender</label>
                                <div class="controls">
                                    <select class="span12" id="gender" name="gender">
                                        <option value="Male" <?php echo ($data['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?php echo ($data['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="cnic">CNIC (00000-0000000-0)</label>
                                <div class="controls"><input class="span12" id="cnic" name="cnic" type="text" value="<?php echo $data['cnic']; ?>" onchange="if (!cnicIsValid(this.value))
                                            alert('Please enter valid CNIC i.e. 00000-0000000-0');
                                        this.focus()" /></div>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="district_of_domicile">District of Domicile</label>
                                <div class="controls">
                                    <select class="span12" id="district_of_domicile" name="district_of_domicile">
                                        <option value="">Select</option>
                                        <?php
                                        $location = new locations();
                                        $result = $location->districtdropdown();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                        <option value="<?php echo $row['pk_id']; ?>" <?php if($data['district_of_domicile'] == $row['pk_id']) { ?>selected=""<?php }?>><?php echo $row['location_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="date_of_birth">Date of Birth (dd/mm/yyyy)</label>
                                <div class="controls"><input class="span12" id="date_of_birth" name="date_of_birth" type="text" value="<?php echo $dt->dateformat($data['date_of_birth']); ?>" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="contact_no">Contact No.</label>
                                <div class="controls"><input class="span12" id="contact_no"  name="contact_no" type="text"  value="<?php echo $data['contact_no']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls"><input class="span12" id="email" name="email" type="text" value="<?php echo $data['email']; ?>" onchange="if (!emailIsValid(this.value))
                                            alert('Please enter valid email');
                                        this.focus()" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="postal_address">Postal Address</label>
                                <div class="controls"><input class="span12" id="postal_address" name="postal_address" value="<?php echo $data['postal_address']; ?>" type="text" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="pmdc_registration">PMDC Registration</label>
                                <div class="controls"><input class="span12" id="pmdc_registration" name="pmdc_registration" type="text" value="<?php echo $data['pmdc_registration']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="marital_status">Marital Status (Single / Married)</label>
                                <div class="controls">
                                    <select class="span12" id="marital_status" name="marital_status">
                                        <option value="Single">Single</option>
                                        <option value="Married" <?php echo ($data['marital_status'] == 'Married' ? 'selected' : '') ?>>Married</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="health_professional">Health Professional</label>
                                <div class="controls">
                                    <select class="span12" id="health_professional" name="health_professional">
                                        <option value="Yes" <?php echo ($data['health_professional'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                                        <option value="No" <?php echo ($data['health_professional'] == 'No') ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                 
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="status_two">Status</label>
                                <div class="controls">
                                    <select class="span12" id="status_two" name="status_two">
                                        <option value="">Select</option>
                                        <option value="On job"  <?php echo ($data['status_two'] == 'On job') ? 'selected' : '' ?>>On Job</option>
                                        <option value="On deputation" <?php echo ($data['status_two'] == 'On deputation') ? 'selected' : '' ?>>On Deputation</option>
                                        <option value="On training" <?php echo ($data['status_two'] == 'On training') ? 'selected' : '' ?>>On Training</option>
                                        <option value="Suspended" <?php echo ($data['status_two'] == 'Suspended') ? 'selected' : '' ?>>Suspended</option>
                                        <option value="Retired" <?php echo ($data['status_two'] == 'Retired') ? 'selected' : '' ?>>Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="residential_address">Residential Address</label>
                                <div class="controls"><input class="span12" id="residential_address" name="residential_address" value="<?php echo $data['residential_address']; ?>" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="residential_city">Residential City</label>
                                <div class="controls">
                                    <select class="span12" id="residential_city" name="residential_city">
                                        <option value="">Select</option>
                                        <?php
                                        $location = new locations();
                                        $result = $location->districtdropdown();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['pk_id']; ?>" <?php if($data['residential_city'] == $row['pk_id']) { ?>selected=""<?php }?>><?php echo $row['location_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="control-group">
                                <label class="control-label" for="current_address">Current Address</label>
                                <div class="controls"><input class="span12" id="current_address" name="current_address" value="<?php echo $data['current_address']; ?>"  type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="current_city">Current City</label>
                                <div class="controls">
                                    <select class="span12" id="current_city" name="current_city">
                                        <option value="">Select</option>
                                        <?php
                                        $location = new locations();
                                        $result = $location->districtdropdown();
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['pk_id']; ?>" <?php if($data['current_city'] == $row['pk_id']) { ?>selected=""<?php }?>><?php echo $row['location_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12 right">
                            <div class="control-group">
                                <div class="controls"><button type="button" id="personalbutton" class="btn btn-primary">Update</button></div>
                            </div>
                        </div>
                        <input type="hidden" name="personalid" id="personalid" value="<?php echo $personal_id; ?>"/>
                    </div>
                </form>
            </div>
        </div>

        <div class="widget education row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Educational Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form id="educationform" name="educationform" method="post">
                    <div class="row-fluid">

                        <!-- Column -->
                        <div class="span4">

                            <!-- Group -->
                            <?php
                            $list = new university();
                            $result = $list->universitydropdown();

                            $rowCount = $result->num_rows;
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="university_id">University Name</label>
                                <select  class="span" name="university_id" id="university_id"  >
                                    <option value="">Select</option>

                                    <?php
                                    if ($rowCount > 0) {

                                        while ($row = $result->fetch_array()) {

                                            echo '<option value="' . $row['pk_id'] . '">' . $row['university_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">University not available</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="span4">

                            <!-- Group -->
                            <?php
                            $list = new degree();
                            $result = $list->degreedropdown();

                            $rowCount = $result->num_rows;
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="degree_id">Degree Title</label>
                                <select  class="span" name="degree_id" id="degree_id"  >
                                    <option value="">Select</option>

                                    <?php
                                    if ($rowCount > 0) {

                                        while ($row = $result->fetch_array()) {

                                            echo '<option value="' . $row['pk_id'] . '">' . $row['degree_title'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Degree not available</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="start_date">Start Date </label>
                                <div class="controls"><input class="span12" id="start_date" name="start_date" type="text" /></div>
                            </div>
                        </div>

                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="completion_date">Completion Date </label>
                                <div class="controls"><input class="span12" id="completion_date" name="completion_date" type="text"  /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="percentage"> Percentage</label>
                                <div class="controls"><input class="span12" id="percentage" name="percentage" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="total_marks">Total Marks</label>
                                <div class="controls"><input class="span12" id="total_marks" name="total_marks" type="text" /></div>
                            </div>
                        </div>

                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="cgpa">Cgpa</label>
                                <div class="controls"><input class="span12" id="cgpa" name="cgpa" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="hec_attestation_no">Hec Attestation No</label>
                                <div class="controls"><input class="span12" id="hec_attestation_no" name="hec_attestation_no" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="attestation_date">Attestation Date</label>
                                <div class="controls"><input class="span12" id="attestation_date" name="attestation_date" type="text" /></div>
                            </div>
                        </div>

                    </div>

                    <div class="row-fluid">
                        <div class="span12 right">

                            <div class="control-group">
                                <label class="control-label" for="educationbutton">&nbsp;</label>
                                <div class="controls right"><button type="button" id="educationbutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>
                    </div>

                    <!-- // Column END -->
                    <input type="hidden" id="personal_id" name="personal_id" value="<?php echo $personal_id; ?>"/>

                </form>
                
                <div class="row-fluid">
                    <div class="span12" id="education_data">
                        <?php
                        $education = new education();
                        $result = $education->find_by_personal($personal_id);
                        if ($result) {
                            ?>
                            <!-- Table -->

                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;" class="center">No.</th>
                                        <th>University Name</th>
                                        <th>Degree Title</th>
                                        <th>Start Date</th>
                                        <th>Completion Date</th>
                                        <th>Percentage</th>
                                        <th>CGPA</th>
                                        <th>Total Marks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table row -->
                                    <?php
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
                                            <td class="important"><?php echo $row['university_name']; ?></td>
                                            <td class="important"><?php echo $row['degree_title']; ?></td>
                                            <td class="important"><?php echo $row['start_date']; ?></td>
                                            <td class="important"><?php echo $row['completion_date']; ?></td>
                                            <td><?php echo $row['percentage']; ?></td>
                                            <td class="important"><?php echo $row['cgpa']; ?></td>
                                            <td class="important"><?php echo $row['total_marks']; ?></td>
                                            <td class="center" style="width: 200px;">
                                                <a id="<?php echo $row['pk_id']; ?>-deleducation" class="btn-action glyphicons bin" title="delete"><i></i></a>
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
            </div>
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Specialities Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">

                <form name="specilityform" id="specilityform" method="post">
                    <div class="row-fluid">

                        <div class="span8">

                            <!-- Group -->

                            <?php
                            $list = new speciality();
                            $result = $list->specilitydropdown();

                            $rowCount = $result->num_rows;
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="specility">Specility</label>
                                <select  class="span6" name="specility" id="specility"  >
                                    <option value="">Select</option>

                                    <?php
                                    if ($rowCount > 0) {

                                        while ($row = $result->fetch_array()) {

                                            echo '<option value="' . $row['pk_id'] . '">' . $row['specility'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Specility not available</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="specilitybutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="specilitybutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="pers_specility_id" name="pers_specility_id" value="<?php echo $personal_id; ?>"/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="specility_data">
                        <?php
                        //echo '>>>>>>';print_r($_POST);exit;
                        $personalspeciality = new personalspeciality();
                        $result = $personalspeciality->find_by_personal($personal_id);


                        if ($result) {
                            ?>
                            <!-- Table -->

                            <table class=" table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;" class="center">No.</th>
                                        <th>Speciality</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table row -->
                                    <?php
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
                                            <td><?php echo $row['specility']; ?></td>
                                            <td class="center" style="width: 200px;">
                                                <a id="<?php echo $row['pk_id']; ?>-delspeciality" class="btn-action glyphicons bin" title="delete"><i></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                    <!--  Table row END -->
                                    <!-- Table row -->

                                    <!--  Table row END -->
                                </tbody>
                            </table>
                            <!-- Table END -->
                            <?php
                        } else {
                            echo "<hr><h5> No records found!</h5>";
                        }
                        ?>

                    </div>
                </div>


            </div>
            <!-- // Column END -->



        </div>


        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Trainings Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <div class="row-fluid">
                    <form name="trainingform" id="trainingform" method="post">
                        <div class="span8">

                            <?php
                            $list = new training();
                            $result = $list->trainingdropdown();

                            $rowCount = $result->num_rows;
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="training">Training</label>
                                <select  class="span6" name="training" id="training"  >
                                    <option value="">Select</option>

                                    <?php
                                    if ($rowCount > 0) {

                                        while ($row = $result->fetch_array()) {

                                            echo '<option value="' . $row['pk_id'] . '">' . $row['title'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Trainings not available</option>';
                                    }
                                    ?>
                                </select>
                            </div> 
                        </div>

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="trainingbutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="trainingbutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>
                </div>

                <input type="hidden" id="pers_training_id" name="pers_training_id" value="<?php echo $personal_id; ?>"/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="training_data">
                        <?php
                        $personaltraining = new personaltraining();
                        $result = $personaltraining->find_by_personal($personal_id);



                        if ($result) {
                            ?>
                            <!-- Table -->

                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;" class="center">No.</th>
                                        <th>title</th>
                                        <!--<th>Training Date</th>-->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table row -->
                                    <?php
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
                                            <td><?php echo $row['title']; ?></td>
                                            <!--<td class="important"><?php echo $row['training_date']; ?></td>-->
                                            <td class="center" style="width: 200px;">
                                                <a id="<?php echo $row['pk_id']; ?>-deltraining" class="btn-action glyphicons bin" title="delete"><i></i></a>
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

            </div>
            <!-- // Column END -->



        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Family Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form name="spouseform" id="spouseform" method="post">
                    <?php
                    $family = new family();
                    $famil_res = $family->find_by_personal($personal_id);
                    if ($famil_res->num_rows > 0) {
                        $family_data = $famil_res->fetch_assoc();
                        $family_id = $family_data['pk_id'];
                    } else {
                        $family_data['health_professional'] = '';
                    }
                    ?>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="health_professional">Health Professional</label>
                                <div class="controls">
                                    <select class="span12" id="is_health_professional" name="is_health_professional">
                                        <option value="">Select</option>
                                        <option value="Yes" <?php if ($family_data['health_professional'] == 'Yes') { ?>selected="" <?php } ?>>Yes</option>
                                        <option value="No" <?php if ($family_data['health_professional'] == 'No') { ?>selected="" <?php } ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php
                        $list = new personal();
                        $result = $list->spousedropdown();

                        $rowCount = $result->num_rows;
                        ?>
                        <div class="span4">
                            <div class="control-group <?php if ($family_data['health_professional'] == 'No') { ?>hide<?php } ?>" id="divfamily_id">
                                <label class="control-label" for="health_professional">Select spouse from list</label>
                                <div class="controls">
                                    <select class="span12" name="family_id" id="family_id"  >
                                        <option value="">Select</option>

                                        <?php
                                        if ($rowCount > 0) {

                                            while ($row = $result->fetch_array()) {

                                                $sel = "";
                                                if ($family_data['spouse_id'] == $row['pk_id']) {
                                                    $sel = "selected=''";
                                                }

                                                echo '<option value="' . $row['pk_id'] . '" ' . $sel . '>' . $row['name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Spouse not available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="spousebutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="spousebutton" class="btn btn-primary">Update</button></div>
                            </div>
                        </div>

                    </div>
                    <!-- // Column END -->

                    <input type="hidden" id="familyid" name="familyid" value="<?php echo $family_id; ?>"/>
                    <input type="hidden" id="pers_spouse_id" name="pers_spouse_id" value="<?php echo $personal_id; ?>"/>
                </form>


            </div>
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Children's Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form name="childrenform" id="childrenform" method="post">

                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="name">Name</label>
                                <div class="controls"><input class="span12" id="name" name="name" value="" type="text" /></div>
                            </div>   
                        </div>  
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="date_of_birth">Date of Birth</label>
                                <div class="controls"><input class="span12" id="child_dob" name="child_dob" value="" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="school_name">School Name</label>
                                <div class="controls"><input class="span12" id="school_name" name="school_name" value=""   type="text" /></div>
                            </div>  
                        </div> 
                        <div class="span1 right">
                            <div class="control-group">
                                <label class="control-label" for="childrenbutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="childrenbutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>  
                    </div>

                    <input type="hidden" id="family_children_id" name="family_children_id" value=""/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="children_data">
                        <?php
                        $childrens = new childrens();
                        $result = $childrens->find_by_family($family_id);

                        if ($result->num_rows > 0) {
                            ?>
                            <!-- Table -->

                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;" class="center">No.</th>
                                        <th>Name</th>
                                        <th>Date of Birth</th>
                                        <th>School Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table row -->
                                    <?php
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
                                            <td><?php echo $row['name']; ?></td>
                                            <td class="important"><?php echo $row['date_of_birth']; ?></td>
                                            <td class="important"><?php echo $row['school_name']; ?></td>
                                            <td class="center" style="width: 200px;">
                                                <a id="<?php echo $row['pk_id']; ?>-delchildren" class="btn-action glyphicons bin" title="delete"><i></i></a>
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

            </div>
            <!-- // Column END -->
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="false">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Posting Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form name="postform" id="postform" method="post" enctype="multipart/form-data">
                    <div class="row-fluid">

                        <?php
                        $list = new post();
                        $result = $list->postdropdown();

                        $rowCount = $result->num_rows;
                        ?>
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="post">Post name</label>
                                <div class="controls">
                                    <select class="span12" name="post_id" id="post_id"  >
                                        <option value="">Select</option>

                                        <?php
                                        if ($rowCount > 0) {

                                            while ($row = $result->fetch_array()) {

                                                echo '<option value="' . $row['pk_id'] . '">' . $row['name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Post not available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                        $list = new warehouse();
                        $result = $list->postingplacedropdown();

                        $rowCount = $result->num_rows;
                        ?>
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="kpdistrict">Posting place</label>
                                <div class="controls">
                                    <select class="span12" name="post_place_id" id="post_place_id">
                                        <option value="">Select</option>

                                        <?php
                                        if ($rowCount > 0) {

                                            while ($row = $result->fetch_array()) {

                                                echo '<option value="' . $row['wh_id'] . '">' . $row['wh_name'] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">District not available</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="span3">
                         
                            <div class="control-group">
                                <label class="control-label" for="doa">Appointment Start Date</label>
                                <div class="controls"><input class="span12" type="text" id="doa" name="doa" /></div>
                            </div>
                               <label for="chkposting">
                                   <input type="checkbox" name="chkposting" id="chkposting" checked="true" />
                                I am currently working
                            </label>
                        </div>
                        <div class="span3">
                        <div id="dvposting" style="display: none">
                         
                            <div class="control-group">
                                <label class="control-label" for="ed">Appointment End Date</label>
                                <div class="controls"><input class="span12" type="text" id="ed" name="ed" /></div>
                            </div>
                        </div>
                       </div>
                        <div class="span2" >
                            <div class="control-group"  >
                                <label  class="control-label" for="apointment_letter">Appointment letter</label>
                                <div class="controls"><input type="file" id="apointment_letter" name="apointment_letter" /></div>
                            </div>
                        </div>
                        <div class="span1 right">
                            <div class="control-group">
                                <label class="control-label" for="postbutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="postbutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>
                    </div>    
                    <input type="hidden" id="pers_post_id" name="pers_post_id" value="<?php echo $personal_id; ?>"/>
                </form>
            </div>
        </div>
        <!-- // Column END -->
        <div class="row-fluid">
            <div class="span12" id="post_data">
                <?php
                $posting = new posting();
                $result = $posting->find_by_personal($personal_id);

                if ($result) {
                    ?>
                    <!-- Table -->

                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 1%;" class="center">No.</th>
                                <th>Name</th>
<!--                                <th>Designation </th>
                                <th>BPS</th>-->
                                <th>District</th>
                                <th>Appointment Start Date</th>
                                <th>Appointment End Date</th>
                                <th>Letter</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table row -->
                            <?php
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
                                    <td><?php echo $row['name']; ?></td>
<!--                                    <td class="important"><?php echo $row['designation']; ?></td>
                                    <td class="important"><?php echo $row['bps']; ?></td>-->
                                    <td class="important"><?php echo $row['wh_name']; ?></td>
                                    <td class="important"><?php echo $dt->dateformat($row['appointment_start_date']); ?></td>
                                            <?php
                                            $t = $row['appointment_end_date'];
                                            if ($t != '0000-00-00') {
                                                ?>
                                                <td class="important"><?php echo $dt->dateformat($row['appointment_end_date']); ?></td>

                                                <?php } else {
                                                ?>

                                                <td class="important"><?php echo 'Present' ?></td>
                                                <?php }
                                            ?>
                                    <td class="important"><a style="cursor: pointer" onclick="window.open('upload/<?php echo $row['file']; ?>', 'Appointment Letter', 'width:800,height=600')"><?php echo $row['file']; ?></a></td>
                                    <td class="center" style="width: 200px;">
                                        <a id="<?php echo $row['pk_id']; ?>-delposting" class="btn-action glyphicons bin" title="delete"><i></i></a>
                                     <?php if ($t == '0000-00-00') { ?>
                                                    <a href="#edit" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-zzid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                                <?php } ?>
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
        
 
        
    </div>
</div>

       <form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_posting.php">
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

<!--</div>
</div>
 // Widget END 
</div>
</div>
</div>-->


<!-- // Content END -->
<?php include 'template/footer.php'; ?>

<script>

    $("a[id$='-zzid']").click(function () {
        var value = $(this).attr("id");
         var pers = $("#pers_post_id").val();
        var id = value.replace("-zzid", "");

        $.ajax({
            type: "POST",
            url: "ajax-edit-posting-place-two.php",
            data: {
                id: id,
                  personal_id  : pers
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
//                $("#doa2,#ed2").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });
    
              $("#editpostbutton").click(function (e) {
             var form = $("#validateSubmitForm");

            var data = $('#validateSubmitForm').serialize();
            $.post('add_personal.php', data).done(function (arsalan) {
                $('.widget').find('.widget-body').collapse('toggle');
               
                $("#pers_post_id").val(arsalan);
                
                document.documentElement.scrollTop = 0;
            });
    });
    
    
      $(function () {
        $("#chkposting").click(function () {
            if ($(this).is(":checked")) {
                $("#dvposting").hide();
                $("#ed").val('00/00/0000');
            } else {
                $("#dvposting").show();
            }
        });
    });
    
    deletechildren();
    deleteeducation();
    deleteposting();
    deletespeciality();
    deletetraining();

    $("#personalbutton").click(function (e) {
        var form = $("#addpersonalform");
        form.validate({
            rules: {
                // simple rule, converted to {required:true}
                name: "required",
                // compound rule
                contact_no: {
                    required: true,
                    number: true
                }
             
            }
        });

        if (form.valid()) {

            var data = $('#addpersonalform').serialize();
            $.post('add_personal.php', data).done(function (arsalan) {
                document.documentElement.scrollTop = 0;
                alert("Data has been saved");
            });
        } else {
            e.preventDefault();
            alert("Please fill the form");
        }
    });

    $("#educationbutton").click(function () {
        var data = $('#educationform').serialize();
        $.post('add_education.php', data).done(function (data) {
            //$('#educationform').reset();
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');

            $("#education_data").html(data);
            //document.documentElement.scrollTop = 0;
            deleteeducation();

        });
    });

    function deleteeducation() {
        $("a[id$='-deleducation']").click(function () {
            var value = $(this).attr("id");
            var id = value.replace("-deleducation", "");
            $.ajax({
                type: "POST",
                url: "delete_education.php",
                data: {
                    id: id,
                    personal_id: $("#personal_id").val()
                },
                dataType: 'html',
                success: function (data) {
                    $("#education_data").html(data);
                    deleteeducation();
                }
            });
        });
    }

    $("#specilitybutton").click(function () {
        var data = $('#specilityform').serialize();
        $.post('add_specility.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#specility_data").html(data);
            //document.documentElement.scrollTop = 0;
            deletespeciality();
        });
    });

    function deletespeciality() {
        $("a[id$='-delspeciality']").click(function () {
            var value = $(this).attr("id");
            var id = value.replace("-delspeciality", "");
            $.ajax({
                type: "POST",
                url: "delete_specialty_pers.php",
                data: {
                    id: id,
                    pers_specility_id: $("#pers_specility_id").val()
                },
                dataType: 'html',
                success: function (data) {
                    $("#specility_data").html(data);
                    deletespeciality();
                }
            });
        });
    }

    $("#trainingbutton").click(function () {
        var data = $('#trainingform').serialize();
        $.post('add_training.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#training_data").html(data);
            //document.documentElement.scrollTop = 0;
            deletetraining();
        });
    });

    function deletetraining() {
        $("a[id$='-deltraining']").click(function () {
            var value = $(this).attr("id");
            var id = value.replace("-deltraining", "");
            $.ajax({
                type: "POST",
                url: "delete_training_pers.php",
                data: {
                    id: id,
                    pers_training_id: $("#pers_training_id").val()
                },
                dataType: 'html',
                success: function (data) {
                    $("#training_data").html(data);
                    deletetraining();
                }
            });
        });
    }

    $("#spousebutton").click(function () {
        var data = $('#spouseform').serialize();
        $.post('add_family.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            //$("#spouse_data").html(data);
            //document.documentElement.scrollTop = 0;
            $("#family_children_id").val(data);
            $("#spousebutton").html("Saved");
            $("#spousebutton").attr("disabled", true);
        });
    });

    $("#childrenbutton").click(function () {
        var family_id = $("#family_children_id").val();
        if (family_id == '') {
            alert("Please update Family record first");
        } else {
            var data = $('#childrenform').serialize();
            $.post('add_children.php', data).done(function (data) {
                //$('.widget.personal').find('.widget-body').collapse('toggle');
                //$('.widget.education').find('.widget-body').collapse('toggle');
                $("#children_data").html(data);
                //document.documentElement.scrollTop = 0;
                deletechildren();
            });
        }
    });

    function deletechildren() {
        $("a[id$='-delchildren']").click(function () {
            var value = $(this).attr("id");
            var id = value.replace("-delchildren", "");
            $.ajax({
                type: "POST",
                url: "delete_children.php",
                data: {
                    id: id,
                    family_children_id: $("#family_children_id").val()
                },
                dataType: 'html',
                success: function (data) {
                    $("#children_data").html(data);
                    deletechildren();
                }
            });
        });
    }

    $("#postbutton").click(function () {
        var form = document.getElementById('postform');
        $.ajax({
            type: "POST",
            url: "add_post.php",
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#post_data").html(data);
                deleteposting();
            }
        });
//        var data = $('#postform').serialize();
//        $.post('add_post.php', data).done(function (data) {
//            //$('.widget.personal').find('.widget-body').collapse('toggle');
//            //$('.widget.education').find('.widget-body').collapse('toggle');
//            $("#post_data").html(data);
//            //document.documentElement.scrollTop = 0;
//            deleteposting();
//        });
    });

    function deleteposting() {
        $("a[id$='-delposting']").click(function () {
            var value = $(this).attr("id");
            var id = value.replace("-delposting", "");
            $.ajax({
                type: "POST",
                url: "delete_post_pers.php",
                data: {
                    id: id,
                    pers_post_id: $("#pers_post_id").val()
                },
                dataType: 'html',
                success: function (data) {
                    $("#post_data").html(data);
                    deleteposting();
                }
            });
        });
    }


    $("#is_health_professional").change(function () {
        var value = $(this).val();
        if (value == 'Yes') {
            $("#divfamily_id").show();
            $.ajax({
                type: "POST",
                url: "get-spouse-list.php",
                data: {
                    gender: $("#gender").val()
                },
                dataType: 'html',
                success: function (data) {
                    $('#family_id').html(data);
                }
            });
        } else {
            $("#divfamily_id").hide();
        }
    });
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

    $("#dob,#date_of_appointment,#date_of_birth,#child_dob,#start_date,#completion_date,#attestation_date,#training_date,#doa,#ed").datepicker({dateFormat: 'dd/mm/yy'});

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
<?php

include 'template/header.php';
require_once 'classes/specialities.php';
require_once 'classes/training.php';
require_once 'classes/personal.php';
require_once 'classes/childrens.php';
require_once 'classes/post.php';
require_once 'classes/locations.php';
require_once 'classes/university.php';
require_once 'classes/degree.php';
require_once 'classes/warehouse.php';

?>

<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="personal_record.php" class="glyphicons user"><i></i>Personal Record</a></li>
        <li class="divider"></li>
        <li>Add New</li>
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
    <!--    <div class="heading-buttons">
            <h3>Human Resource - Khyber Pakhtunkhwa</h3>
            
            <div class="clearfix"></div>
        </div>-->
    <div class="separator bottom"></div>
    <!-- // Heading END -->

    <div class="innerLR">
        <!-- Widget -->
        <div class="widget personal row-fluid" data-toggle="collapse-widget">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Add Personal Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form method="post" id="addpersonalform" name="addpersonalform">
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="name">Name</label>
                                <div class="controls"><input class="span12" id="name" name="name" minlength="2" type="text" required /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="father_name">Father/Husband Name</label>
                                <div class="controls"><input class="span12" minlength="2" id="father_name" name="father_name" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="gender">Gender</label>
                                <div class="controls">
                                    <select class="span12" id="gender" name="gender">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="cnic">CNIC (00000-0000000-0)</label>
                                <div class="controls"><input class="span12" id="cnic" name="cnic" type="text" onchange="if (!cnicIsValid(this.value))
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
                                            <option value="<?php echo $row['pk_id']; ?>"><?php echo $row['location_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="date_of_birth">Date of Birth (dd/mm/yyyy)</label>
                                <div class="controls"><input class="span12" id="date_of_birth" name="date_of_birth" type="text" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="contact_no">Contact No.</label>
                                <div class="controls"><input class="span12" id="contact_no"  name="contact_no" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls"><input class="span12" id="email" name="email" type="text" onchange="if (!emailIsValid(this.value))
                                            alert('Please enter valid email');
                                        this.focus()" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="postal_address">Postal Address</label>
                                <div class="controls"><input class="span12" id="postal_address" name="postal_address" type="text" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="pmdc_registration">PMDC Registration</label>
                                <div class="controls"><input class="span12" id="pmdc_registration" name="pmdc_registration" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="marital_status">Marital Status (Single / Married)</label>
                                <div class="controls">
                                    <select class="span12" id="marital_status" name="marital_status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="health_professional">Health Professional</label>
                                <div class="controls">
                                    <select class="span12" id="health_professional" name="health_professional">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
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
                                        <option value="On job">On Job</option>
                                        <option value="On deputation">On Deputation</option>
                                        <option value="On training">On Training</option>
                                        <option value="Suspended">Suspended</option>
                                        <option value="Retired">Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="residential_address">Residential Address</label>
                                <div class="controls"><input class="span12" id="residential_address" name="residential_address" type="text" /></div>
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
                                            <option value="<?php echo $row['pk_id']; ?>"><?php echo $row['location_name']; ?></option>
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
                                <div class="controls"><input class="span12" id="current_address" name="current_address" type="text" /></div>
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
                                            <option value="<?php echo $row['pk_id']; ?>"><?php echo $row['location_name']; ?></option>
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
                                <div class="controls"><button type="button" id="personalbutton" class="btn btn-primary">Save & Next</button></div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="widget education row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

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
                                <label class="control-label" for="percentage">Percentage</label>
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
                    <input type="hidden" id="personal_id" name="personal_id" value=""/>

                </form>

                <div class="row-fluid">
                    <div class="span12" id="education_data">

                    </div>
                </div>
            </div>
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

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

                    <input type="hidden" id="pers_specility_id" name="pers_specility_id" value=""/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="specility_data">

                    </div>
                </div>


            </div>
            <!-- // Column END -->



        </div>


        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Trainings Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <div class="row-fluid">
                    <form name="trainingform" id="trainingform" method="post">
                        <div class="span4">

                            <?php
                            $list = new training();
                            $result = $list->trainingdropdown();

                            $rowCount = $result->num_rows;
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="training">Training</label>
                                <select  class="span" name="training" id="training"  >
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
<!--                       <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="training_date">Training Date</label>
                                <div class="controls"><input class="span" id="training_date" name="training_date" type="text" /></div>
                            </div>
                        </div>-->
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="trainingbutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="trainingbutton" class="btn btn-primary">Add</button></div>
                            </div>
                        </div>
                </div>

                <input type="hidden" id="pers_training_id" name="pers_training_id" value=""/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="training_data">

                    </div>
                </div>

            </div>
            <!-- // Column END -->



        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

            <!-- Widget heading -->
            <div class="widget-head">
                <h3 class="heading">Family Record</h3>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <form name="spouseform" id="spouseform" method="post">

                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="health_professional">Health Professional</label>
                                <div class="controls">
                                    <select class="span12" id="is_health_professional" name="is_health_professional">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
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
                            <div class="control-group hide" id="divfamily_id">
                                <label class="control-label" for="health_professional">Select spouse from list</label>
                                <div class="controls">
                                    <select class="span12" name="family_id" id="family_id"  >
                                        <option value="">Select</option>

                                        <?php
                                        if ($rowCount > 0) {

                                            while ($row = $result->fetch_array()) {

                                                echo '<option value="' . $row['pk_id'] . '">' . $row['name'] . '</option>';
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
                                <div class="controls"><button type="button" id="spousebutton" class="btn btn-primary">Save</button></div>
                            </div>
                        </div>

                    </div>
                    <!-- // Column END -->

                    <input type="hidden" id="pers_spouse_id" name="pers_spouse_id" value=""/>
                </form>
                <div class="row-fluid">
                    <div class="span12" id="spouse_data">

                    </div>
                </div>

            </div>
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

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
                                <div class="controls"><input class="span12" id="name" name="name" type="text" /></div>
                            </div>   
                        </div>  
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="date_of_birth">Date of Birth</label>
                                <div class="controls"><input class="span12" id="child_dob" name="child_dob" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="school_name">School Name</label>
                                <div class="controls"><input class="span12" id="school_name" name="school_name" type="text" /></div>
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

                    </div>
                </div>

            </div>
            <!-- // Column END -->
        </div>

        <div class="widget row-fluid" data-toggle="collapse-widget" data-collapse-closed="true">

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
                                    <select class="span12" name="post_place_id" id="post_place_id"  >
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
                        <div class="span2">
                            <div class="control-group">
                                <label class="control-label" for="apointment_letter">Appointment letter</label>
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
                    <input type="hidden" id="pers_post_id" name="pers_post_id" value=""/>
                </form>
            </div>
        </div>
        <!-- // Column END -->

        <div class="row-fluid">
            <div class="span12" id="post_data">

            </div>
        </div>
        
        
    </div>
</div>

<!--</div>
</div>
 // Widget END 
</div>
</div>
</div>-->

<!-- // Content END -->
<?php include 'template/footer.php'; ?>

<script>
    
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
                $('.widget').find('.widget-body').collapse('toggle');
                $("#personal_id").val(arsalan);
                $("#pers_specility_id").val(arsalan);
                $("#pers_training_id").val(arsalan);
//            $("#family_children_id").val(arsalan);
                $("#pers_post_id").val(arsalan);
                $("#pers_spouse_id").val(arsalan);

                document.documentElement.scrollTop = 0;
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
            processData:false,
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

    $("#dob,#date_of_appointment,#date_of_birth,#child_dob,#start_date,#completion_date,#attestation_date,#training_date, #doa, #ed").datepicker({dateFormat: 'dd/mm/yy'});

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
<?php 

include 'template/header.php';


//require_once 'classes/personal.php';
require_once 'classes/doctors.php';
require_once 'classes/education.php';
require_once 'classes/post.php';
require_once 'classes/family.php';
require_once 'classes/childrens.php';
require_once 'classes/specialities.php';
require_once 'classes/training.php';

require_once 'classes/datetime.php';

$doctors = new doctors();
$personal_id = $_REQUEST['id'];
$file = $doctors->find_by_id($personal_id);
$data = $file->fetch_array();

//print_r($data);
//exit;

//$education = new education();
//$education_id = $_REQUEST['id'];
//$file1 = $education->find_by_id($education_id);
//$data1 = $file1->fetch_array();
//
//$post = new post();
//$post_id = $_REQUEST['id'];
//$file2 = $post->find_by_id($post_id);
//$data2 = $file2->fetch_array();
//
//$family = new family();
//$family_id = $_REQUEST['id'];
//$file3 = $family->find_by_id($family_id);
//$data3 = $file3->fetch_array();
//
//$children = new childrens();
//$children_id = $_REQUEST['id'];
//$file4 = $children->find_by_id($children_id);
//$data4 = $file4->fetch_array();
//
//$speciality = new speciality();
//$speciality_id = $_REQUEST['id'];
//$file5 = $speciality->find_by_id($speciality_id);
//$data5 = $file5->fetch_array();

?>


<!-- Content -->
<div id="content">
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="personal_record.php" class="glyphicons user"><i></i>Personal Record</a></li>
        <li class="divider"></li>
        <li>Edit</li>
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
                                <label class="control-label" for="name_of_doctor">Name</label>
                                <div class="controls"><input class="span12" id="name_of_doctor" name="name_of_doctor" type="text" value="<?php echo $data['name_of_doctor']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="father_name">Father/Husband Name</label>
                                <div class="controls"><input class="span12" id="father_name" name="father_name" type="text" value="<?php echo $data['father_name']; ?>" /></div>
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
                                <div class="controls"><input class="span12" id="cnic" name="cnic" type="text"  value="<?php echo $data['cnic']; ?>" onchange="if (!cnicIsValid(this.value))
                                            alert('Please enter valid CNIC i.e. 00000-0000000-0');
                                        this.focus()" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="district_of_domicile">District of Domicile</label>
                                <div class="controls"><input class="span12" id="district_of_domicile" name="district_of_domicile" type="text"  value="<?php echo $data['district_of_domicile']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="dob">Date of Birth (dd/mm/yyyy)</label>
                                <div class="controls"><input class="span12" id="dob" name="dob" type="text" value="<?php echo $dt->dateformat($data['dob']); ?>" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="contact_no">Contact No.</label>
                                <div class="controls"><input class="span12" id="contact_no" name="contact_no" type="text" value="<?php echo $data['contact_no']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls"><input class="span12" id="email" name="email" type="text"  value="<?php echo $data['email']; ?>" onchange="if (!emailIsValid(this.value))
                                            alert('Please enter valid email');
                                        this.focus()" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="postal_address">Postal Address</label>
                                <div class="controls"><input class="span12" id="postal_address" name="postal_address" type="text"  value="<?php echo $data['postal_address']; ?>" /></div>
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
<!--                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="health_professional">Health Professional</label>
                                <div class="controls">
                                    <select class="span12" id="health_professional" name="health_professional">
                                        <option value="Yes" <?php echo ($data['health_professional'] == 'Yes') ? 'selected' : '' ?>>Yes</option>
                                        <option value="No" <?php echo ($data['health_professional'] == 'No') ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="control-group">
                                <label class="control-label" for="residential_address">Residential Address</label>
                                <div class="controls"><input class="span12" id="residential_address" name="residential_address" type="text" value="<?php echo $data['residential_address']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="residential_city">Residential City</label>
                                <div class="controls"><input class="span12" id="residential_city" name="residential_city" type="text" value="<?php echo $data['residential_city']; ?>" /></div>
                            </div>
                        </div>

                    </div>
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="control-group">
                                <label class="control-label" for="current_address">Current Address</label>
                                <div class="controls"><input class="span12" id="current_address" name="current_address" type="text"  value="<?php echo $data['current_address']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="current_city">Current City</label>
                                <div class="controls"><input class="span12" id="current_city" name="current_city" type="text"  value="<?php echo $data['current_city']; ?>" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12 right">
                            <div class="control-group">
                                <div class="controls"><button type="button" id="personalbutton" class="btn btn-primary">Save</button></div>
                            </div>
                        </div>

                    </div>
                     <input type="hidden" name="personalid" value="<?php echo $personal_id; ?>"/>
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
                            <div class="control-group">
                                <label class="control-label" for="degree_name">Degree Name</label>
                                <div class="controls"><input class="span12" id="degree_name" name="degree_name" type="text" value="<?php echo $data1['degree_name']; ?>" /></div>
                            </div>   
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="start_date">Start Date </label>
                                <div class="controls"><input class="span12" id="start_date" name="start_date" type="text" value="<?php echo $data1['start_date']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="completion_date">Completion Date </label>
                                <div class="controls"><input class="span12" id="completion_date" name="completion_date" type="text" value="<?php echo $data1['completion_date']; ?>" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="percentage"> Percentage</label>
                                <div class="controls"><input class="span12" id="percentage" name="percentage" type="text" value="<?php echo $data1['percentage']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="total_marks">Total Marks</label>
                                <div class="controls"><input class="span12" id="total_marks" name="total_marks" type="text" value="<?php echo $data1['total_marks']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="cgpa">Cgpa</label>
                                <div class="controls"><input class="span12" id="cgpa" name="cgpa" type="text" value="<?php echo $data1['cgpa']; ?>" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="hec_attestation_no">Hec Attestation No</label>
                                <div class="controls"><input class="span12" id="hec_attestation_no" name="hec_attestation_no" type="text" value="<?php echo $data1['hec_attestation_no']; ?>" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="attestation_date">Attestation Date</label>
                                <div class="controls"><input class="span12" id="attestation_date" name="attestation_date" type="text" /></div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" for="educationbutton">&nbsp;</label>
                                <div class="controls"><button type="button" id="educationbutton" class="btn btn-primary">Add</button></div>
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
                
                
                <div class="row-fluid">
                    <form name="specilityform" id="specilityform" method="post">
                    <div class="span8">

                        <!-- Group -->
                        
                        <div class="control-group">
                            <label class="control-label" for="specility">Specility</label>
                      <div class="controls"><input class="span12" id="specility" name="specility" type="text" value="<?php echo $data5['specility']; ?>" /></div>

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
                            <div class="controls"><input class="span12" id="name" name="name" type="text" value="<?php echo $data4['name']; ?>" /></div>
                        </div>   
                    </div>  
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label" for="date_of_birth">Date of Birth</label>
                            <div class="controls"><input class="span12" id="date_of_birth" name="date_of_birth" type="text" value="<?php echo $data4['date_of_birth']; ?>" /></div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label" for="school_name">School Name</label>
                            <div class="controls"><input class="span12" id="school_name" name="school_name" type="text" value="<?php echo $data4['school_name']; ?>" /></div>
                        </div>  
                    </div> 
                    <div class="span4" style=" float: right;">
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
                 <form name="postform" id="postform" method="post">
                <div class="row-fluid">
                
                        <?php
                        $list = new post();
                        $result = $list->postdropdown();

                        $rowCount = $result->num_rows;
                        ?>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label" for="post">Select post from list</label>
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
                        $list = new locations();
                        $result = $list->districtdropdown();

                        $rowCount = $result->num_rows;
                        ?>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label" for="kpdistrict">Select district from list</label>
                            <div class="controls">
                                <select class="span12" name="post_place_id" id="post_place_id"  >
                                    <option value="">Select</option>

                                    <?php
                                    if ($rowCount > 0) {

                                        while ($row = $result->fetch_array()) {

                                            echo '<option value="' . $row['pk_id'] . '">' . $row['location_name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">District not available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="control-group">
                            <label class="control-label" for="postbutton">&nbsp;</label>
                            <div class="controls"><button type="button" id="postbutton" class="btn btn-primary">Add</button></div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <!-- // Column END -->
        <input type="hidden" id="pers_post_id" name="pers_post_id" value=""/>
    </form>
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
    $("#personalbutton").click(function () {
        var data = $('#addpersonalform').serialize();
        $.post('add_personal.php', data).done(function (arsalan) {
            $('.widget').find('.widget-body').collapse('toggle');
            $("#personal_id").val(arsalan);
            $("#pers_specility_id").val(arsalan);
            $("#pers_training_id").val(arsalan);            
//            $("#family_children_id").val(arsalan);
            $("#pers_post_id").val(arsalan);
            
            document.documentElement.scrollTop = 0;
        });
    });

    $("#educationbutton").click(function () {
        var data = $('#educationform').serialize();
        $.post('add_education.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');

            $("#education_data").html(data);
            //document.documentElement.scrollTop = 0;
        });
    });
    
      $("#specilitybutton").click(function () {
        var data = $('#specilityform').serialize();
        $.post('add_specility.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#specility_data").html(data);
            //document.documentElement.scrollTop = 0;
        });
    });
    
          $("#trainingbutton").click(function () {
        var data = $('#trainingform').serialize();
        $.post('add_training.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#training_data").html(data);
            //document.documentElement.scrollTop = 0;
        });
    });
    
            $("#spousebutton").click(function () {
        var data = $('#spouseform').serialize();
        $.post('add_family.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            //$("#spouse_data").html(data);
            //document.documentElement.scrollTop = 0;
            $("#family_children_id").val(data);
        });
    });
    
          $("#childrenbutton").click(function () {
            var data = $('#childrenform').serialize();
            $.post('add_children.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#children_data").html(data);
            //document.documentElement.scrollTop = 0;
        });
    });
    
      $("#postbutton").click(function () {
        var data = $('#postform').serialize();
        $.post('add_post.php', data).done(function (data) {
            //$('.widget.personal').find('.widget-body').collapse('toggle');
            //$('.widget.education').find('.widget-body').collapse('toggle');
            $("#post_data").html(data);
            //document.documentElement.scrollTop = 0;
        });
    });


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

    $("#dob,#date_of_appointment,#date_of_birth,#start_date,#completion_date,#attestation_date,#training_date").datepicker({dateFormat: 'dd/mm/yy'});

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
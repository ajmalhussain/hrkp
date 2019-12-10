<?php
require_once 'classes/doctors.php';
require_once 'classes/datetime.php';
$doctors = new doctors();
$file_id = $_POST['id'];
$file = $doctors->find_by_id($file_id);
$data = $file->fetch_array();
?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="name_of_doctor">Name of Doctor</label>
            <div class="controls"><input class="span12" id="name_of_doctor" name="name_of_doctor" type="text" value="<?php echo $data['name_of_doctor']; ?>" /></div>
        </div>                        
        <div class="control-group">
            <label class="control-label" for="father_name">Father Name</label>
            <div class="controls"><input class="span12" id="father_name" name="father_name" type="text" value="<?php echo $data['father_name']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="gender">Gender</label>
            <div class="controls">
                <select class="span12" id="gender" name="gender">
                    <option value="Male" <?php echo ($data['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?php echo ($data['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="cnic">CNIC (00000-0000000-0)</label>
            <div class="controls"><input class="span12" id="cnic" name="cnic" type="text" value="<?php echo $data['cnic']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="district_of_domicile">District of Domicile</label>
            <div class="controls"><input class="span12" id="district_of_domicile" name="district_of_domicile" type="text" value="<?php echo $data['district_of_domicile']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="dob">Date of Birth (dd/mm/yyyy)</label>
            <div class="controls"><input class="span12" id="dob" name="dob" type="text" value="<?php echo $dt->dateformat($data['dob']); ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="date_of_appointment">Date of Appointment (dd/mm/yyyy)</label>
            <div class="controls"><input class="span12" id="date_of_appointment" name="date_of_appointment" type="text" value="<?php echo $dt->dateformat($data['date_of_appointment']); ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="contact_no">Contact No.</label>
            <div class="controls"><input class="span12" id="contact_no" name="contact_no" type="text" value="<?php echo $data['contact_no']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls"><input class="span12" id="email" name="email" type="text" value="<?php echo $data['email']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="postal_address">Postal Address</label>
            <div class="controls"><input class="span12" id="postal_address" name="postal_address" type="text" value="<?php echo $data['postal_address']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="pmdc_registration">PMDC Registration</label>
            <div class="controls"><input class="span12" id="pmdc_registration" name="pmdc_registration" type="text" value="<?php echo $data['pmdc_registration']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="current_designation">Current Designation</label>
            <div class="controls"><input class="span12" id="current_designation" name="current_designation" type="text" value="<?php echo $data['current_designation']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="place_of_posting">Place of Posting</label>
            <div class="controls"><input class="span12" id="place_of_posting" name="place_of_posting" type="text" value="<?php echo $data['place_of_posting']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bps">BPS</label>
            <div class="controls"><input class="span12" id="bps" name="bps" type="text" value="<?php echo $data['bps']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mbbs_bds_md">MBBS/BDS/MD</label>
            <div class="controls"><input class="span12" id="mbbs_bds_md" name="mbbs_bds_md" type="text" value="<?php echo $data['mbbs_bds_md']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ms">MS (Y/N)</label>
            <div class="controls">
                <select class="span12" id="ms" name="ms">
                    <option value="Yes">Yes</option>
                    <option value="No" <?php echo ($data['ms'] == 'No' ? 'selected' : '') ?>>No</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fcps_i">FCPS-I (YES/NO)</label>
            <div class="controls">
                <select class="span12" id="fcps_i" name="fcps_i">
                    <option value="Yes">Yes</option>
                    <option value="No" <?php echo ($data['fcps_i'] == 'No' ? 'selected' : '') ?>>No</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fcps_ii">FCPS-II (YES/NO)</label>
            <div class="controls">
                <select class="span12" id="fcps_ii" name="fcps_ii">
                    <option value="Yes">Yes</option>
                    <option value="No" <?php echo ($data['fcps_ii'] == 'No' ? 'selected' : '') ?>>No</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mcps_dimploma">MCPS / DIPLOMA</label>
            <div class="controls"><input class="span12" id="mcps_dimploma" name="mcps_dimploma" type="text" value="<?php echo $data['mcps_dimploma']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="other">OTHER</label>
            <div class="controls"><input class="span12" id="other" name="other" type="text" value="<?php echo $data['other']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="speciality">Speciality</label>
            <div class="controls"><input class="span12" id="speciality" name="speciality" type="text" value="<?php echo $data['speciality']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="marital_status">Marital Status (Single / Married)</label>
            <div class="controls">
                <select class="span12" id="marital_status" name="marital_status">
                    <option value="Single">Single</option>
                    <option value="Married" <?php echo ($data['marital_status'] == 'Married' ? 'selected' : '') ?>>Married</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="spouse_applicable">Spouse Applicable (Yes/No)</label>
            <div class="controls"><input class="span12" id="spouse_applicable" name="spouse_applicable" type="text" value="<?php echo $data['spouse_applicable']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="spouse_designation">Spouse Designation</label>
            <div class="controls"><input class="span12" id="spouse_designation" name="spouse_designation" type="text" value="<?php echo $data['spouse_designation']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="place_of_posting1">Place of Posting</label>
            <div class="controls"><input class="span12" id="place_of_posting1" name="place_of_posting1" type="text" value="<?php echo $data['place_of_posting1']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="bps1">BPS</label>
            <div class="controls"><input class="span12" id="bps1" name="bps1" type="text" value="<?php echo $data['bps1']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="qualification">Qualification</label>
            <div class="controls"><input class="span12" id="qualification" name="qualification" type="text" value="<?php echo $data['qualification']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="training_complete">Training Complete</label>
            <div class="controls"><input class="span12" id="training_complete" name="training_complete" type="text" value="<?php echo $data['training_complete']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="speciality1">Speciality</label>
            <div class="controls"><input class="span12" id="speciality1" name="speciality1" type="text" value="<?php echo $data['speciality1']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="others">Others</label>
            <div class="controls"><input class="span12" id="others" name="others" type="text" value="<?php echo $data['others']; ?>" /></div>
        </div>
        <div class="control-group">
            <label class="control-label" for="received_from">Received From</label>
            <div class="controls"><input class="span12" id="received_from" name="received_from" type="text" value="<?php echo $data['received_from']; ?>" /></div>
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
<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
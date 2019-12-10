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
        <table class="table table-pricing table-pricing-2 table-bordered">
            <tbody>
                <tr>
                    <td class="shortRight">Name of Doctor</td>
                    <td><?php echo $data['name_of_doctor']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Father Name</td>
                    <td><?php echo $data['father_name']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Gender</td>
                    <td><?php echo $data['gender']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">CNIC (00000-0000000-0)</td>
                    <td><?php echo $data['cnic']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">District of Domicile</td>
                    <td><?php echo $data['district_of_domicile']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Date of Birth (dd/mm/yyyy)</td>
                    <td><?php echo $dt->dateformat($data['dob']); ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Date of Appointment (dd/mm/yyyy)</td>
                    <td><?php echo $dt->dateformat($data['date_of_appointment']); ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Contact No.</td>
                    <td><?php echo $data['contact_no']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Email</td>
                    <td><?php echo $data['email']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Postal Address</td>
                    <td><?php echo $data['postal_address']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">PMDC Registration</td>
                    <td><?php echo $data['pmdc_registration']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Current Designation</td>
                    <td><?php echo $data['current_designation']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Place of Posting</td>
                    <td><?php echo $data['place_of_posting']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">BPS</td>
                    <td><?php echo $data['bps']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">MBBS/BDS/MD</td>
                    <td><?php echo $data['mbbs_bds_md']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">MS (Y/N)</td>
                    <td><?php echo $data['ms']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">FCPS-I (YES/NO)</td>
                    <td><?php echo $data['fcps_i']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">FCPS-II (YES/NO)</td>
                    <td><?php echo $data['fcps_ii']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">MCPS / DIPLOMA</td>
                    <td><?php echo $data['mcps_dimploma']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">OTHER</td>
                    <td><?php echo $data['other']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Speciality</td>
                    <td><?php echo $data['speciality']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Marital Status (Single / Married)</td>
                    <td><?php echo $data['marital_status']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Spouse Applicable (Yes/No)</td>
                    <td><?php echo $data['spouse_applicable']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Spouse Designation</td>
                    <td><?php echo $data['spouse_designation']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Place of Posting</td>
                    <td><?php echo $data['place_of_posting1']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">BPS</td>
                    <td><?php echo $data['bps1']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Qualification</td>
                    <td><?php echo $data['qualification']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Training Complete</td>
                    <td><?php echo $data['training_complete']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Speciality</td>
                    <td><?php echo $data['speciality1']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Others</td>
                    <td><?php echo $data['others']; ?></td>
                </tr>
                <tr>
                    <td class="shortRight">Received From</td>
                    <td><?php echo $data['received_from']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- // Column END -->



</div>
<!-- // Row END -->

<!--<hr class="separator-->

<!-- Row -->
<!--                <div class="row-fluid uniformjs">

                     Column 
                    <div class="span4">
                        <h4 style="margin-bottom: 10px;">Policy &amp; Newsletter</h4>
                        <label class="checkbox" for="agree">
                            <input readonly type="checkbox" class="checkbox" id="agree" name="agree
                            Please agree to our policy
                        </label>
                        <label class="checkbox" for="newsletter">
                            <input readonly type="checkbox" class="checkbox" id="newsletter" name="newsletter
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
                                <input readonly type="checkbox" id="topic_marketflash" value="marketflash" name="topic
                                Marketflash
                            </label>
                            <label for="topic_fuzz">
                                <input readonly type="checkbox" id="topic_fuzz" value="fuzz" name="topic
                                Latest fuzz
                            </label>
                            <label for="topic_digester">
                                <input readonly type="checkbox" id="topic_digester" value="digester" name="topic
                                Mailing list digester
                            </label>
                        </div>
                    </div>
                     // Column END 

                </div>-->
<!-- // Row END -->
<?php include 'template/header.php'; ?>
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
        <h3>Children Record</h3>
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
        require_once 'classes/childrens.php';
        require_once 'classes/datetime.php';

        $doc = new childrens();

        $result = $doc->find_all();
        if ($result) {
            ?>
            <!-- Table -->

            <table class="dynamicTable table table-striped table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="width: 1%;" class="center">No.</th>
                        <th>Name of Doctor</th>
                        <th>Father/Husband Name</th>
                        <th>Designation</th>
                        <th>Place of Posting</th>
                        <th>BPS</th>
                        <th>Qualification</th>
                        <th>Speciality</th>
                        <th>Picture</th>
                        <th class="right">Actions</th>
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
                            <td><?php echo $row['name_of_doctor']; ?></td>
                            <td class="important"><?php echo $row['father_name']; ?></td>
                            <td class="important"><?php echo $row['current_designation']; ?></td>
                            <td class="important"><?php echo $row['place_of_posting']; ?></td>
                            <td class="important"><?php echo $row['bps']; ?></td>
                            <td class="important"><?php echo $row['mbbs_bds_md']; ?></td>
                            <td class="important"><?php echo $row['speciality']; ?></td>
                            <td class="important"><?php if(!empty($row['picture'])) { ?><a href="upload/<?php echo $row['picture']; ?>" target="_blank"><img src="upload/<?php echo $row['picture']; ?>" width="48" height="48"/></a> <?php }; ?></td>
                            <td class="center" style="width: 200px;">
                                <a href="#upload" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-pid" class="btn-action glyphicons upload" title="picture"><i></i></a>
                                <a onclick="return confirm('Are you sure you want to <?php echo ($row['status'] == 0 ? 'activate' : 'Inactivate'); ?>?');" href="status.php?id=<?php echo $row['pk_id']; ?>&status=<?php echo ($row['status'] == 1 ? '0' : '1'); ?>" class="btn-action glyphicons <?php echo ($row['status'] == 0 ? 'thumbs_down' : 'thumbs_up'); ?>" title="<?php echo ($row['status'] == 1 ? 'active' : 'Inactive'); ?>"><i></i></a>
                                <a href="#detail" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-did" class="btn-action glyphicons more" title="detail"><i></i></a>
                                <a href="#edit" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-fid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                <a onclick="return confirm('Are you sure you want to delete?');" href="delete.php?id=<?php echo $row['pk_id']; ?>" class="btn-action glyphicons bin" title="delete"><i></i></a>
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
            echo "<hr><h5>Good news! No active file on your desk!</h5>";
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
                        <div class="controls"><input class="span12" id="cnic" name="cnic" type="text" onchange="if(!cnicIsValid(this.value)) alert('Please enter valid CNIC i.e. 00000-0000000-0'); this.focus()" /></div>
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
                        <div class="controls"><input class="span12" id="email" name="email" type="text" onchange="if(!emailIsValid(this.value)) alert('Please enter valid email'); this.focus()" /></div>
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
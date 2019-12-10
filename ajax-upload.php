<?php
require_once 'classes/personal.php';
require_once 'classes/datetime.php';
$doctors = new personal();
$file_id = $_POST['id'];
$file = $doctors->find_by_id($file_id);
$data = $file->fetch_array();
?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <h3>Select your image</h3>
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-append">
                <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="picture" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
        </div>                     

    </div>
    <!-- // Column END -->



</div>
<!-- // Row END -->

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
<?php
require_once 'classes/specialities.php';
require_once 'classes/datetime.php';

$speciality = new speciality();
$file_id = $_POST['id'];
$file = $speciality->find_by_id($file_id);
$data = $file->fetch_array();

?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="specility">speciality</label>
            <div class="controls"><input class="span12" id="specility" name="specility" type="text" value="<?php echo $data['specility']; ?>" /></div>
        </div>                        
      
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
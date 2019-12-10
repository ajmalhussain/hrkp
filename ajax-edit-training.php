<?php
require_once 'classes/training.php';
require_once 'classes/datetime.php';

$training = new training();
$file_id = $_POST['id'];
$file = $training->find_by_id($file_id);
$data = $file->fetch_array();
?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="title">Title</label>
            <div class="controls"><input class="span12" id="title" name="title" type="text" value="<?php echo $data['title']; ?>" /></div>
        </div>                        
         <div class="control-group">
            <label class="control-label" for="training_date">Training Date</label>
            <div class="controls"><input class="span12" id="training_date" name="training_date" type="text" value="<?php echo $data['training_date']; ?>" /></div>
        </div>  
         
    </div>
    <!-- // Column END -->



</div>
<!-- // Row END -->

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
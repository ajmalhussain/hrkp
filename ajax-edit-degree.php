<?php

require_once 'classes/degree.php';
require_once 'classes/datetime.php';

$degree = new degree();
$degree_id = $_POST['id'];
$file = $degree->find_by_id($degree_id);
$data = $file->fetch_array();

?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                      
        <div class="control-group">
            <label class="control-label" for="degree_title">Degree Title</label>
            <div class="controls"><input class="span12" id="degree_title" name="degree_title" type="text" value="<?php echo $data['degree_title']; ?>" /></div>
        </div>                        
        <div class="control-group">
            <label class="control-label" for="duration">Duration</label>
            <div class="controls"><input class="span12" id="duration" name="duration" type="text" value="<?php echo $data['duration']; ?>" /></div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="degree_recognised_by">Degree Recognised  By</label>
            <div class="controls"><input class="span12" id="degree_recognised_by" name="degree_recognised_by" type="text" value="<?php echo $data['degree_recognised_by']; ?>" /></div>
        </div>  
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="degreeid" value="<?php echo $degree_id; ?>"/>
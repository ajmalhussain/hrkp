<?php
require_once 'classes/post.php';
require_once 'classes/datetime.php';

$post = new post();
$file_id = $_POST['id'];
$file = $post->find_by_id($file_id);
$data = $file->fetch_array();
?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls"><input class="span12" id="name" name="name" type="text" value="<?php echo $data['name']; ?>" /></div>
        </div>                        
         <div class="control-group">
            <label class="control-label" for="designation">Designation</label>
            <div class="controls"><input class="span12" id="designation" name="designation" type="text" value="<?php echo $data['designation']; ?>" /></div>
        </div>  
          <div class="control-group">
            <label class="control-label" for="bps">Bps</label>
            <div class="controls"><input class="span12" id="bps" name="bps" type="text" value="<?php echo $data['bps']; ?>" /></div>
        </div>  
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
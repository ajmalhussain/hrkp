
<?php $result = $result[0]; ?>

<!-- Row -->
<div class="row-fluid">
    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="title">Title</label>
            <div class="controls"><input class="span12" id="title" name="title" type="text" value="<?php echo $result['title']; ?>" /></div>
        </div>                        
         <div class="control-group">
            <label class="control-label" for="training_date">Training Date</label>
            <div class="controls"><input class="span12" id="training_date" name="training_date" type="text" value="<?php echo $result['training_date']; ?>" /></div>
        </div>  
    </div>
    <!-- // Column END -->



</div>
<!-- // Row END -->

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
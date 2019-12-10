
<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                      
        <div class="control-group">
            <label class="control-label" for="degree_title">Degree Title</label>
            <div class="controls"><input class="span12" id="degree_title" name="degree_title" type="text" value="<?php echo $result['degree_title']; ?>" /></div>
        </div>                        
        <div class="control-group">
            <label class="control-label" for="duration">Duration</label>
            <div class="controls"><input class="span12" id="duration" name="duration" type="text" value="<?php echo $result['duration']; ?>" /></div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="degree_recognised_by">Degree Recognised  By</label>
            <div class="controls"><input class="span12" id="degree_recognised_by" name="degree_recognised_by" type="text" value="<?php echo $result['degree_recognised_by']; ?>" /></div>
        </div>  
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="degreeid" value="<?php echo $degree_id; ?>"/>
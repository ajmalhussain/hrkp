
<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">
    <!-- Column -->
    <div class="span12">

        <!-- Group -->                     
        <div class="control-group">
            <label class="control-label" for="university_name">University Name</label>
            <div class="controls"><input class="span12" id="university_name" name="university_name" type="text" value="<?php echo $result['university_name']; ?>" /></div>
        </div>                        
        <div class="control-group">
            <label class="control-label" for="city">city</label>
            <div class="controls"><input class="span12" id="city" name="city" type="text" value="<?php echo $result['city']; ?>" /></div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="country">country</label>
            <div class="controls"><input class="span12" id="country" name="country" type="text" value="<?php echo $result['country']; ?>" /></div>
        </div>  
    </div>
    <!-- // Column END -->s



</div>

<input type="hidden" name="uniid" value="<?php echo $uni_id; ?>"/>
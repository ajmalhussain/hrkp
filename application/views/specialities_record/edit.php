
<?php $result = $result[0]; ?>

<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
        <div class="control-group">
            <label class="control-label" for="specility">speciality</label>
            <div class="controls"><input class="span12" id="specility" name="specility" type="text" value="<?php echo $result['specility']; ?>" /></div>
        </div>                        
      
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="fileid" value="<?php echo $file_id; ?>"/>
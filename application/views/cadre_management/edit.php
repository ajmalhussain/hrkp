
<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->                     
        <div class="control-group">
            <label class="control-label" for="cadre_value">Cadre Value</label>
            <div class="controls"><input class="span12" id="cadre_value" name="cadre_value" type="text" value="<?php echo $result['cadre_value']; ?>" /></div>
        </div>                         
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="cadreid" value="<?php echo $cadre_id; ?>"/>

<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">
        <!-- Group -->                     
        <div class="control-group">
            <label class="control-label" for="category_value">Category</label>
            <div class="controls"><input class="span12" id="category_value" name="category_value" type="text" value="<?php echo $result['category_value']; ?>" /></div>
        </div>                         
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="categoryid" value="<?php echo $category_id; ?>"/>
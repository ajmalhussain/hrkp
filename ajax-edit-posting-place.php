<?php

require_once 'classes/posting_place.php';
require_once 'classes/datetime.php';
require_once 'classes/locations.php';

$posting_place = new posting_place();
$posting_place_id = $_POST['id'];
$file = $posting_place->find_by_id($posting_place_id);
$data = $file->fetch_array();

?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                                      
        <div class="control-group">
            <label class="control-label" for="wh_name">Posting Place Name</label>
            <div class="controls"><input class="span12" id="wh_name" name="wh_name" value="<?php echo $data['wh_name']; ?>" type="text" /></div>
        </div>           
        <div class="control-group">
            <label class="control-label" for="district_of_domicile1" id="district_of_domicile1">District Name</label>
            <div class="controls">
                <select class="span12" id="district_of_domicile" name="district_of_domicile">
                    <option value="">Select</option>
                    <?php
                    $location = new locations();
                    $file = $location->districtdropdown2();
                    while ($row = $file->fetch_array()) {
                        ?>
                        <option value="<?php echo $row['PkLocID']; ?>" <?php if ($data['dist_id'] == $row['PkLocID']) { ?>selected=""<?php } ?>><?php echo $row['LocName']; ?></option>
                        <?php
                    }
                    ?>
                </select></div>
        </div>
 
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="postingplaceid" value="<?php echo $posting_place_id; ?>"/>

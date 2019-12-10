<?php $result = $result[0]; ?>


<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                                      
                    <div class="control-group">
                        <label class="control-label" for="LocName">District Name</label>
                        <div class="controls"><input class="span12" id="LocName" name="LocName" value="<?php echo $result['LocName']; ?>" type="text" /></div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label" for="lvl">Level</label>
                        <div class="controls">
                            <select name="lvl" id="lvl" class="span12">
                                <option value="National" <?php if($result['lvl']=='National') { ?>selected=""<?php } ?>>National</option>
                                <option value="">Select</option>
                                <option value="District" <?php if($result['LocLvl']=='District') { ?>selected=""<?php } ?>>District</option>
                                <option value="Posting Place" <?php if($result['LocLvl']=='Posting Place') { ?>selected=""<?php } ?>>Posting Place</option>
                                <option value="Received From" <?php if($result['LocLvl']=='Received From') { ?>selected=""<?php } ?>>Received From</option>
                            </select>
                            </div>
                    </div>
       <div class="control-group">
            <label class="control-label" for="district_of_domicile1" id="district_of_domicile1">District</label>
            <div class="controls">
                <select class="span12" id="district_of_domicile" name="district_of_domicile">
                    <option value="">Select</option>
                    <?php
                    $dataloc = $location->result_array();
                    foreach ( $dataloc as $row) {
                        ?>
                        <option value="<?php echo $row['PkLocID']; ?>" <?php if ($result['ParentID'] == $row['PkLocID']) { ?>selected=""<?php } ?>><?php echo $row['LocName']; ?></option>
                        <?php
                    }
                    ?>
                </select></div>
        </div>
                 
        
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="districtid" value="<?php echo $district_id; ?>"/>
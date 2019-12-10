<?php
require_once 'classes/district.php';
require_once 'classes/datetime.php';
require_once 'classes/locations.php';

$district = new district();
$district_id = $_POST['id'];
$file = $district->find_by_id($district_id);
$data = $file->fetch_array();

?>
<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                                      
                    <div class="control-group">
                        <label class="control-label" for="LocName">District Name</label>
                        <div class="controls"><input class="span12" id="LocName" name="LocName" value="<?php echo $data['LocName']; ?>" type="text" /></div>
                    </div>                        
<!--                    <div class="control-group">
                        <label class="control-label" for="lvl">Level</label>
                        <div class="controls">
                            <select name="lvl" id="lvl" class="span12">
                                <option value="National" <?php if($data['lvl']=='National') { ?>selected=""<?php } ?>>National</option>
                                <option value="">Select</option>
                                <option value="District" <?php if($data['LocLvl']=='District') { ?>selected=""<?php } ?>>District</option>
                                <option value="Posting Place" <?php if($data['LocLvl']=='Posting Place') { ?>selected=""<?php } ?>>Posting Place</option>
                                <option value="Received From" <?php if($data['LocLvl']=='Received From') { ?>selected=""<?php } ?>>Received From</option>
                            </select>
                            </div>
                    </div>-->
<!--        <div class="control-group">
            <label class="control-label" for="district_of_domicile1" id="district_of_domicile1">District</label>
            <div class="controls">
                <select class="span12" id="district_of_domicile" name="district_of_domicile">
                    <option value="">Select</option>
                    <?php
                    $location = new locations();
                    $file = $location->districtdropdown2();
                    while ($row = $file->fetch_array()) {
                        ?>
                        <option value="<?php echo $row['PkLocID']; ?>" <?php if ($data['ParentID'] == $row['PkLocID']) { ?>selected=""<?php } ?>><?php echo $row['LocName']; ?></option>
                        <?php
                    }
                    ?>
                </select></div>
        </div>-->
                 
        
    </div>
    <!-- // Column END -->



</div>

<input type="hidden" name="districtid" value="<?php echo $district_id; ?>"/>

<script>
    
    $(document).ready(function(){
    
    $('#lvl').on('change',function(){
           var val = $(this).val();
           console.log('V:'+val);                                
            $.ajax({
                success:function(html){          
                     if(val == 'District')
                    {
                   
                    $('#district_of_domicile').hide();
                    $('#district_of_domicile1').hide();
                   
                    }
                    else
                    {
                   $('#district_of_domicile').show();
                   $('#district_of_domicile1').show();
          
                    }
                    }
                
            }); 
    });
      });
    
    </script>
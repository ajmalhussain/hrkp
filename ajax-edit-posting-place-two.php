<?php

require_once 'classes/posting.php';
require_once 'classes/datetime.php';
require_once 'classes/locations.php';
require_once 'classes/post.php';
require_once 'classes/warehouse.php';

$postingone = new posting();
$posting_place_id = $_POST['id'];
$file = $postingone->find_by_id($posting_place_id);
$data = $file->fetch_array();

?>

<!-- Row -->
<div class="row-fluid">

    <!-- Column -->
    <div class="span12">

        <!-- Group -->
                                      
        <?php
        $list = new post();
        $result = $list->postdropdown();

        $rowCount = $result->num_rows;
        ?>
       
            <div class="control-group">
                <label class="control-label" for="post">Post name</label>
                <div class="controls">
                    <select class="span12" name="post_id" id="post_id"  >
                        <option value="">Select</option>

                        <?php
                        if ($rowCount > 0) {

                            while ($row = $result->fetch_array()) {
?>
                               <option  value="<?php echo $row['pk_id']; ?>" <?php if($data['post_id'] == $row['pk_id']) { ?>selected="" <?php }?>><?php echo $row['name']; ?></option>
                               <?php
                            }
                        } else {?>
                            <option value="">Post not available</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
    
        <?php
        $list = new warehouse();
        $result = $list->postingplacedropdown();

        $rowCount = $result->num_rows;
        ?>
       
        <div class="control-group">
            <label class="control-label" for="kpdistrict">Posting place</label>
            <div class="controls">
                <select class="span12" name="post_place_id" id="post_place_id"  >
                    <option value="">Select</option>

                    <?php
                    if ($rowCount > 0) {

                        while ($row = $result->fetch_array()) {
                            ?>
                            <option value="<?php echo $row['wh_id']; ?>" <?php if ($data['post_place_id'] == $row['wh_id']) { ?>selected=""<?php } ?>><?php echo $row['wh_name']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option value="">District not available</option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
    
      
            <div class="control-group">
                <label class="control-label" for="doa3">Appointment Start Date</label>
                <div class="controls"><input class="span12" type="text" id="doa3" name="doa3" value="<?php echo $dt->dateformat($data['appointment_start_date']); ?>" /></div>
            </div>
        
           
                <div class="control-group">
                    <label class="control-label" for="ed3">Appointment End Date</label>
                    <div class="controls"><input class="span12" type="text" id="ed3" name="ed3" value="<?php echo $data['appointment_end_date']; ?>"  /></div>
                </div>
            
      
            <div class="control-group">
                <label class="control-label" for="apointment_letter">Appointment letter</label>
                <div class="controls"> <?php echo $data['file']; ?><br>
                    <input type="file"  id="apointment_letter" name="apointment_letter" value="" />
                </div>
            </div>
       
    </div>
    <!-- // Column END -->

</div>

  <input type="hidden" id="pers_post_id" name="pers_post_id" value="<?=$_REQUEST['personal_id']?>"/>

  <input type="hidden" name="postingplaceid"  id="postingplaceid" value="<?php echo $posting_place_id; ?>"/>


<script>
    
//      $("a[id$='-zzid']").click(function () {
//        var value = $(this).attr("id");
//         var pers = $("#pers_post_id").val();
//        var id = value.replace("-zzid", "");
//
//        $.ajax({
//            type: "POST",
//            url: "ajax-edit-posting-place-two.php",
//            data: {
//                id: id,
//                personal_id  : pers
//            },
//            dataType: 'html',
//            success: function (data) {
//                $('#editdiv').html(data);
//                $('#submit').removeAttr("disabled");
//                $("#doa2,#ed2").datepicker({dateFormat: 'dd/mm/yy'});
//            }
//        });
//    });
    
    
         $("#doa3,#ed3").datepicker({dateFormat: 'dd/mm/yy'});

    
    
//    $("#personalbutton").click(function (e) {
//        var form = $("#addpersonalform");
//        form.validate({
//            rules: {
//                // simple rule, converted to {required:true}
//                name: "required",
//                // compound rule
//                contact_no: {
//                    required: true,
//                    number: true
//                }
//            }
//        });
//
//        if (form.valid()) {
//
//            var data = $('#addpersonalform').serialize();
//            $.post('add_personal.php', data).done(function (arsalan) {
//                $('.widget').find('.widget-body').collapse('toggle');
//                $("#personal_id").val(arsalan);
//                $("#pers_specility_id").val(arsalan);
//                $("#pers_training_id").val(arsalan);
////            $("#family_children_id").val(arsalan);
//                $("#pers_post_id").val(arsalan);
//                $("#pers_spouse_id").val(arsalan);
//
//                document.documentElement.scrollTop = 0;
//            });
//        } else {
//            e.preventDefault();
//            alert("Please fill the form");
//        }
//    });
    
</script>
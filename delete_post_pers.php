<?php
require_once 'classes/posting.php';
require_once 'classes/datetime.php';

$posting = new posting();

$posting->pk_id = $_POST['id'];
$res = $posting->delete();

$result = $posting->find_by_personal($_POST['pers_post_id']);

if ($result) {
    ?>
    <!-- Table -->

    <table class="dynamicTable table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th style="width: 1%;" class="center">No.</th>
                <th>Name</th>
<!--            <th>Designation </th>
                <th>BPS</th>-->
                <th>District</th>
                <th>Appointment Start Date</th>
                <th>Appointment End Date</th>
                <th>Letter</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table row -->
            <?php
            $count = 1;
            while ($row = $result->fetch_array()) {

                $class = "gradeX";
                if ($count % 2 == 0) {
                    $class = "gradeC";
                }
                //$attchment = new attachments();
                //$att_count = $attchment->count_all($row['pk_id']);
                ?>
                <tr class="<?php echo $class; ?>">
                    <td class="center"><?php echo $count; ?></td>
                    <td><?php echo $row['name']; ?></td>
<!--                    <td class="important"><?php echo $row['designation']; ?></td>
                    <td class="important"><?php echo $row['bps']; ?></td>-->
                    <td class="important"><?php echo $row['wh_name']; ?></td>
                      <td class="important"><?php echo $dt->dateformat($row['appointment_start_date']); ?></td>
                      
                       <?php
                              $t = $row['appointment_end_date'];

                              if ($t != '0000-00-00') {
                                  ?>

                                  <td class="important"><?php echo $dt->dateformat($row['appointment_end_date']); ?></td>
                                  <?php } else {
                                  ?>

                                  <td class="important"><?php echo 'Present' ?></td>

                                  <?php }
                              ?>
                              <td class="important"><a style="cursor: pointer" onclick="window.open('upload/<?php echo $row['file']; ?>', 'Appointment Letter', 'width:800,height=600')"><?php echo $row['file']; ?></a></td>
                              <td class="center" style="width: 200px;">
                                  <a id="<?php echo $row['pk_id']; ?>-delposting" class="btn-action glyphicons bin" title="delete"><i></i></a>
                                  <?php if ($t == '0000-00-00') { ?>
                                      <a href="#edit" data-toggle="modal" id="<?php echo $row['pk_id']; ?>-fid" class="btn-action glyphicons pen" title="edit"><i></i></a>
                                  <?php } ?>
                        
                    </td>
                </tr>
                <?php
                $count++;
            }
            ?>
            <!-- // Table row END -->
            <!-- Table row -->

            <!-- // Table row END -->
        </tbody>
    </table>
    <!-- // Table END -->
    <?php
} else {
    echo "<hr><h5> No records found!</h5>";
}
?>
<form class="form-horizontal" enctype="multipart/form-data" style="margin-bottom: 0;" id="validateSubmitForm" method="post" autocomplete="off" action="add_posting.php">
    <div class="modal hide fade" id="edit">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Edit</h3>
        </div>
        <div class="modal-body" id="editdiv">
            <div class="center"><img src="common/bootstrap/extend/bootstrap-image-gallery/img/loading.gif"/></div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
        </div>
    </div>
</form>

    
    <script>
        
    $("a[id$='-fid']").click(function () {
        var value = $(this).attr("id");
        var id = value.replace("-fid", "");

        $.ajax({
            type: "POST",
            url: "ajax-edit-posting-place-two.php",
            data: {
                id: id
            },
            dataType: 'html',
            success: function (data) {
                $('#editdiv').html(data);
                $('#submit').removeAttr("disabled");
                $("#doa1,#ed1").datepicker({dateFormat: 'dd/mm/yy'});
            }
        });
    });
    
//      $("#doa,#ed").datepicker({dateFormat: 'dd/mm/yy'});

    </script>
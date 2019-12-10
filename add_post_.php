<?php
session_start();
require_once 'classes/posting.php';
require_once 'classes/datetime.php';

$posting = new posting();

if (isset($_REQUEST['postid']) && !empty($_REQUEST['postid'])) {
    $post->pk_id = $_REQUEST['postid'];
}

$uploading = false;

if (isset($_FILES['apointment_letter'])) {
    $uploading = true;
    $_SESSION['msg'] = '';
    $file_name = $_FILES['apointment_letter']['name'];
    $file_size = $_FILES['apointment_letter']['size'];
    $file_tmp = $_FILES['apointment_letter']['tmp_name'];
    $file_type = $_FILES['apointment_letter']['type'];
    $file_ext = strtolower((explode('.', $_FILES['apointment_letter']['name'])[1]));

    $extensions = array("jpeg", "jpg", "png", "pdf", "docx", "doc");

    if (in_array($file_ext, $extensions) === false) {
        $_SESSION['msg'] = "Error! extension not allowed, please choose an image, pdf or doc file";
    }

    if ($file_size > 5097152) {
        $_SESSION['msg'] = 'Error! File size must be excately 5 MB';
    }

    if (empty($_SESSION['msg']) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    }
}

if ($uploading == true && empty($_SESSION['msg']) == true) {
    $posting->post_id = $_POST['post_id'];
    $posting->post_place_id = $_POST['post_place_id'];
    $posting->personal_record_id = $_POST['pers_post_id'];
    $posting->file = $file_name;
    $posting->date_of_appointment = $dt->dbformat($_POST['doa']);

    $file = $posting->save();
} else {
    echo "<span style='color:red'>".$_SESSION['msg']."</span>";
}

$result = $posting->find_by_personal($_POST['pers_post_id']);

if ($result) {
    ?>
    <!-- Table -->

    <table class="dynamicTable table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th style="width: 1%;" class="center">No.</th>
                <th>Name</th>
                <th>District</th>
                <th>Date of Appointment</th>
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
                    <!--<td class="important"><?php echo $row['designation']; ?></td>-->
                    <!--<td class="important"><?php echo $row['bps']; ?></td>-->
                    <td class="important"><?php echo $row['wh_name']; ?></td>
                    <td class="important"><?php echo $row['date_of_appointment']; ?></td>
                    <td class="important"><a style="cursor: pointer" onclick="window.open('upload/<?php echo $row['file']; ?>', 'Appointment Letter', 'width:800,height=600')"><?php echo $row['file']; ?></a></td>
                    <td class="center" style="width: 200px;">
                        <a id="<?php echo $row['pk_id']; ?>-delposting" class="btn-action glyphicons bin" title="delete"><i></i></a>
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


<?php

session_start();
require_once 'classes/posting.php';
require_once 'classes/datetime.php';

$posting = new posting();

if (isset($_REQUEST['postingplaceid']) && !empty($_REQUEST['postingplaceid'])) {
    $posting->pk_id = $_REQUEST['postingplaceid'];
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

//    if (in_array($file_ext, $extensions) === false) {
//        $_SESSION['msg'] = "Error! extension not allowed, please choose an image, pdf or doc file";
//    }

    if ($file_size > 5097152) {
        $_SESSION['msg'] = 'Error! File size must be excately 5 MB';
    }

    if (empty($_SESSION['msg']) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    }
}

$personal_id = $_POST['pers_post_id'];

if ($uploading == true && empty($_SESSION['msg']) == true) {
    $posting->post_id = $_POST['post_id'];
    $posting->post_place_id = $_POST['post_place_id'];
    $posting->personal_record_id = $personal_id;
    $posting->appointment_start_date =  $dt->dbformat($_POST['doa3']);
    $posting->appointment_end_date =  $dt->dbformat($_POST['ed3']);
    $posting->file = $file_name;
    
    $file = $posting->save();
}

//$personal_id = $_POST['pers_post_id'];
//echo $personal_id;
//exit;

if ($file) {
    header("location: edit_personal_record.php?id=$personal_id");
} else {
    header("location: edit_personal_record.php?id=$personal_id");
}

<?php

session_start();
require_once 'classes/personal.php';

if (isset($_FILES['picture'])) {
    $errors = array();
    $file_name = $_FILES['picture']['name'];
    $file_size = $_FILES['picture']['size'];
    $file_tmp = $_FILES['picture']['tmp_name'];
    $file_type = $_FILES['picture']['type'];
    $file_ext = strtolower((explode('.', $_FILES['picture']['name'])[1]));
    
    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $_SESSION['msg'] = "Error! extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $_SESSION['msg'] = 'Error! File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        header("location:personal_record.php?status=file");
    }
}

$doctors = new personal();
$doctors->pk_id = $_REQUEST['fileid'];
$doctors->picture = $file_name;
$doctors->modified_by = 1;
$doctors->modified_date = date("Y-m-d");
$file = $doctors->upload();

if ($file) {
    $_SESSION['msg'] = "Picture has been uploaded successfully!";
    header("location:personal_record.php?status=file");
} else {
    $_SESSION['msg'] = "Permission denied. Please try again!";
    header("location:personal_record.php?status=forbidden");
}
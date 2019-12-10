<?php

require_once 'classes/degree.php';

$doctors = new degree();
$doctors->pk_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: degree.php?is_active=is_active");
} else {
    header("location: degree.php?is_active=forbidden");
}






//require_once 'classes/degree.php';
//
//$degree = new degree();
//$degree->pk_id = $_GET['id'];
//$res = $degree->delete();
//
//if ($res) {
//    header("location: degree.php");
//} else {
//    header("location: degree.php");
//}
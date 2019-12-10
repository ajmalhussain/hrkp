<?php

require_once 'classes/specialities.php';

$doctors = new speciality();
$doctors->pk_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: specialities_record.php?is_active=is_active");
} else {
    header("location: specialities_record.php?is_active=forbidden");
}






//$speciality = new speciality();
//$speciality->pk_id = $_GET['id'];
//$res = $speciality->delete();
//
//if ($res) {
//    header("location: specialities_record.php");
//} else {
//    header("location: specialities_record.php");
//}
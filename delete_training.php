<?php

require_once 'classes/training.php';

$doctors = new training();
$doctors->pk_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: training_record.php?is_active=is_active");
} else {
    header("location: training_record.php?is_active=forbidden");
}





//$training = new training();
//$training->pk_id = $_GET['id'];
//$res = $training->delete();
//
//if ($res) {
//    header("location: training_record.php");
//} else {
//    header("location: training_record.php");
//}

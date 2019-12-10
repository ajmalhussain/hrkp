<?php

require_once 'classes/university.php';

$doctors = new university();
$doctors->pk_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: university.php?is_active=is_active");
} else {
    header("location: university.php?is_active=forbidden");
}






//$university = new university();
//$university->pk_id = $_GET['id'];
//$res = $university->delete();
//
//if ($res) {
//    header("location: university.php");
//} else {
//    header("location: university.php");
//}
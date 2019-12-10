<?php

require_once 'classes/user.php';

$doctors = new user();
$doctors->pk_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: users.php?is_active=is_active");
} else {
    header("location: users.php?is_active=forbidden");
}





//$user = new user();
//$user->pk_id = $_REQUEST['id'];
//$res = $user->delete();
//
//if ($res) {
//    header("location: users.php");
//} else {
//    header("location: users.php");
//}
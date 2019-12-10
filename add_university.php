<?php

session_start();
require_once 'classes/university.php';
require_once 'classes/datetime.php';

$university = new university();

if (isset($_REQUEST['uniid']) && !empty($_REQUEST['uniid'])) {
    $university->pk_id = $_REQUEST['uniid'];
}

$university->university_name = $_POST['university_name'];
$university->city = $_POST['city'];
$university->country = $_POST['country'];
$university->is_active = 1;


$file = $university->save();

if ($file) {
    header("location: university.php");
} else {
    header("location: university.php");
}
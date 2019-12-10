<?php

session_start();
require_once 'classes/degree.php';
require_once 'classes/datetime.php';

$degree = new degree();

if (isset($_REQUEST['degreeid']) && !empty($_REQUEST['degreeid'])) {
    $degree->pk_id = $_REQUEST['degreeid'];
}

$degree->degree_title = $_POST['degree_title'];
$degree->duration = $_POST['duration'];
$degree->degree_recognised_by = $_POST['degree_recognised_by'];
$degree->is_active = 1;


$file = $degree->save();

if ($file) {
    header("location: degree.php");
} else {
    header("location: degree.php");
}
<?php


session_start();
require_once 'classes/training.php';
require_once 'classes/datetime.php';

$training = new training();

if(isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])){
    $training->pk_id = $_REQUEST['fileid'];
}

$training->title = $_POST['title'];
$training->training_date = $dt->dbformat($_POST['training_date']);
$training->is_active = 1;

$file = $training->save();

if ($file) {
    header("location: training_record.php");
} else {
    header("location: training_record.php");
}



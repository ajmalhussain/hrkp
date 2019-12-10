<?php

require_once 'classes/personal.php';

$doctors = new personal();
$doctors->pk_id = $_GET['id'];
$doctors->status = $_GET['status'];
$res = $doctors->status();

if ($res) {
    header("location: personal_record.php?status=status");
} else {
    header("location: personal_record.php?status=forbidden");
}
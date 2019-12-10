<?php

require_once 'classes/doctors.php';
$doctors = new doctors();
$doctors->pk_id = $_GET['id'];
$res = $doctors->delete();

if ($res) {
    header("location: doctors.php?status=file");
} else {
    header("location: doctors.php?status=forbidden");
}
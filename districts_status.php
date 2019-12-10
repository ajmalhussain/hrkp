<?php

require_once 'classes/district.php';

$doctors = new district();
$doctors->PkLocID = $_GET['id'];
$doctors->status = $_GET['status'];
$res = $doctors->status();

if ($res) {
    header("location: districts.php?status=status");
} else {
    header("location: districts.php?status=forbidden");
}
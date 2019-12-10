<?php

require_once 'classes/posting_place.php';

$doctors = new posting_place();
$doctors->wh_id = $_GET['id'];
$doctors->is_active = $_GET['is_active'];
$res = $doctors->is_active();

if ($res) {
    header("location: posting_place.php?is_active=is_active");
} else {
    header("location: posting_place.php?is_active=forbidden");
}
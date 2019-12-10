<?php

require_once 'classes/family.php';
$family = new family();
$family->pk_id = $_GET['id'];
$res = $family->delete();

if ($res) {
    header("location: add_personal_record.php");
} else {
    header("location: add_personal_record.php");
}
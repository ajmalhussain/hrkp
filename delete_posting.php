<?php

require_once 'classes/posting.php';
$posting = new posting();
$posting->pk_id = $_GET['id'];
$res = $posting->delete();

if ($res) {
    header("location: add_personal_record.php");
} else {
    header("location: add_personal_record.php");
}
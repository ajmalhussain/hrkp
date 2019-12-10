<?php

require_once 'classes/district.php';

$district = new district();
$district->PkLocID = $_REQUEST['id'];
$res = $district->delete();


if ($res) {
    header("location: districts.php");
} else {
    header("location: districts.php");
}
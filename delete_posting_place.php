<?php

require_once 'classes/posting_place.php';

$posting_place = new posting_place();
$posting_place->wh_id = $_GET['id'];
$res = $posting_place->delete();

if ($res) {
    header("location: posting_place.php");
} else {
    header("location: posting_place.php");
}
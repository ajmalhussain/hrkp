<?php

session_start();
require_once 'classes/posting_place.php';
require_once 'classes/datetime.php';

$posting_place = new posting_place();

if(isset($_REQUEST['postingplaceid']) && !empty($_REQUEST['postingplaceid'])){
    $posting_place->wh_id = $_REQUEST['postingplaceid'];
}

$posting_place->wh_name = $_POST['wh_name'];
$posting_place->dist_id = $_POST['district_of_domicile'];
$posting_place->prov_id = 3;
$posting_place->stkid = 1;
$posting_place->is_active = 1;

$file = $posting_place->save();

if ($file) {
    header("location: posting_place.php");
} else {
    header("location: posting_place.php");
}
<?php

session_start();
require_once 'classes/district.php';
require_once 'classes/datetime.php';

$district = new district();

if(isset($_REQUEST['districtid']) && !empty($_REQUEST['districtid'])){
    $district->PkLocID = $_REQUEST['districtid'];
}


$district->LocName = $_POST['LocName'];
$district->ParentID = 3;

//$district->LocLvl = $_POST['lvl'];
//$district->ParentID = $_POST['district_of_domicile'];

$checkname = $district->checkdistrictname($district->LocName);

if($checkname){

    echo "district already exist";
    exit();
    
}else{
    $file = $district->save();
//    print_r($file);
//    exit;
}


if ($file) {
    header("location: districts.php");
} else {
    header("location: districts.php");
}
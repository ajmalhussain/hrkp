<?php

session_start();
require_once 'classes/specialities.php';

require_once 'classes/datetime.php';

$speciality = new speciality();

if(isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])){
    $speciality->pk_id = $_REQUEST['fileid'];
}
$speciality->specility = $_POST['specility'];
$speciality->is_active = 1;

$file = $speciality->save();

if ($file) {
    header("location: specialities_record.php");
} else {
    header("location: specialities_record.php");
}
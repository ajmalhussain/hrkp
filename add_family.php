<?php

session_start();
require_once 'classes/family.php';

$family = new family();

if(isset($_REQUEST['familyid']) && !empty($_REQUEST['familyid'])){
    $family->pk_id = $_REQUEST['familyid'];
}

$family->spouse_id = (!empty($_POST['family_id']) ? $_POST['family_id'] : '0');
$family->personal_record_id = $_POST['pers_spouse_id'];
$family->health_professional = $_POST['is_health_professional'];

echo $family_id = $family->save();
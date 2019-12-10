<?php


session_start();
require_once 'classes/personal.php';
require_once 'classes/datetime.php';

$personal = new personal();
if(isset($_REQUEST['personalid']) && !empty($_REQUEST['personalid'])){
    $personal->pk_id = $_REQUEST['personalid'];
}
$personal->name = $_POST['name'];
$personal->father_name = $_POST['father_name'];
$personal->gender = $_POST['gender'];
$personal->cnic = $_POST['cnic'];
$personal->district_of_domicile = $_POST['district_of_domicile'];
$personal->date_of_birth = $dt->dbformat($_POST['date_of_birth']);
//$personal->date_of_appointment = $dt->dbformat($_POST['date_of_appointment']);
$personal->contact_no = $_POST['contact_no'];
$personal->email = $_POST['email'];
$personal->postal_address = $_POST['postal_address'];
$personal->pmdc_registration = $_POST['pmdc_registration'];
$personal->marital_status = $_POST['marital_status'];
$personal->health_professional = $_POST['health_professional'];
$personal->status_two = $_POST['status_two'];
$personal->residential_address = $_POST['residential_address'];
$personal->current_address = $_POST['current_address'];
$personal->residential_city = $_POST['residential_city'];
$personal->current_city = $_POST['current_city'];
$personal->created_by = $_SESSION['userid'];

$id = $personal->save();

echo $id;
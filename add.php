<?php

session_start();
require_once 'classes/doctors.php';
require_once 'classes/datetime.php';

$doctors = new doctors();
if(isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])){
    $doctors->pk_id = $_REQUEST['fileid'];
}
$doctors->name_of_doctor = $_POST['name_of_doctor'];
$doctors->father_name = $_POST['father_name'];
$doctors->gender = $_POST['gender'];
$doctors->cnic = $_POST['cnic'];
$doctors->district_of_domicile = $_POST['district_of_domicile'];
$doctors->dob = $dt->dbformat($_POST['dob']);
$doctors->date_of_appointment = $dt->dbformat($_POST['date_of_appointment']);
$doctors->contact_no = $_POST['contact_no'];
$doctors->email = $_POST['email'];
$doctors->postal_address = $_POST['postal_address'];
$doctors->pmdc_registration = $_POST['pmdc_registration'];
$doctors->current_designation = $_POST['current_designation'];
$doctors->place_of_posting = $_POST['place_of_posting'];
$doctors->bps = $_POST['bps'];
$doctors->mbbs_bds_md = $_POST['mbbs_bds_md'];
$doctors->ms = $_POST['ms'];
$doctors->fcps_i = $_POST['fcps_i'];
$doctors->fcps_ii = $_POST['fcps_ii'];
$doctors->mcps_dimploma = $_POST['mcps_dimploma'];
$doctors->other = $_POST['other'];
$doctors->speciality = $_POST['speciality'];
$doctors->marital_status = $_POST['marital_status'];
$doctors->spouse_applicable = $_POST['spouse_applicable'];
$doctors->spouse_designation = $_POST['spouse_designation'];
$doctors->place_of_posting1 = $_POST['place_of_posting1'];
$doctors->bps1 = $_POST['bps1'];
$doctors->qualification = $_POST['qualification'];
$doctors->training_complete = $_POST['training_complete'];
$doctors->speciality1 = $_POST['speciality1'];
$doctors->others = $_POST['others'];
$doctors->received_from = $_POST['received_from'];
$doctors->created_by = 1;
$doctors->modified_by = 1;
$doctors->created_date = date("Y-m-d");
$doctors->modified_date = date("Y-m-d");
$file = $doctors->save();

if ($file) {
    $_SESSION['msg'] = "Record has been added successfully!";
    header("location:doctors.php?status=file");
} else {
    $_SESSION['msg'] = "Permission denied. Please try again!";
    header("location:doctors.php?status=forbidden");
}
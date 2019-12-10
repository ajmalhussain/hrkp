<?php

session_start();
require_once 'classes/user.php';
require_once 'classes/datetime.php';

$user = new user();

if (isset($_REQUEST['userid']) && !empty($_REQUEST['userid'])) {
    $user->pk_id = $_REQUEST['userid'];
}

$user->username = $_POST['username'];
$user->designation = $_POST['designation'];
$user->login_id = $_POST['login_id'];
if (isset($_POST['password']) && !empty($_POST['password'])) {
    $user->password = md5($_POST['password']);
} else {
    $user->password = $_POST['old_password'];
}
$user->email = $_POST['email'];
$user->phone = $_POST['phone'];
$user->district_of_domicile = $_POST['district_of_domicile'];
$user->role_id = $_POST['role_id'];
$user->is_active = $_POST['status'];

$file = $user->save();

if ($file) {
    header("location: users.php");
} else {
    header("location: users.php");
}
<?php

require_once 'classes/users.php';

session_start();

$users = new users();
if (isset($_REQUEST['username']) && !empty($_REQUEST['username'])) {
    $username = $_REQUEST['username'];
    $users->username = $username;
}
if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
    $users->password = $password;
}

if ($users->login()) {
    if($_SESSION['role'] == 3) {
        header("location:user_personal_record.php");
    } else {
        header("location:personal_record.php");
    }
    
} else {
    header("location:index.php");
}
die();
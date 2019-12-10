<?php

session_start();
require_once 'classes/post.php';

$post = new post();

if(isset($_REQUEST['fileid']) && !empty($_REQUEST['fileid'])){
    $post->pk_id = $_REQUEST['fileid'];
}

$post->name = $_POST['name'];
$post->designation = $_POST['designation'];
$post->bps = $_POST['bps'];

$file = $post->save();

if ($file) {
    header("location: post_record.php");
} else {
    header("location: post_record.php");
}
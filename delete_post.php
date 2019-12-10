<?php

require_once 'classes/post.php';
$post = new post();
$post->pk_id = $_GET['id'];
$res = $post->delete();

if ($res) {
    header("location: post_record.php");
} else {
    header("location: post_record.php");
}
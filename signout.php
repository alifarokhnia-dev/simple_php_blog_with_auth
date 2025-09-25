<?php 
session_start();
$_SESSION['signed_in'] = FALSE;
$_SESSION['message'] = "signed out successfuly!";
$_SESSION['message_class'] = "success";
header("Location: posts.php")
?>
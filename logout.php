<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

$_SESSION['login'] = FALSE;
unset($_SESSION['user_id']);
session_destroy();
header("location:index");
?>
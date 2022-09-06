<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$dbf = new User();

$dbf->user_logout();
header("location:index.php");

?>
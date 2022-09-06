<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

?>
<body><?php include 'header.php';?></header><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div style="height:100px; padding-top:100px; padding-left:400px;" align="center"><b>You are blocked by the Admin!!!</b></div></div></div><footer><?php include('footer.php');?></footer></body></html>
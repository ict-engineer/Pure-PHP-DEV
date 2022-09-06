<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

$menu_title=$dbf->fetchSingle("seo","id='1'");
$pageTitle=$menu_title[meta_title];
$metaDescr=$menu_title[meta_descr];
$metaKeyword=$menu_title[meta_keyword];

include 'application_top.php';

$cts=$dbf->fetchSingle("contents","id='17'");
$mvr=$dbf->fetchSingle("contents","id='18'");
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h2 style="text-align:center;"><?php echo $cts['page_title'];?><br />AND<br/><?php echo $mvr['page_title'];?></h2><div class="spacer1"></div><div class="spacer1"></div><div class="conimg"><img src="content_img/<?php echo $cts['photo'];?>" /></div><div class="contxt"><?php echo stripslashes($cts['content']);?></div><div class="spacer1"></div><div class="spacer1"></div><div class="conimg"><img src="content_img/<?php echo $mvr['photo'];?>" /></div><div class="contxt"><?php echo stripslashes($mvr['content']);?></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
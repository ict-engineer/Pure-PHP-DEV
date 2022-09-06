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
$rel_shipping=$dbf->fetchSingle("contents","id='9'");
$international=$dbf->fetchSingle("contents","id='20'");
include 'application_top.php';
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h1><?php echo $rel_shipping['page_title'];?> <span><?php echo $rel_shipping['page_title2'];?></span></h1><div class="contxt"> <?php echo stripslashes($rel_shipping['content']);?><br /> <br /></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="contentsec1"><h1><?php echo $international['page_title'];?> <span><?php echo $international['page_title2'];?></span></h1><div class="contxt"><?php echo stripslashes($dbf->cut($international['content'],620));?><div class="spacer"></div><div align="right"><a href="readmore"><img src="images/readmoe.png" /></a></div><div class="spacer"></div><div class="spacer"></div></div></div><div class="spacer1"></div></div></div><footer><?php include('footer.php'); ?></footer></body></html>
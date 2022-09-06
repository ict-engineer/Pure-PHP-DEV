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
?>
<body><?php include 'header.php';?><nav><div class="menubar"> <?php include 'menu.php';?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php';?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec1"> <h1>Testimonial</h1> <?php foreach($dbf->fetch("testimonial","","id","","DESC")as $testimonial){?> <div class="contxt"> "<?php echo stripslashes($dbf->cut(strip_tags($testimonial['descr']),400)); ?>"<a href="testimonial_more.php?id=<?php echo $testimonial['id'];?>">[more]</a><br /></div> <div align="right" class="testimonialname"><?php echo stripslashes($testimonial[name]); ?></div> <div style="height:20px;"></div> <?php } ?> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php'); ?></footer></body></html>
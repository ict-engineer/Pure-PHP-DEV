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
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec1"><h1>Financial use </h1><div class="spacer1"></div><div class="faq_text">This page has the answers to the questions most fequently asked about the financial aspects of the SafeDeal service.</div><div class="spacer1"></div><?php foreach($dbf->fetch("faq","faq_type='Financial Question'","id","","ASC")as $res_faqfinancialhead){?><div class="faq_question"><span><img src="images/bullet-black.png" width="16" height="16"></span><a href="#finance<?php echo $res_faqfinancialhead[id];?>"><?php echo stripslashes($res_faqfinancialhead[question]);?></a></div><div class="spacer1"></div><?php } ?><div class="spacer1"></div><div class="faq_text">For any questions about the general use of the SafeDeal service, go to the <a href="general_faq">General use</a> page . If you cannot find the answer to your query, send an e-mail to our Client service. </div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><?php foreach($dbf->fetch("faq","faq_type='Financial Question'","id","","ASC")as $res_faqfinancial){?><a name="finance<?php echo $res_faqfinancial[id];?>"></a><div class="faq_question"><span>Q. </span><?php echo stripslashes($res_faqfinancial[question]);?></div><div class="contxt"><?php echo $res_faqfinancial[answer];?></div><div class="spacer1"></div><div class="spacer2"></div><?php } ?><div class="spacer1"></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
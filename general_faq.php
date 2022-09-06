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
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><content><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec1"><h1>General use </h1><div class="spacer1"></div><div class="faq_text"> This page shows frequently asked questions about using of SafeDeal</div><div class="spacer1"></div><?php foreach($dbf->fetch("faq","faq_type='Question About General Use'","id","","ASC")as $res_faqgenhead){?><div class="faq_question"><span><img src="images/bullet-black.png" width="16" height="16"></span><a href="#gen<?php echo $res_faqgenhead[id];?>"><?php echo stripslashes($res_faqgenhead[question]);?></a></div><div class="spacer1"></div><?php } ?><div class="spacer1"></div><div class="faq_text">For financial queries, including our fee, please read <a href="financial_faq">Financial Faq</a>. If you cannot find the answer to your query, send an e-mail to our Client Services. </div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><?php foreach($dbf->fetch("faq","faq_type='Question About General Use'","id","","ASC")as $res_faqgen){?><a name="gen<?php echo $res_faqgen[id];?>"></a><div class="faq_question"><span>Q. </span><?php echo stripslashes($res_faqgen[question]);?></div><div class="contxt"><?php echo $res_faqgen[answer];?></div><div class="spacer1"></div><div class="spacer2"></div><?php } ?><div class="spacer1"></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
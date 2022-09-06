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
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec1"><h1>FAQ <span>(Frequently asked questions)</span></h1><div class="spacer1"></div><div class="faq_text"> This page shows the questions most fequently asked about our service.<br /><div class="spacer1"></div>We have devided these questions into two categories: <a href="general_faq">general use</a> and <a href="financial_faq">finance</a>.Click on the underlined links to have the answer for any particular query.If your question is not on the list, contact us directly. </div><div class="spacer1"></div><div class="faq_text_title">Questions about general use</div><?php foreach($dbf->fetch("faq","faq_type='Question About General Use'","id","","ASC")as $res_faqgen){?><div class="faq_question"><span><img src="images/bullet-black.png" width="16" height="16"></span><a href="general_faq#gen<?php echo $res_faqgen[id];?>"><?php echo stripslashes($res_faqgen[question]);?></a></div><div class="spacer1"></div><?php } ?><div class="spacer1"></div><div class="faq_text_title">Financial questions</div><?php foreach($dbf->fetch("faq","faq_type='Financial Question'","id","","ASC")as $res_faqgfinance){?><div class="faq_question"><span><img src="images/bullet-black.png" width="16" height="16"></span><a href="financial_faq#finance<?php echo $res_faqgfinance[id];?>"><?php echo stripslashes($res_faqgfinance[question]);?></a></div><div class="spacer1"></div><?php } ?><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php'; ?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
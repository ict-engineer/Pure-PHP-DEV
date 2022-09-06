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

$tranrundocument=$dbf->fetchSingle("contents","id='19'");
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php'; ?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec"> <div class="spacer1"></div> <h2>Terms and Conditions of the Service</h2> <div class="contxt"> <?php foreach($dbf->fetch('term_condition',"","id","","ASC") as $res_termscondition){?> <div class="temstitlediv"><a href="#terms<?php echo $res_termscondition[id];?>"><?php echo $res_termscondition[title];?></a></div> <?php } ?> </div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="term_title">ServiceRules</div> <div class="term_text">SafeDeal supplies a service ("Service") for the terms and conditions of this Contract and any additional deed published by SafeDeal. The definition ''Client'' is he/she who acts as the buyer (''Buyer'') or seller (''Seller') for any transaction.</div> <div class="spacer1"></div> <div class="spacer1"></div> <?php $i=1; foreach($dbf->fetch("term_condition","","id","","ASC")as $res_terms){ ?> <a name="terms<?php echo $res_terms[id];?>"></a> <div class="faq_question"><span><?php echo $i;?>. </span><?php echo stripslashes($res_terms[title]);?></div> <div class="contxt"><?php echo $res_terms[descr];?></div> <div class="spacer1"></div> <div class="spacer2"></div> <?php $i++; } ?> <div class="spacer1"></div> <div class="spacer1"></div> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php');?></footer></body></html>
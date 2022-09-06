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

$safedeal=$dbf->fetchSingle("contents","id='12'");
?>
<script type="text/javascript" src="js/lbskilos_converter.js"></script>
<body><?php include 'header.php';?></header><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><div style="text-align:center;"><h1>LBS-Kilos <span>Converter</span></h1></div><div class="spacer1"></div><div class="contxt"><form action="" method="post" name="convert_frm" id="convert_frm"><div class="convertkilos"><div class="spacer2"></div><div class="convhead">Convert Pounds to Kilograms</div><div class="spacer"></div><div class="convtbcon"><div class="convtxtboxdiv"><input type="text" onKeyUp="calc(this.value,2.2,'ckgrams');" style="font-family: Verdana; font-size: 10pt; font-weight: bold;" class="textbox" /></div><div class="spacer2"></div>LBS</div><div class="convtbcon"><div class="convtxtboxdiv"><input type="text" name="ckgrams" style="font-family: Verdana; font-size: 10pt; font-weight: bold;" class="textbox" /></div><div class="spacer2"></div>KGS</div><div class="spacer"></div><div class="convhead">Convert  Kilograms to Pounds</div><div class="spacer"></div><div class="convtbcon"><div class="convtxtboxdiv"><input type="text" style="font-family: Verdana; font-size: 10pt; font-weight: bold;" onKeyUp="calc2(this.value,2.2,'ckpounds');" class="textbox" /></div>KGS</div><div class="convtbcon"><div class="convtxtboxdiv"><input type="text" style="font-family: Verdana; font-size: 10pt; font-weight: bold;" name="ckpounds" class="textbox" /></div>LBS</div></div></form></div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
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

//register
if($_REQUEST['action']=='pwdchange'){
	$new_pwd=md5($_REQUEST['new_pwd']);
	$string="password='$new_pwd',updated_date=NOW()";
	$dbf->updateTable("members",$string,"id='$_SESSION[user_id]'");
	header("location:my_account");	
}
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><slider><?php include 'banner.php';?></slider><div class="contentsec"><h1>Change <span>Password</span></h1><div class="spacer1"></div><div class="spacer2"></div><form name="frm_forgot_pwd" id="frm_forgot_pwd" action="forgot_change_password" method="post" onSubmit="return validate_forgot_change_password();"><input type="hidden" id="action" name="action" value="pwdchange"/><div class="memberlogdiv"><div class="memlogindiv"><?php if($_REQUEST[msg]=='invalid') { ?><div class="error_msg" align="center">Invalid information.</div><div class="spacer"></div><?php } ?><div class="memlogintxt">New Password</div><div class="memlogintbcon"><input type="password" class="memlogintb"  id="new_pwd" name="new_pwd"/></div><div id="lbl_new_pwd"></div><div class="memlogintxt">Retype Pasword</div><div class="memlogintbcon"><input type="text" class="memlogintb" name="retype_pwd" id="retype_pwd" /></div><div id="lbl_re_pwd"></div><div class="spacer1"></div><div align="center" class="enterbtn"><input type="image" src="images/submit.png" /></div><div class="spacer1"></div></div></div></form><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
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

if($_SESSION['user_id']==''){
	header("location:index");
}
$user_details=$dbf->fetchSingle("members","id=$_SESSION[user_id]");
//register
if($_REQUEST['action']=='update'){
	$old_pwd=md5($_REQUEST['old_pwd']);
	$exist=$dbf->existsInTable("members","password='$old_pwd' and id='$_SESSION[user_id]'");
	if($exist==1){
		$new_pwd=md5($_REQUEST['new_pwd']);
		$gen_password=$_REQUEST['new_pwd'];
		$string="password='$new_pwd',gen_password='$gen_password',updated_date=NOW()";
		$dbf->updateTable("members",$string,"id='$_SESSION[user_id]'");
		header("location:change_password?msg=success");
		}else{
		header("location:change_password?msg=exist");
	}
}
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php'; ?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec">
        <h1>Welcome  <span><?php echo $user_details['name'];?></span></h1><div class="spacer1"></div><div class="contxt"><strong>The obligatory points are marked with </strong> <span>*</span></div><div class="spacer2"></div><form name="frm_pwd" id="frm_pwd" action="change_password" method="post" onSubmit="return validate_change_password();"><input type="hidden" id="action" name="action" value="update"/><div class="resisterdiv"><?php if($_REQUEST[msg]=='success') { ?><div class="suc_msg" align="center">Record successfully saved.</div><div class="spacer"></div><?php } if($_REQUEST[msg]=='exist') { ?><div class="error_msg" align="center">Invalid old password.</div><div class="spacer"></div><?php } ?><div><h3>Change Password</h3></div><div class="spacer1"></div><div class="memlogintxt">Old Password <span>*</span></div><div class="memlogintbcon"><input type="password" class="memlogintb" id="old_pwd" name="old_pwd" autocomplete="off" value=""/></div><div id="lbl_old_pwd"></div><div class="memlogintxt">New Password <span>*</span></div><div class="memlogintbcon"><input type="password" class="memlogintb" id="new_pwd" name="new_pwd" autocomplete="off" value=""/></div><div id="lbl_new_pwd"></div><div class="memlogintxt">Retype Password <span>*</span></div><div class="memlogintbcon"><input type="password" class="memlogintb" id="retype_pwd" name="retype_pwd" autocomplete="off" value=""/></div><div id="lbl_re_pwd"></div><div class="spacer1"></div> <div class="spacer1"></div><div class="spacer1"></div><div class="spacer1"></div><div align="center"><input type="image"src="images/submit.png" /></div><div class="spacer1"></div><div class="spacer1"></div></div></form><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
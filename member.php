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

//Object initialization
$dbf = new User();
//login
if($_REQUEST['action']=='login'){
	$pwd=md5($_REQUEST['password']);
	$exist=$dbf->existsInTable("members","email='$_REQUEST[email]' and password='$pwd'");
	if($exist==1)
	{
		$ChkActive=$dbf->existsInTable("members","email='$_REQUEST[email]' and password='$pwd' and status='0'");
		if($ChkActive==1){
			$user_id=$dbf->getDataFromTable("members","id","email='$_REQUEST[email]' and password='$pwd'");
			$_SESSION['user_id']=$user_id;
			header("location:my_account");
		}else{
			header("location:member?msg=001");
		}
	}else{
		header("location:member?msg=fail");
	}
}
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h1>Transmith Group <span>Member</span></h1><div class="spacer1"></div><div class="contxt">Type in your data here to see and work on your transactions  or <a href="register">register</a> as a new client. </div><div class="spacer2"></div><form name="frm_login" id="frm_login" action="member" method="post" onSubmit="return validate_login();"><input type="hidden" id="action" name="action" value="login"><div class="memberlogdiv"><div class="trackingcontxt">Registered Transmith Group Client</div><div class="spacer1"></div><?php if($_REQUEST['msg']=='fail') { ?><div class="error_msg" align="center">Invalid email address or password.</div><div class="spacer"></div><?php } if($_REQUEST['msg']=='001') { ?><div class="error_msg" align="center">Your account is not activated yet.</div><div class="spacer"></div><?php } ?><div class="spacer1"></div><div class="memlogindiv"><div class="memlogintxt">E-mail</div><div class="memlogintbcon"><input type="text" class="memlogintb" autocomplete="off" id="email" name="email"/></div><div id="lbl_email"></div><div class="memlogintxt">Password</div><div class="memlogintbcon"><input type="password" class="memlogintb" autocomplete="off" id="password" name="password"/></div><div id="lbl_password"></div><div class="spacer1"></div><div align="center" class="fgpassword"><a href="forgot_password">Forgot Password ?</a></div><div align="center" class="enterbtn"><input type="image" src="images/enter.png" /></div><div class="spacer1"></div></div></div></form><div class="spacer1"></div><div align="center"><a href="register"><img src="images/registration.png" border="0" /></a></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php'; ?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
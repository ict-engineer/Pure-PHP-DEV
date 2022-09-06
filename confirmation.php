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

if($_SESSION['user_id']!=''){
	header("location:my_account");
}

//register
if($_REQUEST['page']=='esregistered')
{
	$chk_ActivationKey=$dbf->existsInTable("members","activation_key='$_REQUEST[activationkey]'");
	if($chk_ActivationKey==1)
	{
		$exist=$dbf->existsInTable("members","activation_key='$_REQUEST[activationkey]' AND status='0'");
		if($exist!=1)
		{
			$dated=date("Y-m-d");
			$string="status='0',updated_date='$dated'";
			$dbf->updateTable("members",$string,"activation_key='$_REQUEST[activationkey]'");
			//$_SESSION[user_id]=$ins_id;
			header("location:confirmation?msg=activate");
		}else{
			header("location:confirmation?msg=exist");
		}
	}else{
		header("location:confirmation?msg=001");
	}
}
?>
<script type="text/javascript" src="js/reset_tracking.js"></script><body>
<?php include 'header.php';?>
<nav><div class="menubar"><?php include 'menu.php';?></div></nav>
<div class="contentouterdiv">
	<div class="contentsecdiv">
		<div class="contentleftdiv">
			<div class="bannerdiv"><?php include 'banner.php';?></div>
			<div class="spacer1"></div>
			<div class="spacer2"></div>
			<div class="contentsec">
				<h1>Activate <span>Account</span></h1>
				<div class="spacer1"></div>
                <?php if($_REQUEST['msg']=="exist"){ ?>
                <div align="center" class="error_msg">Your account has already activated.</div>
                <?php } if($_REQUEST['msg']=="001"){ ?>
                <div align="center" class="error_msg">Invalid activation key !</div>
                <?php } if($_REQUEST['msg']=="activate"){ ?>
                <div align="center" class="suc_msg">Your account has been activated successfully.<br/><br/>
                <a href="member"><img src="images/loginbtn.png" width="120" height="39"></a></div>
                <?php }else { ?>
				<form name="frm_confirm" id="frm_confirm" action="confirmation" method="post" onSubmit="return validate_confirmation();">
            	<input type="hidden" id="page" name="page" value="esregistered"/>
					<div class="trackingcondiv">
						<div class="trackingcon">
							<div class="trackingcontxt">Enter Activation Key</div>
							<div class="activationkeytbcon"><input name="activationkey" id="activationkey" type="text" maxlength="28" autocomplete="off" class="trackingtb"/></div>
							<div class="spacer1"></div>
							<div align="center">
								<a href="javascript:void(0);" onClick="reset_actkeybox();"><img src="images/reset.png" border="0"/></a>&nbsp;<input type="image" src="images/submit.png" border="0"/>
							</div>
						</div>
					</div>
				</form>
                <?php } ?>
				<div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
                <div class="spacer1"></div>
			</div>
			<div class="shadow"><img src="images/shadow.png"/></div>
		</div>
		<div class="contentrightdiv"><?php include 'right_menu.php';?></div>
		<div class="spacer2"></div>
		<div class="spacer1"></div>
	</div>
</div>
<footer><?php include('footer.php');?></footer>
</body>
</html>
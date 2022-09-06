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

if($_REQUEST['action']=='CheckTrackingNo')
{
	$numAdmin=$dbf->countRows('admin',"tracking_password='$_REQUEST[tracking_no]'");
	if($numAdmin!=0)
	{
		$resAdmin=$dbf->fetchSingle("admin","tracking_password='$_REQUEST[tracking_no]'");
		$email=$resAdmin['email'];
		$password=$resAdmin['password'];
				
		$login = $dbf->check_login($email,$password);
		if ($login)
		{
			// Login Success
			header("location:admin/index.php");
		}
		else
		{
			header("Location:tracking?msg=exist");	
		}
	}
	else
	{
		$num=$dbf->countRows('tracking_system',"tracking_no='$_REQUEST[tracking_no]' AND active_status='1'");
		if($num==0)
		{
			header("Location:tracking?msg=exist");
		}
	
		else
		{
			//$trackingno=base64_encode(base64_encode($_REQUEST[tracking_no]));
			header("Location:tracking_detail?trackingno=$_REQUEST[tracking_no]");
		}	
	}
}

$tracking=$dbf->fetchSingle("contents","id='5'");
?>
<script type="text/javascript" src="js/reset_tracking.js"></script><body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h1><?php echo $tracking['main_title'];?> <span><?php echo $tracking['main_title2'];?></span></h1><div class="spacer1"></div><form action="tracking.php?action=CheckTrackingNo" name="tracking_frm" id="tracking_frm" method="post"><div class="trackingcondiv"><div class="trackingcon"><div class="trackingcontxt"><?php echo $tracking['page_title'];?> <?php echo $tracking['page_title2'];?></div><?php if($_REQUEST[msg]=="exist"){ ?><div align="center" class="error_msg">Invalid tracking number !</div><?php } ?><div class="trackingtbcon"><input name="tracking_no" id="tracking_no" type="text" maxlength="20" autocomplete="off" class="trackingtb" /></div><div class="spacer1"></div><div align="center"> <a href="javascript:void(0);" onClick="reset_trackingbox();"><img src="images/reset.png" border="0" /></a>&nbsp;<input type="image" src="images/submit.png" border="0" /></div></div></div></form><div class="spacer1"></div><div class="contentsec1"><h1><?php echo $tracking['page_title'];?> <span> <?php echo $tracking['page_title2'];?></span></h1><div class="contxt"><?php echo stripslashes($tracking['content']);?></div><div class="spacer1"></div><div align="center"><img src="images/trackingsoft.jpg" /></div><div class="spacer1"></div></div><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
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

$res=$dbf->fetchSingle("contact","id='1'");

//Object initialization
$dbf = new User();
if($_REQUEST[action]=='contact'){
	$descr=addslashes($_REQUEST['message']);
  	$string="name='$_REQUEST[name]',email='$_REQUEST[email]',phone='$_REQUEST[phone]',message='$descr',dated=NOW();";
  	$dbf->insertSet("contact_us",$string);
  	//Fetch Single Data From Admin
	$res_admin=$dbf->fetchSingle("admin","id='1'");		
	$to=$res_admin['email'];
	$from=addslashes($_REQUEST['email']);
	$name=addslashes($_REQUEST['name']);
	$phone=addslashes($_REQUEST['phone']);
	$mesg=$_REQUEST['message'];
	$imgPath=$res_admin[site_url]."/images/logo.png";
		
	$headers = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=UTF-8\n";
	$headers .= "From:".$res[domain_name]." <".$from.">\n";
	$body='<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td width="3%" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
		<td width="97%" height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; color:#191919; font-weight: bold;">Name of the Visitor : '.$name.' </span><br/>
        Phone number : '.$phone.'<br/>
        E-Mail address : '.$from.'<br/>
        Message : '.$mesg.'</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" ></td>
		<td height="10" colspan="2" align="left" valign="top" ></td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="25" colspan="2" align="left" valign="top" style="padding-right:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;">Thanks,<br/>
		'.$name.' </span></td>
	  </tr>
	  <tr>
		<td align="left" valign="top" ></td>
		<td height="20" colspan="2" align="left" valign="top" ></td>
	  </tr>
	</table>';
	//mail( "someone@example.com", "Subject: $subject", $message, "From: $email" );
	$subject = 'Inquiry From Visitor';
	//echo $body;exit;
	$ok=mail($to,$subject,$body,$headers);
	
	if($ok)
	{
		header("location:contact?msg=sent");
	}
	else
	{
		header("location:contact?msg=error");
	}						
}

$international=$dbf->fetchSingle("contents","id='20'");
?>
<script type="text/javascript" src="js/contact_map.js" language="javascript"></script><body><?php include 'header.php';?></header><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h1>Locate <span>Us</span></h1><div class="spacer"></div><div class="address"><h2><?php echo $res['contact_title'];?> </h2><br /><?php echo $res['address'];?><br /><?php echo $res['postcode'];?> <?php echo $res['location'];?><br /><?php echo $res['country'];?><br />Phone : <?php echo $res['tel_no'];?><br />Fax : + <?php echo $res['fax_no'];?><br />Email : <?php echo $res['email'];?></div><div class="map"><div id="map_canvas1" style="height:100%;width:100%;"></div><input type="hidden" name="haddress1" id="haddress1" value="<?php echo $res[postcode];?>"></div><div class="spacer"></div><div class="contactformdiv"><div class="conformheadbg"><div class="conformhead">Contact Form</div></div><div class="contactform"><form name="contact_frm" id="contact_frm" action="contact.php" method="post" onSubmit="return validate();"><input type="hidden" id="action" name="action" value="contact"><?php if($_REQUEST[msg]=='sent') { ?><div class="suc_msg" align="center">Your message has been sent successfully.</div><div class="spacer"></div><?php } if($_REQUEST[msg]=='error') { ?><div class="error_msg" align="center">Message sending failed.</div><div class="spacer"></div><?php } ?><div class="contactinnerfrm"><div class="contactcontxt">Name :</div><div class="contacttbcon"><input type="text" class="contacttb" id="name" name="name" /></div><div id="lbl_name"></div><div class="contactcontxt">Email Address</div><div class="contacttbcon"><input type="text" class="contacttb" id="email" name="email"/></div><div id="lbl_email"></div><div class="contactcontxt">Phone Number</div><div class="contacttbcon"><input type="text" class="contacttb" id="phone" name="phone" onKeyPress="return PhoneNo(event);" /></div><div id="lbl_phone"></div><div class="contactcontxt">Message</div><div class="contacttacon"><textarea class="contactta" id="message" name="message"></textarea></div><div id="lbl_message"></div><div class="spacer"></div><div class="spacer"></div><div align="center"><input type="image" src="images/submit.png" /></div><div class="spacer"></div></div></form></div><div class="spacer1"></div></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="contentsec1"><h1><?php echo $international['page_title'];?> <span><?php echo $international['page_title2'];?></span></h1><div class="contxt"><?php echo stripslashes($dbf->cut($international['content'],620));?><div class="spacer"></div><div align="right"><a href="readmore.php"><img src="images/readmoe.png" /></a></div><div class="spacer"></div><div class="spacer"></div></div></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
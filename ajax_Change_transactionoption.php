<?php
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

if($_SESSION['user_id']=='')
{
	header("location:index");
}

$memberTransactionID=$_REQUEST[memberTransactionID];
$option=$_REQUEST[option];

$membertransaction=$dbf->fetchSingle("member_transaction","id='$memberTransactionID'");
if($option=='View')
{
	header("Location:view_transaction_next?transactionid=$membertransaction[transaction_no]");exit;
}

if($option=='Modify')
{
	header("Location:edit_transaction?transactionid=$membertransaction[transaction_no]");exit;
}

if($option=='Cancel')
{
	$string="status='1'";
	
	$dbf->updateTable("member_transaction",$string,"id='$memberTransactionID'");
	header("Location:transactions?msg=added");
}

if($option=="Accept")
{
	$res_transaction=$dbf->fetchSingle("member_transaction","id='$memberTransactionID'");
	$mem_type=$res_transaction['roleof_member'];
	
	$res_member=$dbf->fetchSingle("members","id='$res_transaction[member_id]'");
	$member_email=$res_member['email'];
	
	if($mem_type=="Buyer"){
		$trans_name="Seller";
	}else{
		$trans_name="Buyer";
	}
	//Insert to 'member_transaction_status' Table=====================
	$string2="mem_transaction_id='$memberTransactionID',status='Transaction accepted by the $trans_name',post_date=now();";
	$dbf->insertSet("member_transaction_status",$string2);

	$res_admin=$dbf->fetchSingle("admin","id='1'");	
	$res_contact=$dbf->fetchSingle("contact","id='1'");
	$res_bankacmsg=$dbf->fetchSingle("bankac_message","id='1'");
	//******************************Member Mail Starts here************************************//
	if($mem_type=="Buyer"){
		$to=$member_email;
	}else{
		$to=$res_transaction['party_email'];
	}
	
	$from=$res_admin['email'];

	$headers = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=UTF-8\n";
	$headers .= "From:".$res_contact[domain_name]." <".$from.">\n";
	
	$body='<table width="666" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="15" colspan="3" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding-left:15px; color: #191919; font-weight: bold;">THIS E-MAIL IS PURELY FOR INFORMATION, YOU SHOULD VISIT THE TRANSACTION PAGE ON THE WEB SITE '.$res_admin[site_url].' TO CHECK THE PROGRESS OF YOUR TRANSACTION</td>
	  </tr>
	  <tr>
		<td align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
		<td height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
	  </tr>
	  <tr>
		<td width="9%" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
		<td width="91%" height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
	  </tr>
	  <tr>
		<td height="35" colspan="3" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:15px;" >Dear Buyer,</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="25" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#191919; font-weight: bold;"> '.$res_bankacmsg[bank_message].'</span></td>
	  </tr>
	  <tr>
		<td height="5" align="left" valign="top" >&nbsp;</td>
		<td height="5" colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">
		 More information can be found in our web pages:<br />
		 1) The FAQ  <a href="'.$res_admin[site_url].'/faq" target="_blank">'.$res_admin[site_url].'/faq</a><br />
		 2) The quick guide  <a href="'.$res_admin[site_url].'/guide" target="_blank">'.$res_admin[site_url].'/guide</a><br />
		 3) Our service terms  <a href="'.$res_admin[site_url].'/terms" target="_blank">'.$res_admin[site_url].'/terms</a>
		</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #191919; font-weight: bold;">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" valign="top" ></td>
		<td height="10" colspan="2" align="left" valign="top" ></td>
	  </tr>
	  <tr>
		<td align="left" valign="top" >&nbsp;</td>
		<td height="25" colspan="2" align="left" valign="top" style="padding-right:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #4B4B4B; font-weight: bold;">Thank you for choosing Transmith Group!<br />
			<br />
		Transmith Group Team<br />
		Email '.$res_contact[email].'<br />
		Home '.$res_admin[site_url].'<br />
		Fax  '.$res_contact[fax_no].' </span></td>
	  </tr>
	  <tr>
		<td align="left" valign="top" ></td>
		<td height="20" colspan="2" align="left" valign="top" ></td>
	  </tr>
	</table>';
	//mail( "someone@example.com", "Subject: $subject", $message, "From: $email" );
	$subject = 'Message from Transmith Group SafeDeal Service';
	//echo $body;exit;
	@mail($to,$subject,$body,$headers);
	//******************************Member Mail Ends here***************************************//
	
	//Insert to 'member_transaction_status' Table after transaction accepted by the party(buyer/seller)=====================
	$string2="mem_transaction_id='$memberTransactionID',status='$res_bankacmsg[bank_message]',post_date=now();";
	$dbf->insertSet("member_transaction_status",$string2);
	
	header("Location:transactions");exit;
}
?>
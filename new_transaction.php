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

if($_SESSION['user_id']=='')
{
	header("location:index");
}

//register
if($_REQUEST['action']=='add_transaction')
{
	$transaction_no=mt_rand(10000, 99999);
	$exist=$dbf->existsInTable("member_transaction","transaction_no='$transaction_no'");
	if($exist!=1)
	{
		//$transaction_no=mt_rand(10000, 99999);
		$member_id=$_SESSION['user_id'];
		$roleof_member=$_REQUEST['rolein_transaction'];
		$party_email=addslashes($_REQUEST['otherparty_email']);
		$party_language=addslashes($_REQUEST['party_language']);
		$transaction_originate=$_REQUEST['transaction_originate'];
		$brief_descr=addslashes($_REQUEST['brief_descr']);
		$currency=addslashes($_REQUEST['currency']);
		$goods=addslashes($_REQUEST['goods']);
		$quantity=addslashes($_REQUEST['quantity']);
		$description=addslashes($_REQUEST['description']);
		$unit_price=addslashes($_REQUEST['amount']);
		$total_price=addslashes($_REQUEST['total']);
		$inspection_period=addslashes($_REQUEST['inspection_period']);
		$safedeal_pay=addslashes($_REQUEST['safedeal_pay']);
		$postage_packing_cost=addslashes($_REQUEST['postage_packing_cost']);
		$postage_packing_pay=addslashes($_REQUEST['postage_packing_pay']);
		
		$tot_price=str_replace("," , "", $total_price);
		
		if($currency=="EUR" || $currency=="USD")
		{
			if($tot_price<=5000){
				$safedeal_fee=($tot_price/100)*2;
			}
			//Total Price is 5001 to 25000==========
			if($tot_price>=5001 AND $tot_price<=25000){
				$safedeal_fee=($tot_price/100)*1.5;
			}
			//Total Price is 25001 to 250000==========
			if($tot_price>=25001 AND $tot_price<=250000){
				$safedeal_fee=($tot_price/100)*1;
			}
			//Total Price is 250001 to 500000==========
			if($tot_price>=250001 AND $tot_price<=500000){
				$safedeal_fee=($tot_price/100)*0.85;
			}
			//Total Price is above 500000==============
			if($tot_price>500000){
				$safedeal_fee=($tot_price/100)*0.65;
			}
		}
		
		else if($currency=="GBP")
		{
			if($tot_price<=3500){
				$safedeal_fee=($tot_price/100)*2;
			}
			//Total Price is 3501 to 17000==========
			if($tot_price>=3501 AND $tot_price<=17000){
				$safedeal_fee=($tot_price/100)*1.5;
			}
			//Total Price is 17001 to 176000==========
			if($tot_price>=17001 AND $tot_price<=176000){
				$safedeal_fee=($tot_price/100)*1;
			}
			//Total Price is 176001 to 352000==========
			if($tot_price>=176001 AND $tot_price<=352000){
				$safedeal_fee=($tot_price/100)*0.85;
			}
			//Total Price is above 352000==============
			if($tot_price>352000){
				$safedeal_fee=($tot_price/100)*0.65;
			}
		}
		
		
		$banks_cost=round($tot_price/100);
		$total_debit=round($tot_price-$safedeal_fee);
		$payment="No payments made.";
		$balance=$total_debit;
		
		$dated=date("Y-m-d");
		
		//Insert data to member_transaction Table=========================
		$string="transaction_no='$transaction_no',member_id='$member_id',roleof_member='$roleof_member',party_email='$party_email',party_language='$party_language',transaction_originate='$transaction_originate',brief_descr='$brief_descr',currency='$currency',goods='$goods',quantity='$quantity',description='$description',unit_price='$unit_price',total_price='$total_price',inspection_period='$inspection_period',safedeal_pay='$safedeal_pay',postage_packing_cost='$postage_packing_cost',postage_packing_pay='$postage_packing_pay',safedeal_fee='$safedeal_fee',banks_cost='$banks_cost',total_debit='$total_debit',payment='$payment',balance='$balance',created_date='$dated'";
		
		$ins_id=$dbf->insertSet("member_transaction",$string);
		
		if($roleof_member=="Seller"){
			$trans_name="Buyer";
		}else{
			$trans_name="Seller";
		}
		//Insert data to member_transaction_status Table==================
		$string="mem_transaction_id='$ins_id',status='Awaiting confirmation from the $trans_name',post_date=now();";
		$dbf->insertSet("member_transaction_status",$string);
		
		
		//############################### Mail Section Starts here ###########################
		if($ins_id!='')
		{	
			$member_transaction=$dbf->fetchSingle("member_transaction","id='$ins_id'");
			$member=$dbf->fetchSingle("members","id='$_SESSION[user_id]'");
			//Fetch Single Data From Admin
			$res_admin=$dbf->fetchSingle("admin","id='1'");
			$res_contact=$dbf->fetchSingle("contact","id='1'");
			//For Image Path
			$imgPath=$res_admin[site_url]."/images/logo.png";
			
			if($member_transaction[roleof_member]=="Buyer")
			{
				//******************************Buyer Mail Starts here**************************************//	
				$to=$member['email'];
				$from=$member_transaction['party_email'];
							
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:".$res_contact[domain_name]." <".$from.">\n";
				
				$body='<table width="666" height="715" border="0" align="center" cellpadding="0" cellspacing="0">
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
					<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#191919; font-weight: bold;"> We have informed the Seller '.$from.' that you have opened a transaction with Transmith Group!
	The transaction identification number is '.$member_transaction[transaction_no].', as follows:</span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" >
						<table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #4B4B4B;">
						  <tr>
							<td width="16" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">&nbsp;</td>
							<td width="482" height="25" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[transaction_no].'</span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Description : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[brief_descr].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Currency : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[currency].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Purchasing price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[total_price].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the SafeDeal service : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[safedeal_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_cost].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Inspection Period : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[inspection_period].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Way of paying : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">Bank Transfer</span></span></td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
					<td height="10" align="left" valign="top" >&nbsp;</td>
					<td height="10" colspan="2" align="left" valign="top" >&nbsp;</td>
	  			</tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">We are waiting for the Seller to accept or modify the transaction, as soon as we have been notified of the Sellers decisions we will give you further instructions in an e-mail informing you how to proceed.</td>
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
					<td height="25" colspan="2" align="left" valign="top" style="padding-right:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #4B4B4B; font-weight: bold;">Thank you for choosing Transmith Group !<br />
						<br />
					Transmith Group Team<br />
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
				//******************************Buyer Mail Ends here*****************************************//
			
			
				//******************************Seller Mail Starts here**************************************//	
				$to1=$member_transaction['party_email'];
				$from1=$member['email'];
							
				$headers1 = "MIME-Version: 1.0\n";
				$headers1 .= "Content-type: text/html; charset=UTF-8\n";
				$headers1 .= "From:".$res_contact[domain_name]." <".$from1.">\n";
				
				$body1='<table width="666" height="715" border="0" align="center" cellpadding="0" cellspacing="0">
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
					<td height="35" colspan="3" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:15px;" >Dear Seller,</td>
		  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#191919; font-weight: bold;"> The Buyer '.$from1.' is interested in exchanging the goods described below using Transmith Group!.<br/>
	The Buyer has set up an Transmith Group! transaction which you can examine. The transaction identification number is '.$member_transaction[transaction_no].', as follows:</span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" >
						<table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #4B4B4B;">
						  <tr>
							<td width="16" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">&nbsp;</td>
							<td width="482" height="25" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[transaction_no].'</span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Description : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[brief_descr].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Currency : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[currency].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Purchasing price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[total_price].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the SafeDeal service : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[safedeal_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_cost].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Inspection Period : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[inspection_period].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Way of paying : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">Bank Transfer</span></span></td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
					<td height="10" align="left" valign="top" >&nbsp;</td>
					<td height="10" colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">If you accept this transaction you must register with Transmith Group, registration is easy and free. To register with our service please open the web page '.$res_admin[site_url].' and register with this email address.<br/>
	When you are registered you can enter in your transaction page. At the bottom of the page you can find a menu command that will allow you to accept, to modify or to cancel the transaction.</td>
				  </tr>
				  <tr>
					<td height="5" align="left" valign="top" >&nbsp;</td>
					<td height="5" colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">More information can be found in our web pages:<br />
	 1) The FAQ  <a href="'.$res_admin[site_url].'/faq" target="_blank">'.$res_admin[site_url].'/faq</a><br />
	 2) The quick guide  <a href="'.$res_admin[site_url].'/guide" target="_blank">'.$res_admin[site_url].'/guide</a><br />
	 3) Our service terms  <a href="'.$res_admin[site_url].'/terms" target="_blank">'.$res_admin[site_url].'/terms</a><br />
	 <br />
	 Please inform the Buyer '.$from1.' in an e-mail of your decision if you do not accept this transaction. </td>
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
	Transmith Group Team<br />
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
				$subject1 = 'Message from Transmith Group SafeDeal Service';
				//echo $body1;exit;
				@mail($to1,$subject1,$body1,$headers1);
				//******************************Seller Mail Ends here****************************************//
			}
			
			
			if($member_transaction[roleof_member]=="Seller")
			{
				//******************************Seller Mail Starts here**************************************//	
				$to=$member['email'];
				$from=$member_transaction['party_email'];
							
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:".$res_contact[domain_name]." <".$from.">\n";
				
				$body='<table width="666" height="715" border="0" align="center" cellpadding="0" cellspacing="0">
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
					<td height="35" colspan="3" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:15px;" >Dear Seller,</td>
		  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#191919; font-weight: bold;"> We have informed the Buyer '.$from.' that you have opened a transaction with Transmith Group!
	The transaction identification number is '.$member_transaction[transaction_no].', as follows:</span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" >
						<table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #4B4B4B;">
						  <tr>
							<td width="16" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">&nbsp;</td>
							<td width="482" height="25" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[transaction_no].'</span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Description : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[brief_descr].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Currency : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[currency].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Purchasing price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[total_price].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the SafeDeal service : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[safedeal_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_cost].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Inspection Period : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[inspection_period].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Way of paying : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">Bank Transfer</span></span></td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
					<td height="10" align="left" valign="top" >&nbsp;</td>
					<td height="10" colspan="2" align="left" valign="top" >&nbsp;</td>
	  			</tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">We are waiting for the Seller to accept or modify the transaction, as soon as we have been notified of the Sellers decisions we will give you further instructions in an e-mail informing you how to proceed.</td>
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
					Transmith Group Team<br />
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
				//******************************Seller Mail Ends here****************************************//
			
			
				//******************************Buyer Mail Starts here***************************************//	
				$to1=$member_transaction['party_email'];
				$from1=$member['email'];
							
				$headers1 = "MIME-Version: 1.0\n";
				$headers1 .= "Content-type: text/html; charset=UTF-8\n";
				$headers1 .= "From:".$res_contact[domain_name]." <".$from1.">\n";
				
				$body1='<table width="666" height="715" border="0" align="center" cellpadding="0" cellspacing="0">
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
					<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color:#191919; font-weight: bold;"> The Seller '.$from1.' is interested in exchanging the goods described below using Transmith Group!.<br/>
	The Seller has set up an Transmith Group! transaction which you can examine. The transaction identification number is '.$member_transaction[transaction_no].', as follows:</span></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" >
						<table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #4B4B4B;">
						  <tr>
							<td width="16" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">&nbsp;</td>
							<td width="482" height="25" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Transaction ID : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[transaction_no].'</span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Description : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[brief_descr].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Currency : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[currency].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Purchasing price : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[total_price].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the SafeDeal service : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[safedeal_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_cost].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Who pays the Postage and package costs : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[postage_packing_pay].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Inspection Period : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">'.$member_transaction[inspection_period].'</span></span></td>
						  </tr>
						  <tr>
							<td align="left" valign="middle">&nbsp;</td>
							<td height="25" align="left" valign="middle"><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#191919; font-weight: bold;">Way of paying : <span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color:#4B4B4B; font-weight: bold;">Bank Transfer</span></span></td>
						  </tr>
						</table>
					</td>
				  </tr>
				  <tr>
					<td height="10" align="left" valign="top" >&nbsp;</td>
					<td height="10" colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="35" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">If you accept this transaction you must register with Transmith Group, registration is easy and free. To register with our service please open the web page '.$res_admin[site_url].' and register with this email address.<br/>
	When you are registered you can enter in your transaction page. At the bottom of the page you can find a menu command that will allow you to accept, to modify or to cancel the transaction.</td>
				  </tr>
				  <tr>
					<td height="5" align="left" valign="top" >&nbsp;</td>
					<td height="5" colspan="2" align="left" valign="top" >&nbsp;</td>
	  </tr>
				  <tr>
					<td align="left" valign="top" >&nbsp;</td>
					<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">More information can be found in our web pages:<br />
	 1) The FAQ  <a href="'.$res_admin[site_url].'/faq" target="_blank">'.$res_admin[site_url].'/faq</a><br />
	 2) The quick guide  <a href="'.$res_admin[site_url].'/guide" target="_blank">'.$res_admin[site_url].'/guide</a><br />
	 3) Our service terms  <a href="'.$res_admin[site_url].'/terms" target="_blank">'.$res_admin[site_url].'/terms</a><br />
	 <br />
	 Please inform the Seller '.$from1.' in an e-mail of your decision if you do not accept this transaction. </td>
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
					Transmith Group Team<br />
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
				$subject1 = 'Message from Transmith Group SafeDeal Service';
				//echo $body1;exit;
				@mail($to1,$subject1,$body1,$headers1);
				//******************************Buyer Mail Ends here****************************************//
			}
		
		}
		//############################### Mail Section Ends here #############################	
		header("location:new_transaction_next?transactionid=$member_transaction[transaction_no]");
	}
	else
	{
		header("location:new_transaction?msg=exist");
	}
}
?>
<script language="Javascript" src="js/calculations.js"></script><script language="Javascript" src="ajax_opensafedeal.js"></script><body><?php include 'header.php'; ?><nav><div class="menubar"><?php include 'menu.php'; ?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php'; ?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec"> <h1>Starts a New <span>Transaction</span></h1> <div class="spacer1"></div> <div class="contxt"><strong>The obligatory points are marked with </strong> <span>*</span> </div> <div class="spacer2"></div> <form name="add_transaction_frm" id="add_transaction_frm" action="new_transaction" method="post" onSubmit="return validate_transaction();"> <input type="hidden" id="action" name="action" value="add_transaction"/> <div class="resisterdiv"> <?php if($_REQUEST[msg]=='success') { ?> <div class="suc_msg" align="center">Registration successfully completed.</div> <div class="spacer"></div> <?php } ?> <?php if($_REQUEST[msg]=='exist') { ?> <div class="error_msg" align="center">Email address already exist.</div> <div class="spacer"></div> <?php } ?> <div><h3>Information on the Buyer/Seller </h3></div> <div class="spacer"></div> <div class="memlogintxt">What will your role be in the transaction? <span>*</span></div> <div class="memlogintxt"> <input type="radio" name="rolein_transaction" value="Seller" id="rolein_transaction" />Seller <input type="radio" name="rolein_transaction" value="Buyer" id="rolein_transaction" checked="checked" />Buyer </div> <div class="spacer"></div> <div class="memlogintxt">What is the other party's e-mail address? <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="otherparty_email" autocomplete="off" name="otherparty_email" /></div> <div id="lbl_otherparty_email"></div> <div class="spacer"></div> <div class="memlogintxt">What is the other party's primary language? </div> <div class="memlogintbcon"> <select class="memlogintb" id="party_language" name="party_language"> <option value="SQ">Albanian</option> <option value="AR">Arabic</option> <option value="BG">Bulgarian</option> <option value="CA">Catalan</option> <option value="ZH-CN">Chinese</option> <option value="HR">Croatian</option> <option value="CS">Czech</option> <option value="DA">Danish</option> <option value="NL">Dutch</option> <option value="EN" selected>English</option> <option value="ET">Estonian</option> <option value="TL">Filipino</option> <option value="FI">Finnish</option> <option value="FR">French</option> <option value="GL">Galician</option> <option value="DE">German</option> <option value="EL">Greek</option> <option value="IW">Hebrew</option> <option value="HI">Hindi</option> <option value="HU">Hungarian</option> <option value="ID">Indonesian</option> <option value="IT">Italian</option> <option value="JA">Japanese</option> <option value="KO">Korean</option> <option value="LV">Latvian</option> <option value="LT">Lithuanian</option> <option value="MT">Maltese</option> <option value="NO">Norwegian</option> <option value="PL">Polish</option> <option value="PT">Portuguese</option> <option value="RO">Romanian</option> <option value="RU">Russian</option> <option value="SR">Serbian</option> <option value="SK">Slovak</option> <option value="SL">Slovenian</option> <option value="ES">Spanish</option> <option value="SV">Swedish</option> <option value="TH">Thai</option> <option value="TR">Turkish</option> <option value="UK">Ukrainian</option> <option value="VI">Vietnamese</option> </select> </div> <div class="spacer"></div> <div class="memlogintxt">Where did the transaction originate? <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="transaction_originate" name="transaction_originate"> <option value="">-- Select from the list --</option> <?php foreach($dbf->fetch('transaction_originate',"","originate_from","","ASC") as $res_transactionorig) {?> <option value="<?php echo $res_transactionorig[id];?>"><?php echo $res_transactionorig[originate_from];?></option> <?php } ?> </select> </div> <div id="lbl_transaction_originate"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Transaction details</h3></div> <div class="spacer"></div> <div>Refer to the <a href="terms">Service Terms</a> for a detailed list of the goods which are not possible for this transaction.</div> <div class="spacer"></div> <div class="memlogintxt">Brief description (Max 50 Character) : <span>*</span></div> <div class="memlogintbcon"> <input type="text" class="memlogintb" id="brief_descr" name="brief_descr" maxlength="50"/> </div> <div id="lbl_brief_descr"></div> <div>(Example : Audi car, Yamaha motorcyle, Sony-Vaio Laptop")</div> <div class="spacer1"></div> <div class="spacer"></div> <div>The chart bellow serves to specify the contense of an individual postage. Make more transactions for goods which have to be sent separately. Do not add SafeDeal's service fee, it will be automatically calculated and added to the transaction. <strong>To see SafeDeal fee</strong> <a href="javascript:void(0);" onClick="fancy_safedeal();">click here</a></div> <div class="spacer1"></div> <div class="memlogintxt">Currency <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="currency" name="currency"> <option value="EUR">EUR</option> <option value="USD">USD</option> <option value="GBP">GBP</option> </select> </div> <div class="spacer1"></div> <div class="spacer"></div> <div> <!--Responsive table Starts here------------------------> <div class="table"> <div class="table-head"> <div class="column" data-label="Goods" style="width:23%;">Goods</div> <div class="column" data-label="Qantity" style="width:10%;">Qantity</div> <div class="column" data-label="Description" style="width:41%;">Description</div> <div class="column" data-label="Unit Price" style="width:13%;">Unit Price</div> <div class="column" data-label="Total Price" style="width:13%;">Total Price</div> </div> <div class="row"> <div class="column" data-label="Goods"><input type="text" style="width:100%;" name="goods" id="goods"></div> <div class="column" data-label="Qantity"><input type="text" style="width:100%; text-align:center;" value="1" maxlength="3" name="quantity" id="quantity" onKeyUp="javascript:doTotalsCalc(form);calcfee(form);"></div> <div class="column" data-label="Description"><input type="text" style="width:100%;" name="description" maxlength="99" id="description"></div> <div class="column" data-label="Unit Price"><input type="text" style="width:100%;" name="amount" id="amount" onKeyUp="javascript:doTotalsCalc(form);calcfee(form);" onBlur="this.value=trim(this.value);doTotalsCalc(form);calcfee(form);"></div> <div class="column" data-label="Total Price"><input type="text" style="width:100%;" name="total" readonly="readonly" id="total" onBlur="doTotalsCalc(form);"></div> </div> </div> <!--Responsive table Ends here--------------------------> </div> <div id="lbl_company"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Inspection period and cost </h3></div> <div class="spacer1"></div> <div class="memlogintxt">Length of the Inspection period (in days): <span>*</span></div> <div class="memlogintbcon"> <input type="text" class="memlogintb" value="3" id="inspection_period" name="inspection_period" /> </div> <div id="lbl_inspection_period"></div> <div class="spacer1"></div> <div class="memlogintxt">Who pays for the SafeDeal service ? <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="safedeal_pay" name="safedeal_pay"> <option value="Buyer">Buyer</option> <option value="Seller">Seller</option> <option value="Both Parties">Both Parties</option> </select> </div> <div id="lbl_payment_opt"></div> <div class="spacer1"></div> <div class="memlogintxt">Postage and packing cost : <span>*</span></div> <div class="memlogintbcon"> <input type="text" class="memlogintb" value="0" id="postage_packing_cost" name="postage_packing_cost" /> </div> <div id="lbl_postage_packing_cost"></div> <div class="spacer1"></div> <div class="memlogintxt">Who pays for the postage and packing : <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="postage_packing_pay" name="postage_packing_pay"> <option value="Buyer">Buyer</option> <option value="Seller">Seller</option> </select> </div> <div id="lbl_payment_opt"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div align="center"><input type="image"src="images/register.png" /></div> <div class="spacer1"></div> <div class="spacer1"></div> </div> </form> <div class="spacer1"></div> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php');?></footer></body></html>
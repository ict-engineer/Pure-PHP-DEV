<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Add Tracking Number';
include 'application_top.php';

//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

$res_admin=$dbf->fetchSingle("admin","id='1'");

$trackid=base64_decode(base64_decode($_REQUEST[instid]));
$res_trackinfo=$dbf->fetchSingle("tracking_system","id='$trackid'");

//Fetch data for Vehicle Inspection Report==========================
$res_vir_report=$dbf->fetchSingle("tracking_system_vehicle_report","tracking_system_id='$res_trackinfo[id]'");

//Fetch data for Bill of Lading Report==============================
$res_bil_report=$dbf->fetchSingle("tracking_system_billof_lading","tracking_system_id='$res_trackinfo[id]'");

//Fetch data for Invoice Report=====================================
$res_invoice_report=$dbf->fetchSingle("tracking_system_invoice","tracking_system_id='$res_trackinfo[id]'");

//For Barcode======================
include '../barcode/Code128.php';
$code = isset($_GET['code']) ? $_GET['code'] :$res_trackinfo[tracking_no]; 
//For Barcode======================

if(isset($_POST[submit])<>'')
{	
	$dated=date("Y-m-d");
	
	$my_comment=addslashes($_POST[my_comment]);
	$tracking_no=addslashes($_POST[trackingnumber]);
	$shippers_ref=addslashes($_POST[shippers_ref]);
	$pickup_agent=addslashes($_POST[pickup_agent]);
	$delivery_agent=addslashes($_POST[delivery_agent]);
	$from_name=addslashes(strtoupper($_POST[from_name]));
	$from_address=addslashes(strtoupper($_POST[from_address]));
	$from_city=addslashes(strtoupper($_POST[from_city]));
	$from_state=addslashes(strtoupper($_POST[from_state]));
	$from_zip=addslashes(strtoupper($_POST[from_zip]));
	$from_country=addslashes(strtoupper($_POST[from_country]));
	$to_name=addslashes(strtoupper($_POST[to_name]));
	$to_address=addslashes(strtoupper($_POST[to_address]));
	$to_city=addslashes(strtoupper($_POST[to_city]));
	$to_state=addslashes(strtoupper($_POST[to_state]));
	$to_zip=addslashes(strtoupper($_POST[to_zip]));
	$to_country=addslashes(strtoupper($_POST[to_country]));
	$partof_your_email_transactionid=addslashes($_POST[partof_your_email_transactionid]);
	$package_description=addslashes(strtoupper($_POST[package_description]));
	$package_weight=addslashes(strtoupper($_POST[package_weight]));
	$package_insurance=addslashes(strtoupper($_POST[package_insurance]));
	$package_contents=addslashes(strtoupper($_POST[package_contents]));
	$shippersid_type=addslashes(strtoupper($_POST[shippersid_type]));
	$shippersid_no=addslashes($_POST[shippersid_no]);
	$package_status_route_descr=addslashes(strtoupper($_POST[package_status_route_descr]));
	$route_location=addslashes(strtoupper($_POST[currentloc]));
	
	
	$trackid=base64_decode(base64_decode($_REQUEST[instid]));
	
	if($_FILES['sri']['name']!='') {
	//Upload upload_route Starts here====================
		$path="../upload_route/";
		$route_name=time()."_".$_FILES['sri']['name'];
		move_uploaded_file($_FILES['sri']['tmp_name'],$path.$route_name);
		
		$upload_route=$route_name;

		//For unlink the existing upload_route
		$unlink_route=$dbf->fetchSingle("tracking_system","id='$trackid'");
		$path="../upload_route/".$unlink_route[upload_route];
		unlink($path);
	//Upload upload_route ends here======================
	}
	
	if($_FILES['pof']['name']!=''){
	//Upload proof_of_transfer Starts here===============
		$path1="../proof_of_transfer/";
		$proof_of_transfer=time()."_".$_FILES['pof']['name'];
		move_uploaded_file($_FILES['pof']['tmp_name'],$path1.$proof_of_transfer);
		
		$proof_of_transfer=$proof_of_transfer;
		
		//For unlink the existing proof_of_transfer
		$unlink_route=$dbf->fetchSingle("tracking_system","id='$trackid'");
		$path="../proof_of_transfer/".$unlink_route[proof_of_transfer];
		unlink($path);
	//Upload proof_of_transfer ends here=================
	}
	
	if($_FILES['pof']['name']!='') 
	{
		$string="my_comment='$my_comment',tracking_no='$tracking_no',shippers_ref='$shippers_ref',pickup_agent='$pickup_agent',pickup_date='$_POST[pickup_date]',delivery_agent='$delivery_agent',delivery_date='$_POST[delivery_date]',from_name='$from_name',from_address='$from_address',from_city='$from_city',from_state='$from_state',from_zip='$from_zip',from_country='$from_country',to_name='$to_name',to_address='$to_address',to_city='$to_city',to_state='$to_state',to_zip='$to_zip',to_country='$to_country',partof_your_email_transactionid='$partof_your_email_transactionid',package_description='$package_description',package_weight='$package_weight',package_insurance='$package_insurance',package_contents='$package_contents',shippersid_type='$shippersid_type',shippersid_no='$shippersid_no',package_status_route_descr='$package_status_route_descr',package_status='$_POST[showphoto]',upload_route='$upload_route',route_location='$route_location',proof_of_transfer='$proof_of_transfer',active_status='$_POST[active_status]',updated_date='$dated'";

	}
	else if($_FILES['sri']['name']!='') 
	{
		$string="my_comment='$my_comment',tracking_no='$tracking_no',shippers_ref='$shippers_ref',pickup_agent='$pickup_agent',pickup_date='$_POST[pickup_date]',delivery_agent='$delivery_agent',delivery_date='$_POST[delivery_date]',from_name='$from_name',from_address='$from_address',from_city='$from_city',from_state='$from_state',from_zip='$from_zip',from_country='$from_country',to_name='$to_name',to_address='$to_address',to_city='$to_city',to_state='$to_state',to_zip='$to_zip',to_country='$to_country',partof_your_email_transactionid='$partof_your_email_transactionid',package_description='$package_description',package_weight='$package_weight',package_insurance='$package_insurance',package_contents='$package_contents',shippersid_type='$shippersid_type',shippersid_no='$shippersid_no',package_status_route_descr='$package_status_route_descr',package_status='$_POST[showphoto]',route_location='$route_location',upload_route='$upload_route',proof_of_transfer='$proof_of_transfer',active_status='$_POST[active_status]',updated_date='$dated'";
	
	}
	else
	{
		$string="my_comment='$my_comment',tracking_no='$tracking_no',shippers_ref='$shippers_ref',pickup_agent='$pickup_agent',pickup_date='$_POST[pickup_date]',delivery_agent='$delivery_agent',delivery_date='$_POST[delivery_date]',from_name='$from_name',from_address='$from_address',from_city='$from_city',from_state='$from_state',from_zip='$from_zip',from_country='$from_country',to_name='$to_name',to_address='$to_address',to_city='$to_city',to_state='$to_state',to_zip='$to_zip',to_country='$to_country',partof_your_email_transactionid='$partof_your_email_transactionid',package_description='$package_description',package_weight='$package_weight',package_insurance='$package_insurance',package_contents='$package_contents',shippersid_type='$shippersid_type',shippersid_no='$shippersid_no',package_status_route_descr='$package_status_route_descr',package_status='$_POST[showphoto]',route_location='$route_location',active_status='$_POST[active_status]',updated_date='$dated'";
	}

	$dbf->updateTable("tracking_system",$string,"id='$trackid'");
	
	//For Updating Vehicle Inspection Details=======================================
	  if($_FILES['vir']['name']!='') {
		$path="../vehicle_report/";
		$virreport_name=time()."_".$_FILES['vir']['name'];
		move_uploaded_file($_FILES['vir']['tmp_name'],$path.$virreport_name);
		
		$vir_report=$virreport_name;

		//For unlink the existing vehicle_report
		$unlink_vir=$dbf->fetchSingle("tracking_system_vehicle_report","tracking_system_id='$trackid'");
		$path="../vehicle_report/".$unlink_vir[uploaded_report];
		unlink($path);
	  }
	
	  if($_FILES['vir']['name']!='') 
	  {
	  	$string2="uploaded_report='$vir_report',inspection_date='$_POST[virdateinspection]',make_model='$_POST[virmakemodel]',year='$_POST[viryear]',millage='$_POST[virodometer]',power='$_POST[virpower]',transmission='$_POST[virtransmission]',fuel='$_POST[virfuel]',inspected_by='$_REQUEST[virinspectedby]'";
	  }
	  else
	  {
	  	$string2="inspection_date='$_POST[virdateinspection]',make_model='$_POST[virmakemodel]',year='$_POST[viryear]',millage='$_POST[virodometer]',power='$_POST[virpower]',transmission='$_POST[virtransmission]',fuel='$_POST[virfuel]',inspected_by='$_REQUEST[virinspectedby]'";
	  }
	  $dbf->updateTable("tracking_system_vehicle_report",$string2,"tracking_system_id='$trackid'");
	//For Updating Vehicle Inspection Details=======================================
	
	
	//For Updating Bill of Lading Details===========================================
	  if($_FILES['bol']['name']!='') {
		$path="../billoflading_report/";
		$billoflading_name=time()."_".$_FILES['bol']['name'];
		move_uploaded_file($_FILES['bol']['tmp_name'],$path.$billoflading_name);
		
		$billoflading=$billoflading_name;
		
		//For unlink the existing billoflading_report
		$unlink_bol=$dbf->fetchSingle("tracking_system_billof_lading","tracking_system_id='$trackid'");
		$path="../billoflading_report/".$unlink_bol[uploaded_lading];
		unlink($path);
	  }
	  
	  if($_FILES['bol']['name']!='') 
	  {
	  	$string3="uploaded_lading='$billoflading',dateof_bill='$_POST[boldatebol]',make_model='$_POST[bolmakemodel]',shipping_fee='$_POST[bolshippingfee]',price='$_POST[bolprice]'";
	  }
	  else
	  {
		$string3="dateof_bill='$_POST[boldatebol]',make_model='$_POST[bolmakemodel]',shipping_fee='$_POST[bolshippingfee]',price='$_POST[bolprice]'";
	  }
	  
	  $dbf->updateTable("tracking_system_billof_lading",$string3,"tracking_system_id='$trackid'");
	  
	  //Update bill of lading signature from admin***************************
	  if($_REQUEST[bolsignature]!='' && $_REQUEST[bolsignature]!="Type here to change")
	  {
		  $billof_lading_signature=addslashes($_POST[bolsignature]);
		  
		  $string_admin="billof_lading_signature='$billof_lading_signature',billof_lading_signature_font='$_POST[bolfont]',billof_lading_font_size='$_POST[billof_lading_font_size]'";
		  $dbf->updateTable("admin",$string_admin,"id='1'");
	  }
	
	//For Updating Bill of Lading Details===========================================
	
	
	//For Updating Invoice Details==================================================
	  if($_FILES['invoice']['name']!='') {
		$path="../invoice_report/";
		$invoice_name=time()."_".$_FILES['invoice']['name'];
		move_uploaded_file($_FILES['invoice']['tmp_name'],$path.$invoice_name);
		
		$uploaded_invoice=$invoice_name;
		
		//For unlink the existing vehicle_report
		$unlink_invoice=$dbf->fetchSingle("tracking_system_invoice","tracking_system_id='$trackid'");
		$path="../invoice_report/".$unlink_invoice[uploaded_invoice];
		unlink($path);
	  }
	  
	  if($_FILES['invoice']['name']!='')
	  {
	  	$string4="uploaded_invoice='$uploaded_invoice',dateof_invoice='$_POST[invinvoicedate]',make_model='$_POST[invmakemodel]',shipping_fee='$_POST[invshippingfee]',price='$_POST[invprice]',currency='$_POST[currency]',percent_deposite='$_POST[invdepositpercent]',payment_profile='$_POST[paymentprofile]',previous_invoice='$_POST[greedyinv]',tot_paid_until_now='$_POST[greedypaid]',additional_amount='$_POST[greedyvalue]'";
	  }
	  else
	  {
		 $string4="dateof_invoice='$_POST[invinvoicedate]',make_model='$_POST[invmakemodel]',shipping_fee='$_POST[invshippingfee]',price='$_POST[invprice]',currency='$_POST[currency]',percent_deposite='$_POST[invdepositpercent]',payment_profile='$_POST[paymentprofile]',previous_invoice='$_POST[greedyinv]',tot_paid_until_now='$_POST[greedypaid]',additional_amount='$_POST[greedyvalue]'";
	  }
	
	  $dbf->updateTable("tracking_system_invoice",$string4,"tracking_system_id='$trackid'");
	//For Updating Invoice Details==================================================
	
	
	$trckid=base64_encode(base64_encode($trackid));
	header("Location:next_add_tracking_number.php?msg=added&instid=$trckid");
}
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<script>
//For Vehicle Inspection Detail========================
function viropen(){
	var a = document.createElement('a');
	a.href='vehicle_inspection_report.php?vir_report=<?php echo base64_encode(base64_encode($res_vir_report[id]));?>';
	a.target = '_blank';
	document.body.appendChild(a);
	a.click();	
}

//For Bill of Lading Detail============================
function bilopen(){
	var a = document.createElement('a');
	a.href='billof_lading_report.php?bil_report=<?php echo base64_encode(base64_encode($res_bil_report[id]));?>';
	a.target = '_blank';
	document.body.appendChild(a);
	a.click();	
}

//For Invoice Detail===================================
function invoiceopen(){
	var a = document.createElement('a');
	a.href='invoice_report.php?inv_report=<?php echo base64_encode(base64_encode($res_bil_report[id]));?>';
	a.target = '_blank';
	document.body.appendChild(a);
	a.click();	
}
</script>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" height="116"><?php include 'header.php'; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="3" align="left" valign="top"></td>
            </tr>
          <tr>
            <td width="226" align="left" valign="top" height="365"><?php include 'left.php';?></td>
            <td width="10">&nbsp;</td>
            <td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="10" align="left" valign="top"><img src="images/leftbox-bg.jpg" alt="leftboxbg" width="10" height="38" /></td>
                      <td class="midboxbg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="50%" align="left" valign="middle"><h2>Add Tracking Number</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_tracking_number.php" class="linkButton">BACK</a></h2></td>
                        </tr>
                      </table></td>
                      <td width="10" align="right" valign="top"><img src="images/rightbox-bg.jpg" alt="rightboxbg" width="10" height="38" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" bgcolor="#e2e2e2" height="320">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="righttableborder2">
                  <tr>
                    <td bgcolor="#e2e2e2">
					<form action="" method="post" id="frm" name="frm" enctype="multipart/form-data">
                      <table width="100%" height="191" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:10px;">
						<?php 
						  if($_REQUEST[msg]=='added') {
						?>
						<tr>
						  <td height="10" align="left" class="headingtext"></td>
						  <td width="869" height="10" colspan="3" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="30" align="left" class="headingtext">&nbsp;</td>
						  <td height="30" colspan="3" align="left" valign="middle" class="success">Record  has been saved successfully. </td>
						</tr>
						<?php } ?>
						<tr>
						  <td height="15" align="left" class="headingtext"></td>
						  <td height="15" colspan="3" align="left" valign="middle"></td>
						  </tr>
						<tr>
						  <td height="15" align="left" class="headingtext"></td>
						  <td height="25" colspan="3" align="left" valign="middle" class="text1">My Comment : &nbsp;<input name="my_comment" value="<?php echo $res_trackinfo[my_comment];?>" type="text" class="textfield121" id="my_comment"></td>
						</tr>
						<tr>
						  <td height="5" align="left" class="headingtext"></td>
						  <td height="5" colspan="3" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="15" align="left" class="headingtext">&nbsp;</td>
						  <td height="35" colspan="3" align="left" valign="middle">
                            <a style="cursor:pointer;" onClick="showtrackinginfo();">
                            <table width="222" border="0" cellspacing="0" cellpadding="0">
						      <tr>
						        <td width="23" align="left" valign="middle"><img id="trackinginfobtn" border="0" src="images/minus-sign.png" width="16" height="16"></td>
						        <td width="199" align="left" valign="middle" class="text_header">TRACKING INFORMATION</td>
						      </tr>
						    </table></a>
                          </td>
						</tr>
                        <tr>
                          <td height="5" align="left" class="headingtext"></td>
                          <td height="5" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext"></td>
                          <td colspan="3" align="left" valign="middle">
                          <table width="98%" border="0" cellspacing="0" cellpadding="0" id="trackinginfoplm" style="display:''; border:solid 1px #CCC; padding:5px; border-radius:5px; -moz-border-radius:5px;">
                            <tr>
                              <td width="49%" height="25" align="left" valign="middle" class="text1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="22%" height="25" align="left" valign="middle" class="text1">Tracking Number : </td>
                                  <td width="78%" height="25" align="left" valign="middle">
                                  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <input value="" name="alltrackingnumbers" id="alltrackingnumbers" type="hidden">
                                      <tr>
                                        <td width="57%" align="left" valign="middle"><input name="trackingnumber" type="text" value="<?php echo $res_trackinfo[tracking_no];?>" class="textfield2" id="trackingnumber" alt="If modified, a copy of the old tracking will be created (But without photos)." title="If modified, a copy of the old tracking will be created. (But without photos)"></td>
                                        <td width="43%" align="left" valign="middle" class="text1"><input name="generatenumber" value="+" onClick="javascript:generatenr(this.form);" class="src_button" type="button"></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                </table></td>
                              <td align="left" valign="middle" class="text1">&nbsp;</td>
                              <td width="49%" height="25" align="left" valign="middle" class="text1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="25%" height="25" align="left" valign="middle" class="text1">Shipper's Reference : </td>
                                  <td width="75%" height="25" align="left" valign="middle"><input name="shippers_ref" value="<?php echo $res_trackinfo[shippers_ref];?>" type="text" class="textfield2" id="shippers_ref"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="8" align="center"><?php echo draw($code);?></td>
                              <td></td>
                              <td height="8" align="center"><img src="../images/qrcode.png"></td>
                            </tr>
                            <tr class="text25">
                              <td height="30">PICK-UP INFORMATION</td>
                              <td>&nbsp;</td>
                              <td height="30">DELIVERY INFORMATION</td>
                            </tr>
                            <tr class="text25">
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Agent : </td>
                                  <td height="28" align="left" valign="middle"><input name="pickup_agent" value="<?php echo $res_trackinfo[pickup_agent];?>" type="text" class="textfield121" id="pickup_agent"></td>
                                </tr>
                                <?php
								  $pickup_date=date("Y-m-d h:i:s");
								?>
                                <tr>
                                  <td width="19%" height="28" align="left" valign="middle" class="text1">Date &amp; Time : </td>
                                  <td width="81%" height="28" align="left" valign="middle"><input name="pickup_date" value="<?php echo $res_trackinfo[pickup_date];?>" type="text" class="textfield121" id="pickup_date"></td>
                                </tr>
                              </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="19%" height="28" align="left" valign="middle" class="text1">Agent : </td>
                                  <td width="81%" height="28" align="left" valign="middle"><input name="delivery_agent" value="<?php echo $res_trackinfo[delivery_agent];?>" type="text" class="textfield121" id="delivery_agent"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Date &amp; Time : </td>
                                  <td height="28" align="left" valign="middle"><input name="delivery_date" value="<?php echo $res_trackinfo[delivery_date];?>" type="text" class="textfield121" id="delivery_date"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="8"></td>
                              <td></td>
                              <td height="8"></td>
                            </tr>
                            <tr>
                              <td height="25" class="text2">FROM :</td>
                              <td class="text2">&nbsp;</td>
                              <td height="25" class="text2">TO :</td>
                            </tr>
                            <tr>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Name : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_name" value="<?php echo $res_trackinfo[from_name];?>" type="text" class="textfield121 validate[required]" id="from_name"></td>
                                </tr>
                                <tr>
                                  <td width="17%" height="28" align="left" valign="middle" class="text1">Address : </td>
                                  <td width="83%" height="28" align="left" valign="middle"><input name="from_address" value="<?php echo $res_trackinfo[from_address];?>" type="text" class="textfield121 validate[required]" id="from_address"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">City : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_city" value="<?php echo $res_trackinfo[from_city];?>" type="text" class="textfield121 validate[required]" id="from_city"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">State : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_state" value="<?php echo $res_trackinfo[from_state];?>" type="text" class="textfield121 validate[required]" id="from_state"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Zip : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_zip" value="<?php echo $res_trackinfo[from_zip];?>" type="text" class="textfield121 validate[required]" id="from_zip"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Country : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_country" value="<?php echo $res_trackinfo[from_country];?>" type="text" class="textfield121 validate[required]" id="from_country"></td>
                                </tr>
                                </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Name : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_name" value="<?php echo $res_trackinfo[to_name];?>" type="text" class="textfield121 validate[required]" id="to_name"></td>
                                </tr>
                                <tr>
                                  <td width="17%" height="28" align="left" valign="middle" class="text1">Address : </td>
                                  <td width="83%" height="28" align="left" valign="middle"><input name="to_address" value="<?php echo $res_trackinfo[to_address];?>" type="text" class="textfield121 validate[required]" id="to_address"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">City : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_city" value="<?php echo $res_trackinfo[to_city];?>" type="text" class="textfield121 validate[required]" id="to_city"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">State : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_state" value="<?php echo $res_trackinfo[to_state];?>" type="text" class="textfield121 validate[required]" id="to_state"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Zip : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_zip" value="<?php echo $res_trackinfo[to_zip];?>" type="text" class="textfield121 validate[required]" id="to_zip"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Country : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_country" value="<?php echo $res_trackinfo[to_country];?>" type="text" class="textfield121 validate[required]" id="to_country"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="10"></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td height="25" colspan="3" class="usertext">Import from Escrow(Part of your email or Transation ID) : 
                                <input name="partof_your_email_transactionid" value="<?php echo $res_trackinfo[partof_your_email_transactionid];?>" type="text" class="textfield121" id="partof_your_email_transactionid"></td>
                              </tr>
                            <tr>
                              <td height="10"></td>
                              <td></td>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" colspan="2" align="left" valign="middle" class="text1">Package Description :</td>
                                </tr>
                                <tr>
                                  <td height="25" colspan="2" align="left" valign="middle">
                                  	<textarea name="package_description" id="package_description"><?php echo $res_trackinfo[package_description];?></textarea>
									<script type="text/javascript">
                                      CKEDITOR.replace( 'package_description', {
										extraPlugins : 'autogrow',
										autoGrow_maxHeight : 300,
										width : 500,
										height:100,
										toolbar:[
										['Bold','Italic','Underline','Strike'],
										['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
										['Undo','Redo'],
										['Image','Table','TextColor','BGColor','Source']]
                                      });                                    
                                    </script>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="5" colspan="2" align="left" valign="middle" class="text1"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Package Weight : </td>
                                  <td height="28" align="left" valign="middle"><input name="package_weight" value="<?php echo $res_trackinfo[package_weight];?>" type="text" class="textfield2" id="package_weight"></td>
                                </tr>
                                <tr>
                                  <td width="26%" height="28" align="left" valign="middle" class="text1">Package Insurance : </td>
                                  <td width="74%" height="28" align="left" valign="middle"><input name="package_insurance" value="<?php echo $res_trackinfo[package_insurance];?>" type="text" class="textfield2" id="package_insurance"></td>
                                </tr>
                              </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" colspan="2" align="left" valign="middle" class="text1">Package Contents :</td>
                                </tr>
                                <tr>
                                  <td height="25" colspan="2" align="left" valign="middle" class="text1">
                                    <textarea name="package_contents" id="package_contents"><?php echo $res_trackinfo[package_contents];?></textarea>
									<script type="text/javascript">
                                      CKEDITOR.replace( 'package_contents', {
										extraPlugins : 'autogrow',
										autoGrow_maxHeight : 300,
										width : 500,
										height:100,
										toolbar:[
										['Bold','Italic','Underline','Strike'],
										['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
										['Undo','Redo'],
										['Image','Table','TextColor','BGColor','Source']]
                                      });                                    
                                    </script>
                                  </td>
                                </tr>
                                <tr>
                                  <td height="5" colspan="2" align="left" valign="middle" class="text1"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Shipper's ID Type : </td>
                                  <td height="28" align="left" valign="middle"><input name="shippersid_type" value="<?php echo $res_trackinfo[shippersid_type];?>" type="text" class="textfield2" id="shippersid_type"></td>
                                </tr>
                                <tr>
                                  <td width="26%" height="28" align="left" valign="middle" class="text1">Shipper's ID NR # : </td>
                                  <td width="74%" height="28" align="left" valign="middle"><input name="shippersid_no" value="<?php echo $res_trackinfo[shippersid_no];?>" type="text" class="textfield2" id="shippersid_no"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="20"></td>
                              <td height="20"></td>
                              <td height="20"></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td height="35" colspan="3" align="left" valign="middle">
                            <a style="cursor:pointer;" onClick="showpackagestatusandroute();">
                            <table width="242" border="0" cellspacing="0" cellpadding="0">
						      <tr>
						        <td width="23" align="left" valign="middle"><img id="packagestatusandroutebtn" border="0" src="images/minus-sign.png" width="16" height="16"></td>
						        <td width="219" align="left" valign="middle" class="text_header">PACKAGE STATUS & ROUTE</td>
						      </tr>
						    </table></a>
                          </td>
                        </tr>
                        <tr>
                          <td height="5" align="left" class="headingtext"></td>
                          <td height="5" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr id="packagestatusplm" style="display:'';">
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle">
                          <table width="98%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #CCC; padding:5px; border-radius:5px; -moz-border-radius:5px;">
                            <tr>
                              <td width="49%" height="25" align="left" valign="top">
                                <textarea name="package_status_route_descr" id="package_status_route_descr"><?php echo $res_trackinfo[package_status_route_descr];?></textarea>
									<script type="text/javascript">
                                      CKEDITOR.replace( 'package_status_route_descr', {
										extraPlugins : 'autogrow',
										autoGrow_maxHeight : 300,
										width : 500,
										height:100,
										toolbar:[
										['Bold','Italic','Underline','Strike'],
										['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
										['Undo','Redo'],
										['Image','Table','TextColor','BGColor','Source']]
                                      });                                    
                                    </script><br>
								<input value="Generate" name="submit" class="button22" type="submit">
                              </td>
                              <td width="49%" height="25" align="left" valign="top">
                              	<table style="border:solid 1px #336699; border-radius:2px; -moz-border-radius:2px; padding:4px;">
                                  <tbody>
                                  	<tr>
                                      <td align="center" class="text1">No Route</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="0" <?php if($res_trackinfo[package_status]=='0'){?> checked <?php } ?> type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" class="text1">Upload Route</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="1" <?php if($res_trackinfo[package_status]=='1'){?> checked <?php } ?> type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" nowrap="nowrap" class="text1">Generate Route (Air)</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="2" <?php if($res_trackinfo[package_status]=='2'){?> checked <?php } ?> type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" nowrap="nowrap" class="text1">Generate Route (Land)</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="3" <?php if($res_trackinfo[package_status]=='3'){?> checked <?php } ?> type="radio"></td>
                                    </tr>
                                    <?php
									  if($res_trackinfo[package_status]=='3'){
										  $displaystatus='';
									  }else{
										  $displaystatus='none';
									  }
									?>
                                    <tr id="currentloctab" nowrap="" style="display:<?php echo $displaystatus;?>">
                                      <td align="center" class="text1">Current Land Location</td>
                                      <td align="center"><input name="currentloc" style="width:160px;" type="text" value="<?php echo $res_trackinfo[route_location];?>" class="textfield2" title="Example: Milano/Italy" alt="Example: Milano/Italy"></td>
                                    </tr>
                                    <?php
									  if($res_trackinfo[package_status]=='1'){
										  $disabletatus='';
									  }else{
										  $disabletatus='disabled="disabled"';
									  }
									?>
                                    <tr>
                                      <td colspan="2" align="center"><input <?php echo $disabletatus;?> id="sri" name="sri" type="file"></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <?php
							  if($res_trackinfo[package_status]=='1' || $res_trackinfo[package_status]=='2' || $res_trackinfo[package_status]=='3'){
							?>
                            <tr>
                              <td height="5" align="left" valign="middle"></td>
                              <td height="5" align="left" valign="middle"></td>
                            </tr>
                            <tr>
                              <td height="20" align="left" valign="middle"></td>
                              <td height="20" align="left" valign="middle">
                              <?php if($res_trackinfo[package_status]=='3'){ ?>
                              	<iframe noresize="noresize" frameborder="0" border="0" cellspacing="0" scrolling="no" marginwidth="0" marginheight="0" style="width: 490px; height: 300px;" src="../maptracking.php?trackingnumber=<?php echo $res_trackinfo[tracking_no];?>"></iframe>
                              <?php } ?>
                              <?php if($res_trackinfo[package_status]=='2'){ ?>
                              	<img src="http://maps.googleapis.com/maps/api/staticmap?size=490x300&markers=icon:http://www.google.com/mapfiles/dd-start.png|<?php echo $res_trackinfo[from_city];?>,<?php echo $res_trackinfo[from_country];?>&markers=icon:http://www.google.com/mapfiles/dd-end.png|<?php echo $res_trackinfo[to_city];?>,<?php echo $res_trackinfo[to_country];?>&sensor=false&maptype=roadmap">
                              <?php } ?>
                              <?php if($res_trackinfo[package_status]=='1'){ ?>
                              	<img src="../upload_route/<?php echo $res_trackinfo[upload_route];?>" height="300" width="490">
                              <?php } ?>
                              </td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td height="20" align="left" valign="middle">&nbsp;</td>
                              <td height="20" align="left" valign="middle">&nbsp;</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td height="35" colspan="3" align="left" valign="middle"><a style="cursor:pointer;" onClick="showdocumentstab();">
                            <table width="133" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="23" align="left" valign="middle"><img id="documentstabbtn" border="0" src="images/minus-sign.png" width="16" height="16"></td>
                                <td width="110" align="left" valign="middle" class="text_header">DOCUMENTS</td>
                              </tr>
                            </table>
                          </a></td>
                        </tr>
                        <tr>
                          <td height="5" align="left" class="headingtext"></td>
                          <td height="5" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr id="documentstabplm" style="display:'';">
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle">
                          	<table style="border:solid 1px #CCC; border-radius:5px; -moz-border-radius:5px;">
                              <tbody>
                                <tr valign="top">
                                  <td>
                                    <table style="border:solid 1px #CCC; border-radius:5px; -moz-border-radius:5px;">
                                      <tbody>
                                      	<tr class="text1">
                                          <td align="center">Vehicle Report</td>
                                          <td align="center">Upload <input onClick="javascript:allowuploadvir();" name="showvir" value="1" type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center"><input disabled="disabled" name="vir" type="file">
                                          <br><input id="virbtn" value="GENERATE" name="VIR" class="button22" onClick="setfields(0,1,1,0,1,0);" type="button"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="virphotoshow" style="display:;" align="center"><a href="../vehicle_report/<?php echo $res_vir_report[uploaded_report];?>" title="Vehicle Inspection Report" alt="Vehicle Inspection report" target="_blank"><img src="../vehicle_report/<?php echo $res_vir_report[uploaded_report];?>" width="150" height="200" border="1"></a></td>
                                        </tr>
                                        
                                        <tr>
                                          <td colspan="2" id="virformshow" style="display:none;" align="center">
                                            <table style="border:solid 1px #CFCFCF; border-radius:5px; -moz-border-radius:5px; padding:5px;">
                                              <tbody>
                                              	<tr>
                                                  <th height="25" colspan="2" align="center" valign="middle" bgcolor="#BABEDC" style="border-radius:3px; -moz-border-radius:3px;">VEHICLE INSPECTION DETAILS</th>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Date of Inspection</td>
                                                  <td align="left" valign="middle"><input name="virdateinspection" value="<?php echo $res_vir_report[inspection_date];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">MAKE/MODEL: </td>
                                                  <td align="left" valign="middle"><input name="virmakemodel" value="<?php echo $res_vir_report[make_model];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">YEAR: </td>
                                                  <td align="left" valign="middle"><input name="viryear" value="<?php echo $res_vir_report[year];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">MILEAGE: </td>
                                                  <td align="left" valign="middle"><input name="virodometer" value="<?php echo $res_vir_report[millage];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">POWER: (HP)</td>
                                                  <td align="left" valign="middle"><input name="virpower" value="<?php echo $res_vir_report[power];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">TRANSMISSION: </td>
                                                  <td align="left" valign="middle">
                                                  	<select name="virtransmission"> 
                                                      <option selected="selected" value="">Select</option>
                                                      <option value="MANUAL" <?php if($res_vir_report[transmission]=="MANUAL"){ echo "Selected"; } ?>>MANUAL</option>
                                                      <option value="AUTOMATIC" <?php if($res_vir_report[transmission]=="AUTOMATIC"){ echo "Selected"; } ?>>AUTOMATIC</option>
                                                  	</select>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">FUEL: </td>
                                                  <td align="left" valign="middle"><input name="virfuel" value="<?php echo $res_vir_report[fuel];?>" type="text"></td></tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Inspected By</td>
                                                  <td align="left" valign="middle"><input name="virinspectedby" value="<?php echo $res_vir_report[inspected_by];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left">
                                                	<input name="submit" id="submit" value="Retrieve" type="submit">
                                                    <?php if($res_vir_report[id]!=''){ ?>
                                                    <input name="view" type="button" id="view" value="View" onClick="viropen();">
                                                    <?php } ?>
                                                  </th>
                                                </tr>
                                              </tbody>
                                            </table>
                                         </td>
                                       </tr>
                                     </tbody>
                                  </table>
                                </td>
                                <td>
                                  <table style="border:solid 1px #CCC; border-radius:5px; -moz-border-radius:5px;">
                                     <tbody>
                                     	<tr class="text1">
                                          <td align="center">Bill of Lading</td>
                                          <td align="center">Upload <input onClick="javascript:allowuploadbol();" name="showbol" value="1" type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center"><input disabled="disabled" name="bol" type="file">
                                          <br><input id="bolbtn" value="GENERATE" name="BOL" class="button22" onClick="setfields(1,0,0,1,1,0);" type="button"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="bolphotoshow" style="display:;" align="center"><a href="../billoflading_report/<?php echo $res_bil_report[uploaded_lading];?>" title="Bill of Lading" alt="Bill of Lading" target="_blank"><img src="../billoflading_report/<?php echo $res_bil_report[uploaded_lading];?>" height="200" width="150" border="1"></a></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="bolformshow" style="display:none;" align="center">
                                            <table style="border:solid 1px #CFCFCF; border-radius:5px; -moz-border-radius:5px; padding:5px;">
                                              <tbody>
                                              	<tr>
                                                  <th height="25" colspan="2" align="center" valign="middle" bgcolor="#BABEDC" style="border-radius:3px; -moz-border-radius:3px;">Bill of Lading Details</th>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Date of Bill</td>
                                                  <td align="left" valign="middle"><input name="boldatebol" value="<?php echo $res_bil_report[dateof_bill];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Make / Model</td>
                                                  <td align="left" valign="middle"><input name="bolmakemodel" value="<?php echo $res_bil_report[make_model];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Shipping Fee</td>
                                                  <td align="left" valign="middle"><input name="bolshippingfee" value="<?php echo $res_bil_report[shipping_fee];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Price</td>
                                                  <td align="left" valign="middle"><input name="bolprice" value="<?php echo $res_bil_report[price];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle"><img src="billofladingsignature.php?text=<?php echo $res_admin[billof_lading_signature];?>&font=<?php echo $res_admin[billof_lading_signature_font];?>" border="0" width="110"></td>
                                                  <td align="left" valign="middle"><input maxlength="19" name="bolsignature" style="color: darkred;" value="Type here to change" onClick="javascript: if(this.value=='Type here to change') { this.value = ''; }" onBlur="javascript: if(this.value==''){ this.value='Type here to change'; }" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Font</td>
                                                  <td align="left" valign="middle" class="text2">
                                                    1<input name="bolfont" value="1" <?php if($res_admin[billof_lading_signature_font]=='1'){?> checked <?php } ?> type="radio">
                                                    2<input name="bolfont" value="2" <?php if($res_admin[billof_lading_signature_font]=='2'){?> checked <?php } ?> type="radio">
                                                    3<input name="bolfont" value="3" <?php if($res_admin[billof_lading_signature_font]=='3'){?> checked <?php } ?> type="radio">
                                                    4<input name="bolfont" value="4" <?php if($res_admin[billof_lading_signature_font]=='4'){?> checked <?php } ?> type="radio">
                                                    5<input name="bolfont" value="5" <?php if($res_admin[billof_lading_signature_font]=='5'){?> checked <?php } ?> type="radio">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Font Size</td>
                                                  <td align="left" valign="middle" class="text2">
                                                    <select name="billof_lading_font_size" id="billof_lading_font_size" class="validate[required] textfield2" style="width:40px; height:22px;">
                                                      <option value="24" <?php if($res_admin[billof_lading_font_size]=='24'){?> selected <?php } ?>>24</option>
                                                      <option value="30" <?php if($res_admin[billof_lading_font_size]=='30'){?> selected <?php } ?>>30</option>
                                                      <option value="36" <?php if($res_admin[billof_lading_font_size]=='36'){?> selected <?php } ?>>36</option>
                                                      <option value="42" <?php if($res_admin[billof_lading_font_size]=='42'){?> selected <?php } ?>>42</option>
                                                      <option value="48" <?php if($res_admin[billof_lading_font_size]=='48'){?> selected <?php } ?>>48</option>
                                                      <option value="50" <?php if($res_admin[billof_lading_font_size]=='50'){?> selected <?php } ?>>50</option>
                                                      <option value="56" <?php if($res_admin[billof_lading_font_size]=='56'){?> selected <?php } ?>>56</option>
                                                      <option value="60" <?php if($res_admin[billof_lading_font_size]=='60'){?> selected <?php } ?>>60</option>
                                                    </select>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left"><input name="submit" value="Submit" type="submit">
                                                  <?php if($res_bil_report[id]!=''){ ?>
                                                    <input name="view" type="button" id="view" value="View" onClick="bilopen();">
                                                  <?php } ?>
                                                  </th>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                     </tbody>
                                  </table>
                                </td>
                                <td>
                                  <table style="border:solid 1px #CCC; border-radius:5px; -moz-border-radius:5px;">
                                     <tbody>
                                     	<tr class="text1">
                                          <td align="center">Invoice</td>
                                          <td align="center">Upload <input onClick="javascript:allowuploadinvoice();" name="showinvoice" value="1" type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center"><input disabled="disabled" name="invoice" type="file">
                                          <br><input id="invbtn" value="GENERATE" name="INVOICE" class="button22" onClick="setfields(1,0,1,0,0,1);" type="button"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="invoicephotoshow" style="display:;" align="center"><a href="../invoice_report/<?php echo $res_invoice_report[uploaded_invoice];?>" title="Invoice" alt="Invoice" target="_blank"><img src="../invoice_report/<?php echo $res_invoice_report[uploaded_invoice];?>" width="150" height="200" border="1"></a></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="invoiceformshow" style="display:none;" align="center">
                                            <table style="border:solid 1px #CFCFCF; border-radius:5px; -moz-border-radius:5px; padding:5px;">
                                              <tbody>
                                                <tr>
                                                  <th height="25" colspan="2" align="center" valign="middle" bgcolor="#BABEDC" style="border-radius:3px; -moz-border-radius:3px;">Invoice Details</th>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Date of Invoice</td>
                                                  <td align="left" valign="middle"><input name="invinvoicedate" value="<?php echo $res_invoice_report[dateof_invoice];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Make / Model</td>
                                                  <td align="left" valign="middle"><input name="invmakemodel" value="<?php echo $res_invoice_report[make_model];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Shipping Fee</td>
                                                  <td align="left" valign="middle"><input name="invshippingfee" value="<?php echo $res_invoice_report[shipping_fee];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Price</td>
                                                  <td align="left" valign="middle"><input name="invprice" value="<?php echo $res_invoice_report[price];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Currency</td>
                                                  <td align="left" valign="middle">
                                                  	<select id="currency" name="currency">
                                                      <option value="GBP" <?php if($res_invoice_report['currency']=="GBP"){ echo "Selected"; } ?>>GBP</option>
                                                      <option value="EUR" <?php if($res_invoice_report['currency']=="EUR"){ echo "Selected"; } ?>>EUR</option>
                                                      <option value="USD" <?php if($res_invoice_report['currency']=="USD"){ echo "Selected"; } ?>>USD</option>
                                                    </select>
                                                  </td>	
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Percent Deposit</td>
                                                  <td align="left" valign="middle"><input name="invdepositpercent" value="<?php echo $res_invoice_report[percent_deposite];?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Payment Profile</td>
                                                  <td align="left" valign="middle">
                                                    <select name="paymentprofile" alt="Create a Payment profile in ADMIN page" title="Create a Payment profile in ADMIN page">
                                                      <?php 
													  	foreach($dbf->fetch('tracking_bank',"","id","","DESC") as $res_bank) {
													  ?>
                                                	  <option value="<?php echo $res_bank[id];?>" <?php if($res_invoice_report[payment_profile]==$res_bank[id]){ echo "Selected";} ?>><?php echo $res_bank[name];?></option>
                                                      <?php } ?>
                                                    </select>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left">
                                                  <input name="submit" value="Submit" type="submit">
                                                  <?php if($res_invoice_report[id]!=''){ ?>
                                                    <input name="view" type="button" id="view" value="View" onClick="invoiceopen();">
                                                  <?php } ?></th>
                                                </tr>
                                                <?php
												  if($res_invoice_report[previous_invoice]!='' || $res_invoice_report[tot_paid_until_now]!='' || $res_invoice_report[additional_amount]!='')
												  {
												   	 $display="";
													 $display_btn="none";
												  }
												  else
												  {
												  	 $display="none";
													 $display_btn="";
												  }
												?>
                                                <tr align="left" valign="middle">
                                                  <td colspan="2"><input id="greedybtn" value="Greedy ?" style="display:<?php echo $display_btn;?>;" name="greedy" class="button22" onClick="showgreedyfields()" type="button"></td>
                                                </tr>
                                                <tr>
                                                  <td height="1" colspan="2" style="border-top:solid 1px #BCBDDE;"></td>
                                                </tr>
                                                <tr id="greedytablet1" style="display:<?php echo $display;?>;">
                                                  <td align="left" valign="middle" class="text1">Previous Invoice #</td><td align="left" valign="middle"><input name="greedyinv" type="text" value="<?php echo $res_invoice_report[previous_invoice];?>"></td>
                                                </tr>
                                                <tr id="greedytablet2" style="display:<?php echo $display;?>;">
                                                  <td align="left" valign="middle" class="text1">Total paid until now</td><td align="left" valign="middle"><input name="greedypaid" type="text" value="<?php echo $res_invoice_report[tot_paid_until_now];?>"></td>
                                                </tr>
                                                <tr id="greedytablet3" style="display:<?php echo $display;?>;">
                                                  <td align="left" valign="middle" class="text1">Additional Amount</td><td align="left" valign="middle"><input name="greedyvalue" type="text" value="<?php echo $res_invoice_report[additional_amount];?>"></td>
                                                </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td>
                                  <table style="border:solid 1px #CCC; border-radius:5px; -moz-border-radius:5px;">
                                     <tbody>
                                        <tr class="text1">
                                          <td align="center">Proof of Transfer</td>
                                          <td align="center">Upload <input onClick="javascript:allowuploadpof();" name="showpof" value="1" type="checkbox"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center"><input disabled="disabled" name="pof" type="file">
                                          <br><input id="ddsbtn" value="DE DESIGN" name="PROOF" class="button22" onClick="setfields(1,0,1,0,1,0);" type="button"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="center"><a href="../proof_of_transfer/<?php echo $res_trackinfo[proof_of_transfer];?>" title="Proof of Transfer" alt="Proof of Transfer" target="_blank"><img src="../proof_of_transfer/<?php echo $res_trackinfo[proof_of_transfer];?>" width="150" height="200" border="1"></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td height="10" align="left" class="headingtext"></td>
                          <td height="10" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle" class="text1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="10%" align="left" valign="middle" class="text1">Active tracking : </td>
                                <td width="90%" align="left" valign="middle"><input type="checkbox" name="active_status" id="active_status" value="1" <?php if($res_trackinfo[active_status]=='1'){?>checked <?php } ?>></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td width="16" align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td width="144" align="left"><input name="submit" type="submit" class="button" id="submit" value="Update">&nbsp; 
                          <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_tracking_number.php'"></td>
                          <td height="40" colspan="5" align="left" valign="bottom">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;</td>
                          <td colspan="5" align="left">&nbsp;</td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
                </table>
				</td>
              </tr>
              <tr>
                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5" align="left" valign="top"><img src="images/bottom-left-box-bg.jpg" alt="bot_left_bg" width="5" height="5" /></td>
                      <td height="5" class="botmidboxbg"></td>
                      <td width="5"><img src="images/bot-right-box-bg.jpg" alt="bot_right" width="5" height="5" /></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="10">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php include 'footer.php';?></td>
  </tr>
</table>
<script type="text/javascript">
$(function(){
	$('#track_id').show();	
	});
</script>
</body>
</html>
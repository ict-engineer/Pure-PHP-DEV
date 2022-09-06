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

if(isset($_POST[submit])<>'')
{
	//Upload upload_route Starts here====================
	if($_FILES['sri']['name']!='')
	{
		$path="../upload_route/";
		$route_name=time()."_".$_FILES['sri']['name'];
		move_uploaded_file($_FILES['sri']['tmp_name'],$path.$route_name);

		$upload_route=$route_name;
	}
	//Upload upload_route ends here======================
	
	//Upload proof_of_transfer Starts here===============
	if($_FILES['pof']['name']!='')
	{
		$path1="../proof_of_transfer/";
		$proof_of_transfer=time()."_".$_FILES['pof']['name'];
		move_uploaded_file($_FILES['pof']['tmp_name'],$path1.$proof_of_transfer);

		$proof_of_transfer=$proof_of_transfer;
	}
	//Upload proof_of_transfer ends here=================
	
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
	
	if($from_city!='' && $from_zip!='' && $from_country!='' && $to_city!='' && $to_zip!='' && $to_country!=''){
		
		$package_status_route_descr="PICKED UP ON ".$_POST[pickup_date]."<br/>TECHNICAL INSPECTION SCAN<br/>ORIGIN SCAN<br/>BILL OF LADING SCAN<br/>BILLING INFORMATION RECEIVED<br/>START LOCATION : ".$from_city."(".$from_zip.") - ".$from_country."<br/>CURRENT LOCATION : ".$from_city."/".$from_country."<br/>NEXT LOCATION : ".$to_city."/".$to_country."<br/> CONSIGNEE : ".$to_city ."(".$to_zip.") - ".$to_country."<br/> CURRENT STATUS : SHIPMENT ON HOLD <span style=color:#ff0000;>*</span>";
	}
	
	$route_location=addslashes(strtoupper($_POST[currentloc]));
	
	$string="my_comment='$my_comment',tracking_no='$tracking_no',shippers_ref='$shippers_ref',pickup_agent='$pickup_agent',pickup_date='$_POST[pickup_date]',delivery_agent='$delivery_agent',delivery_date='$_POST[delivery_date]',from_name='$from_name',from_address='$from_address',from_city='$from_city',from_state='$from_state',from_zip='$from_zip',from_country='$from_country',to_name='$to_name',to_address='$to_address',to_city='$to_city',to_state='$to_state',to_zip='$to_zip',to_country='$to_country',partof_your_email_transactionid='$partof_your_email_transactionid',package_description='$package_description',package_weight='$package_weight',package_insurance='$package_insurance',package_contents='$package_contents',shippersid_type='$shippersid_type',shippersid_no='$shippersid_no',package_status_route_descr='$package_status_route_descr',package_status='$_POST[showphoto]',upload_route='$upload_route',route_location='$route_location',proof_of_transfer='$proof_of_transfer',active_status='$_POST[active_status]',created_date='$dated'";
	
	$trckid=$dbf->insertSet("tracking_system",$string);
	
	
	//For Insering data to Vehicle Inspection Details=======================================
	  if($_FILES['vir']['name']!='') {
		$path="../vehicle_report/";
		$virreport_name=time()."_".$_FILES['vir']['name'];
		move_uploaded_file($_FILES['vir']['tmp_name'],$path.$virreport_name);
		
		$vir_report=$virreport_name;
	  }
	  
	  $string2="tracking_system_id='$trckid',uploaded_report='$vir_report',inspection_date='$_POST[virdateinspection]',make_model='$_POST[virmakemodel]',year='$_POST[viryear]',millage='$_POST[virodometer]',power='$_POST[virpower]',transmission='$_POST[virtransmission]',fuel='$_POST[virfuel]',inspected_by='$_REQUEST[virinspectedby]'";
	
	  $dbf->insertSet("tracking_system_vehicle_report",$string2);	
	
	//For Insering data to Vehicle Inspection Details=======================================
	
	//For Insering data to Bill of Lading Details===========================================
	  if($_FILES['bol']['name']!='') {
		$path="../billoflading_report/";
		$billoflading_name=time()."_".$_FILES['bol']['name'];
		move_uploaded_file($_FILES['bol']['tmp_name'],$path.$billoflading_name);
		
		$billoflading=$billoflading_name;
	  }
	  
	  $string3="tracking_system_id='$trckid',uploaded_lading='$billoflading',dateof_bill='$_POST[boldatebol]',make_model='$_POST[bolmakemodel]',shipping_fee='$_POST[bolshippingfee]',price='$_POST[bolprice]'";
	
	  $dbf->insertSet("tracking_system_billof_lading",$string3);
	  
	  //Update bill of lading signature from admin==============
	  if($_REQUEST[bolsignature]!='' && $_REQUEST[bolsignature]!="Type here to change")
	  {
		  $billof_lading_signature=addslashes($_POST[bolsignature]);
		  
		  $string_admin="billof_lading_signature='$billof_lading_signature',billof_lading_signature_font='$_POST[bolfont]',billof_lading_font_size='$_POST[billof_lading_font_size]'";
		  $dbf->updateTable("admin",$string_admin,"id='1'");
	  }
	
	//For Insering data to Bill of Lading Details===========================================
	
	//For Insering data to Invoice Details==================================================
	  if($_FILES['invoice']['name']!='') {
		$path="../invoice_report/";
		$invoice_name=time()."_".$_FILES['invoice']['name'];
		move_uploaded_file($_FILES['invoice']['tmp_name'],$path.$invoice_name);
		
		$uploaded_invoice=$invoice_name;
	  }
	  
	  $invoiceno = mt_rand(10000000, 99999999);
	  
	  $string4="tracking_system_id='$trckid',invoice_no='$invoiceno',uploaded_invoice='$uploaded_invoice',dateof_invoice='$_POST[invinvoicedate]',make_model='$_POST[invmakemodel]',shipping_fee='$_POST[invshippingfee]',price='$_POST[invprice]',currency='$_POST[currency]',percent_deposite='$_POST[invdepositpercent]',payment_profile='$_POST[paymentprofile]',previous_invoice='$_POST[greedyinv]',tot_paid_until_now='$_POST[greedypaid]',additional_amount='$_POST[greedyvalue]'";
	
	  $dbf->insertSet("tracking_system_invoice",$string4);
	
	//For Insering data to Invoice Details==================================================
	
	$trckid=base64_encode(base64_encode($trckid));
	header("Location:next_add_tracking_number.php?instid=$trckid");
}
?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
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
						  <td height="30" colspan="3" align="left" valign="middle" class="success">Record  has been added successfully. </td>
						</tr>
						<?php } ?>
						<tr>
						  <td height="15" align="left" class="headingtext"></td>
						  <td height="15" colspan="3" align="left" valign="middle"></td>
						</tr>
                        <?php							
							/*$fromcity=$_REQUEST[from_city];
							$fromzip=$_REQUEST[from_zip];
							$fromcountry=$_REQUEST[from_country];
							
							$tocity=$_REQUEST[to_city];
							$tozip=$_REQUEST[to_zip];
							$tocountry=$_REQUEST[to_country];
														  
							$package_descr="PICKED UP ON ".$_REQUEST[pickup_date]."<br/>TECHNICAL INSPECTION SCAN<br/>ORIGIN SCAN<br/>BILL OF LADING SCAN<br/>BILLING INFORMATION RECEIVED<br/>START LOCATION:".$fromcity."(".$fromzip.") - ".$fromcountry."<br/>CURRENT LOCATION:".$fromcity."/".$fromcountry."<br/>NEXT LOCATION:".$tocity."/".$tocountry."<br/> CONSIGNEE: ".$tocity ."(".$tozip.") - ".$tocountry."<br/> CURRENT STATUS: SHIPMENT ON HOLD";*/
						
						?>
						<tr>
						  <td height="15" align="left" class="headingtext"><!--<input type="hidden" name="package_status_route_descr" id="package_status_route_descr" value="<?php //echo $package_descr;?>" />--></td>
						  <td height="25" colspan="3" align="left" valign="middle" class="text1">My Comment : &nbsp;<input name="my_comment" type="text" class="textfield121" id="my_comment"></td>
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
                                        <td width="57%" align="left" valign="middle"><input name="trackingnumber" type="text" value="<?php echo $_REQUEST[tracking_no];?>" class="textfield2 validate[required]" id="trackingnumber" alt="If modified, a copy of the old tracking will be created (But without photos)." title="If modified, a copy of the old tracking will be created. (But without photos)"></td>
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
                                  <td width="75%" height="25" align="left" valign="middle"><input name="shippers_ref" value="8932981" type="text" class="textfield2" id="shippers_ref"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="8" align="center"></td>
                              <td></td>
                              <td height="8"></td>
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
                                  <td height="28" align="left" valign="middle"><input name="pickup_agent" value="AJ-826-2004" type="text" class="textfield121" id="pickup_agent"></td>
                                </tr>
                                <?php
								  $pickup_date=date("Y-m-d h:i:s");
								?>
                                <tr>
                                  <td width="19%" height="28" align="left" valign="middle" class="text1">Date &amp; Time : </td>
                                  <td width="81%" height="28" align="left" valign="middle"><input name="pickup_date" value="<?php $dt=strtotime($pickup_date); echo date("l d F Y - h:i A",$dt)?>" type="text" class="textfield121" id="pickup_date"></td>
                                </tr>
                              </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="19%" height="28" align="left" valign="middle" class="text1">Agent : </td>
                                  <td width="81%" height="28" align="left" valign="middle"><input name="delivery_agent" value="EI-516-2107" type="text" class="textfield121" id="delivery_agent"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Date &amp; Time : </td>
                                  <td height="28" align="left" valign="middle"><input name="delivery_date" value="UNKNOWN" type="text" class="textfield121" id="delivery_date"></td>
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
                                  <td height="28" align="left" valign="middle"><input name="from_name" type="text" class="textfield121 validate[required]" id="from_name"></td>
                                </tr>
                                <tr>
                                  <td width="17%" height="28" align="left" valign="middle" class="text1">Address : </td>
                                  <td width="83%" height="28" align="left" valign="middle"><input name="from_address" type="text" class="textfield121 validate[required]" id="from_address"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">City : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_city" type="text" class="textfield121 validate[required]" id="from_city"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">State : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_state" type="text" class="textfield121 validate[required]" id="from_state"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Zip : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_zip" type="text" class="textfield121 validate[required]" id="from_zip"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Country : </td>
                                  <td height="28" align="left" valign="middle"><input name="from_country" type="text" class="textfield121 validate[required]" id="from_country"></td>
                                </tr>
                                </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Name : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_name" type="text" class="textfield121 validate[required]" id="to_name"></td>
                                </tr>
                                <tr>
                                  <td width="17%" height="28" align="left" valign="middle" class="text1">Address : </td>
                                  <td width="83%" height="28" align="left" valign="middle"><input name="to_address" type="text" class="textfield121 validate[required]" id="to_address"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">City : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_city" type="text" class="textfield121 validate[required]" id="to_city"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">State : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_state" type="text" class="textfield121 validate[required]" id="to_state"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Zip : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_zip" type="text" class="textfield121 validate[required]" id="to_zip"></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="middle" class="text1">Country : </td>
                                  <td height="28" align="left" valign="middle"><input name="to_country" type="text" class="textfield121 validate[required]" id="to_country"></td>
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
                                <input name="partof_your_email_transactionid" type="text" class="textfield121" id="partof_your_email_transactionid"></td>
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
                                  	<textarea name="package_description" id="package_description">
                                        <strong>AUTOVEHICLE</strong><br/>
                                        MAKE/MODEL: AUDI A4 1.9 TDI<br/>
                                        BODY: 4/5-DOORS<br/>
                                        YEAR: 03/2008<br/>
                                        MILEAGE: 53000 KM<br/>
                                        FUEL: DIESEL<br/>
                                        POWER: 110 KW (150 HP)<br/>
                                        TRANSMISSION: MANUAL<br/>
                                        CMC: 1900 CC<br/>
                                        EMISSION CLASS: EURO 4
                                    </textarea>
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
                                  <td height="28" align="left" valign="middle"><input name="package_weight" value="1839 KG" type="text" class="textfield2" id="package_weight"></td>
                                </tr>
                                <tr>
                                  <td width="26%" height="28" align="left" valign="middle" class="text1">Package Insurance : </td>
                                  <td width="74%" height="28" align="left" valign="middle"><input name="package_insurance" value="YES" type="text" class="textfield2" id="package_insurance"></td>
                                </tr>
                              </table></td>
                              <td>&nbsp;</td>
                              <td height="25" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" colspan="2" align="left" valign="middle" class="text1">Package Contents :</td>
                                </tr>
                                <tr>
                                  <td height="25" colspan="2" align="left" valign="middle" class="text1">
                                    <textarea name="package_contents" id="package_contents">
                                    	Automobile (Vehicle in Subject)<br/>
                                        Additional:<br/>
                                        2 x Keys<br/>
                                        Documents + Manuals<br/>
                                        4 x Rubber Tires<br/>
                                        1 x Mobile GPS Device<br/>
                                        Service Tools + Spare Tire<br/>
                                        1 x Fire Extinguisher<br/>
                                        1 x First Aid Kit<br/>
                                        2 x Signalization Triangles<br/>
                                    </textarea>
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
                                  <td height="28" align="left" valign="middle"><input name="shippersid_type" value="PASSPORT" type="text" class="textfield2" id="shippersid_type"></td>
                                </tr>
                                <tr>
                                  <td width="26%" height="28" align="left" valign="middle" class="text1">Shipper's ID NR # : </td>
                                  <td width="74%" height="28" align="left" valign="middle"><input name="shippersid_no" value="048 582 3714" type="text" class="textfield2" id="shippersid_no"></td>
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
						        <td width="23" align="left" valign="middle"><img id="packagestatusandroutebtn" border="0" src="images/plus-sign.png" width="16" height="16"></td>
						        <td width="219" align="left" valign="middle" class="text_header">PACKAGE STATUS & ROUTE</td>
						      </tr>
						    </table></a>
                          </td>
                        </tr>
                        <tr>
                          <td height="5" align="left" class="headingtext"></td>
                          <td height="5" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr id="packagestatusplm" style="display:none;">
                          <td align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle">
                          <table width="98%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #CCC; padding:5px; border-radius:5px; -moz-border-radius:5px;">
                            
                            <tr>
                              <td width="49%" height="25" align="left" valign="top">
                              	<textarea name="package_status_route_descr1" cols="50" rows="5" disabled="disabled" id="package_status_route_descr1"></textarea><br>
								<input value="Generate" name="submit" class="button22" type="submit">
                              </td>
                              <td width="49%" height="25" align="left" valign="top">
                              	<table style="border:solid 1px #336699; border-radius:2px; -moz-border-radius:2px; padding:4px;">
                                  <tbody>
                                  	<tr>
                                      <td align="center" class="text1">No Route</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="0" checked="checked" type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" class="text1">Upload Route</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="1" type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" nowrap="nowrap" class="text1">Generate Route (Air)</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="2" type="radio"></td>
                                    </tr>
                                    <tr>
                                      <td align="center" nowrap="nowrap" class="text1">Generate Route (Land)</td>
                                      <td align="center"><input onClick="javascript:allowupload();" name="showphoto" value="3" type="radio"></td>
                                    </tr>
                                    <tr id="currentloctab" nowrap="" style="display:none">
                                      <td align="center" class="text1">Current Land Location</td>
                                      <td align="center"><input name="currentloc" type="text" class="textfield2" title="Example: Milano/Italy" alt="Example: Milano/Italy"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center"><input disabled="disabled" id="sri" name="sri" type="file"></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
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
                                <td width="23" align="left" valign="middle"><img id="documentstabbtn" border="0" src="images/plus-sign.png" width="16" height="16"></td>
                                <td width="110" align="left" valign="middle" class="text_header">DOCUMENTS</td>
                              </tr>
                            </table>
                          </a></td>
                        </tr>
                        <tr>
                          <td height="5" align="left" class="headingtext"></td>
                          <td height="5" colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr id="documentstabplm" style="display:none;">
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
                                          <td colspan="2" id="virphotoshow" style="display:;" align="center"></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" id="virformshow" style="display:none;" align="center">
                                            <table style="border:solid 1px #CFCFCF; border-radius:5px; -moz-border-radius:5px; padding:5px;">
                                              <tbody>
                                              	<tr>
                                                  <th height="25" colspan="2" align="center" valign="middle" bgcolor="#BABEDC" style="border-radius:3px; -moz-border-radius:3px;">VEHICLE INSPECTION DETAILS</th>
                                                </tr>
                                                <?php $cur_dated=date("Y-m-d");?>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Date of Inspection</td>
                                                  <td align="left" valign="middle"><input name="virdateinspection" value="<?php $dt=strtotime($cur_dated); echo date("d F Y",$dt)?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">MAKE/MODEL: </td>
                                                  <td align="left" valign="middle"><input name="virmakemodel" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">YEAR: </td>
                                                  <td align="left" valign="middle"><input name="viryear" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">MILEAGE: </td>
                                                  <td align="left" valign="middle"><input name="virodometer" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">POWER: (HP)</td>
                                                  <td align="left" valign="middle"><input name="virpower" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">TRANSMISSION: </td>
                                                  <td align="left" valign="middle"><select name="virtransmission"> <option selected="selected" value="">Select</option><option value="MANUAL">MANUAL</option><option value="AUTOMATIC">AUTOMATIC</option></select></td></tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">FUEL: </td>
                                                  <td align="left" valign="middle"><input name="virfuel" type="text"></td></tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Inspected By</td>
                                                  <td align="left" valign="middle"><input name="virinspectedby" value="William Watson" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left">
                                                	<input name="submit" value="Retrieve" type="submit">
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
                                          <td colspan="2" id="bolphotoshow" style="display:;" align="center"></td>
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
                                                  <td align="left" valign="middle"><input name="boldatebol" value="<?php $dt=strtotime($cur_dated); echo date("d F Y",$dt)?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Make / Model</td>
                                                  <td align="left" valign="middle"><input name="bolmakemodel" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Shipping Fee</td>
                                                  <td align="left" valign="middle"><input name="bolshippingfee" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Price</td>
                                                  <td align="left" valign="middle"><input name="bolprice" type="text"></td>
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
                                                      <option value="24">24</option>
                                                      <option value="30">30</option>
                                                      <option value="36">36</option>
                                                      <option value="42">42</option>
                                                      <option value="48">48</option>
                                                      <option value="50" selected >50</option>
                                                      <option value="56">56</option>
                                                      <option value="60">60</option>
                                                    </select>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left"><input name="submit" value="Submit" type="submit"></th>
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
                                          <td colspan="2" id="invoicephotoshow" style="display:;" align="center"></td>
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
                                                  <td align="left" valign="middle"><input name="invinvoicedate" value="<?php $dt=strtotime($cur_dated); echo date("d F Y",$dt)?>" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Make / Model</td>
                                                  <td align="left" valign="middle"><input name="invmakemodel" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Shipping Fee</td>
                                                  <td align="left" valign="middle"><input name="invshippingfee" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Price</td>
                                                  <td align="left" valign="middle"><input name="invprice" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Currency</td>
                                                  <td align="left" valign="middle">
                                                  	<select id="currency" name="currency">
                                                      <option value="GBP">GBP</option>
                                                      <option value="EUR">EUR</option>
                                                      <option value="USD">USD</option>
                                                    </select>
                                                  </td>	
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Percent Deposit</td>
                                                  <td align="left" valign="middle"><input name="invdepositpercent" value="30%" type="text"></td>
                                                </tr>
                                                <tr>
                                                  <td align="left" valign="middle" class="text1">Payment Profile</td>
                                                  <td align="left" valign="middle">
                                                    <select name="paymentprofile" alt="Create a Payment profile in ADMIN page" title="Create a Payment profile in ADMIN page">
                                                      <?php 
													  	foreach($dbf->fetch('tracking_bank',"","id","","DESC") as $res_bank) {
													  ?>
                                                	  <option selected="selected" value="<?php echo $res_bank[id];?>"><?php echo $res_bank[name];?></option>
                                                      <?php } ?>
                                                    </select>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <th colspan="2" align="left"><input name="submit" value="Submit" type="submit"></th>
                                                </tr>
                                                <tr align="left" valign="middle">
                                                  <td colspan="2"><input id="greedybtn" value="Greedy ?" style="display:" name="greedy" class="button22" onClick="showgreedyfields()" type="button"></td>
                                                </tr>
                                                <tr>
                                                  <td height="1" colspan="2" style="border-top:solid 1px #BCBDDE;"></td>
                                                </tr>
                                                <tr id="greedytablet1" style="display:none">
                                                  <td align="left" valign="middle" class="text1">Previous Invoice #</td><td align="left" valign="middle"><input name="greedyinv" type="text"></td>
                                                </tr>
                                                <tr id="greedytablet2" style="display:none">
                                                  <td align="left" valign="middle" class="text1">Total paid until now</td><td align="left" valign="middle"><input name="greedypaid" type="text"></td>
                                                </tr>
                                                <tr id="greedytablet3" style="display:none">
                                                  <td align="left" valign="middle" class="text1">Additional Amount</td><td align="left" valign="middle"><input name="greedyvalue" type="text"></td>
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
                                          <td colspan="2" align="center"></td>
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
                                <td width="90%" align="left" valign="middle"><input type="checkbox" name="active_status" id="active_status" value="1"></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td width="16" align="left" class="headingtext">&nbsp;</td>
                          <td colspan="3" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td width="144" align="left"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp; 
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
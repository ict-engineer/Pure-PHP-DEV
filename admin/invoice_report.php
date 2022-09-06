<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Invoice Report';
//Object initialization
$dbf = new User();

$res_admin=$dbf->fetchSingle("admin","id='1'");
$res_contact=$dbf->fetchSingle("contact","id='1'");

$inv_reportid=base64_decode(base64_decode($_REQUEST[inv_report]));
$val_invoice_report=$dbf->fetchSingle("tracking_system_invoice","id='$inv_reportid'");

//For Tracking Number
$res_trackinfo=$dbf->fetchSingle("tracking_system","id='$val_invoice_report[tracking_system_id]'");

//For Bank
$res_bank=$dbf->fetchSingle("tracking_bank","id='$val_invoice_report[payment_profile]'");

//For Barcode======================
include '../barcode/Code128.php';
$code = isset($_GET['code']) ? $_GET['code'] :$res_trackinfo[tracking_no]; 
//For Barcode======================

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body spellcheck="false">

<title>Invoice Report</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Generator" content="Microsoft Word 12 (filtered)">
<style>
table.space
{
padding-left: 10px;
}
p
{
	margin:0px;
	padding:0px;
	
}
td
{
	padding-left:10px;
}
.cent
{
text-align: center;
font-family: courier;
font-size: 14px;
font-weight: bold;
}
.sub
{
padding-left: 10px;
font-size: 14px;
font-weight: bold;
}
.sub2
{
padding-left: 32px;
font-size: 14px;
}
.main
{
font-size: 16px;
font-weight: bold;
}
.in
{
padding-top: 10px;
padding-bottom: 10px;
font-family: courier;
font-size: 13px;
font-weight: bold;
}
.in2
{
font-family: courier;
font-size: 14px;
font-weight: bold;
}
.in3
{
text-align: right;
font-family: courier;
font-size: 14px;
font-weight: bold;
}
.quote
{
padding-top:10px;
font-size: 12px;
font-family: sans-serif;
{
.rotatie {
-moz-transform:rotate(-90deg);
-webkit-transform:rotate(-90deg);
-o-transform:rotate(-90deg);
-ms-transform:rotate(-90deg);
}
</style>
<!-- table 1 !-->
<table style="border-style:solid;border:1px;" cellpading="0" class="space" ;="" border="1" cellspacing="0" width="900px">
<tbody>
<tr>
	<th colspan="2" style="border-bottom:0px;" class="main" align="center" nowrap="nowrap" valign="top">
		<?php echo $res_contact['domain_name'];?> - INVOICE #<font face="courier"><?php echo $val_invoice_report[invoice_no];?></font>
	</th>
</tr>
<tr>
	<td colspan="2" style="border-top:0px;" class="sub" align="center">
		SHIPMENT ID <font face="courier"><?php echo $res_trackinfo[tracking_no];?></font>
	</td>
</tr>
<tr>
	<td width="50%">
		<!-- table 2 !-->
		<table width="448" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td class="sub" valign="top" width="224">
				SHIP FROM
			</td>
			<td class="sub" valign="top" width="224">
				SHIP/SELL TO
			</td>
		</tr>
		</tbody>
		</table>
		<!-- table 2 !-->
	</td>
	<td class="sub" width="50%">
		INVOICE INFORMATION
	</td>
</tr>
<tr>
	<td class="in" valign="top" width="50%">
		<!-- table 3 !-->
		<table width="448" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td nowrap="nowrap" valign="top" width="224">
				<?php echo $res_trackinfo[from_name];?><br>
				<?php echo $res_trackinfo[from_address];?><br>
				<?php echo $res_trackinfo[from_city];?><br>
				<?php echo $res_trackinfo[from_state];?><br>
				<?php echo $res_trackinfo[from_zip];?><br>
				<?php echo $res_trackinfo[from_country];?>
			</td>
			<td nowrap="nowrap" valign="top" width="224">
				<?php echo $res_trackinfo[to_name];?><br>
				<?php echo $res_trackinfo[to_address];?><br>
				<?php echo $res_trackinfo[to_city];?><br>
				<?php echo $res_trackinfo[to_state];?><br>
				<?php echo $res_trackinfo[to_zip];?><br>
				<?php echo $res_trackinfo[to_country];?>
			</td>
		</tr>
		</tbody>
		</table>
		<!-- table 3 !-->
	</td>
	<td class="sub" valign="top">
		<div align="center">
			<?php echo draw($code);?>
      </div>
		 Invoice No: <font face="courier"><?php echo $val_invoice_report[invoice_no];?></font>
		<br>
		 Date: <font face="courier"><?php echo $val_invoice_report[dateof_invoice];?></font>
		<br>
		 PO No: <font face="courier">57741005</font>
		<br>
		 Terms: <font face="courier">DDP</font> Reason for Export: <font face="courier">Sale</font>
	</td>
</tr>
<tr>
	<td colspan="2" valign="top">
		<!-- table 4 !-->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
		<tbody>
		<tr class="sub">
			<th>
				Units
			</th>
			<th>
				Type
			</th>
			<th>
				Description/Part No.
			</th>
			<th>
				C/O
			</th>
			<th>
				Price Value
			</th>
			<th>
				Shipping Fee
			</th>
			<th>
				Total Value
			</th>
		</tr>
        <?php
		  $prd_price=$val_invoice_report[price];
		  $shipping_price=$val_invoice_report[shipping_fee];
		  
		  $grand_tot=$prd_price+$shipping_price;
		?>
		<tr class="cent">
			<td>1</td>
			<td>Vehicle</td>
			<td nowrap="nowrap"><?php echo $val_invoice_report[make_model];?></td>
			<td></td>
			<td>
				<?php 
				   if($val_invoice_report[price]!='')
				   {
					 echo number_format($val_invoice_report[price],2);
				   }
				?>
			</td>
			<td>
				<?php 
				  if($val_invoice_report[shipping_fee]!='')
				  {
				  	echo number_format($val_invoice_report[shipping_fee],2);
				  }
				?>
			</td>
			<td>
				<?php
				  if($grand_tot!='')
				  {
				 	 echo number_format($grand_tot,2);
				  }
				?>
            </td>
		</tr>
		</tbody>
		</table>
		<!-- table 4 !-->
	</td>
</tr>
<tr>
	<td colspan="2" class="sub">
		TERMS AND CONDITIONS
	</td>
</tr>
<?php
$percent_fee=$grand_tot*($val_invoice_report[percent_deposite]/100);

$rest_fee=$grand_tot-$percent_fee;

$tot_paid_amt=$val_invoice_report[tot_paid_until_now];
$adtional_amt=$val_invoice_report[additional_amount];
//After adding $tot_paid_amt+$adtional_amt===
$tot_deposite_val=($tot_paid_amt+$adtional_amt);

//After inserting $tot_paid_amt+$adtional_amt $percent_fee will be changed to===
$add_percent_fee=($percent_fee-$tot_deposite_val);

//After inserting $tot_paid_amt+$adtional_amt $grand_tot-$tot_deposite_val will be changed to remaining value===
$remaining_fee=($grand_tot-$tot_deposite_val);
?>
<tr>
	<td colspan="2" class="quote" style="padding-bottom: 10px;">
    	<?php if($val_invoice_report[tot_paid_until_now]==''){ ?>
		 For international transport and sale orders, <?php echo $res_contact['domain_name'];?> requires a <?php echo $val_invoice_report[percent_deposite];?> deposit of the total value, from the intented buyer/receiver, prior to taking any action regarding the transportation / handling and selling of the vehicle in subject. The deposit will be used for customs brokers and transit permits, liability insurance and insurance policy. The deposit will be held by the assigned agent responsible with delivery and selling of vehicle, in a neutral and monitored bank account until the transaction is concluded or cancelled.
        <?php } else { ?>
        An additional deposit is required for an increased insurance coverage.
        <?php } ?><br>
		 Cases:<br>
		 A) If the vehicle is ACCEPTED by the buyer, the deposit of <?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?> (<?php echo $val_invoice_report[percent_deposite];?> OF 
		<?php
          if($grand_tot!='')
          {
             echo number_format($grand_tot,2);
          }
        ?> ) 
        <?php if($add_percent_fee!=''){ ?>
        
        plus -<?php echo number_format($add_percent_fee,2);?> (Transit fees)
        <?php } ?>will be considered as partial payment, and the assigned agent will collect the remaining 
		
        <?php
		  if($remaining_fee!=''){
		?>
        	<?php echo number_format($remaining_fee,2);?>.
        <?php }else { ?>
			<?php if($rest_fee!=''){ echo number_format($rest_fee,2); } ?>.
        <?php } ?><br>
        
		B) If the vehicle is DECLINED by the buyer, the assigned agent will reimburse the buyer with the amount of 
		<?php
		  if($tot_deposite_val!=''){
		?>
			<?php echo number_format($tot_deposite_val,2);?>
        <?php } else { ?>
        	<?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?>
        <?php } ?> , representing the deposit value (<?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?> )
        <?php if($add_percent_fee!=''){ ?>
        
        plus -<?php echo number_format($add_percent_fee,2);?> (Transit fees)
        <?php } ?>.
	</td>
</tr>
<tr>
	<td colspan="2" class="sub">
		BANK TRANSFER INSTRUCTIONS
	</td>
</tr>
<tr>
	<td colspan="2">
		<!-- table 5 !-->
		<table border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td colspan="2" class="quote" style="padding-bottom: 10px;">
				Use the following information for international bank to bank transfers:
			</td>
		</tr>
        <?php
		  foreach($dbf->fetchOrder('tracking_bank_fields',"trackbank_id='$res_bank[id]'","id") as $res_bankdetail){
		?>
		<tr>
		  <td class="sub2" style="text-transform:uppercase;"><?php echo $res_bankdetail[field_descr];?>:</td>
		  <td align="left" class="in2"><?php echo $res_bankdetail[field_value];?></td>
		</tr>
        <?php } ?>
		<tr>
		  <td class="sub2">TOTAL DEBIT: </td>
		  <td align="left" class="in2"><?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?>  <?php echo $val_invoice_report['currency'];?>(Transfer fee NOT included)</td>
		</tr>
		<tr>
		  <td class="sub2">REFERENCE: </td>
		  <td align="left" class="in2"><?php echo $res_trackinfo[tracking_no];?></td>
		</tr>
		<tr>
		  <td colspan="2" class="quote" style="padding-bottom: 10px;">
			<u>Fax or e-mail proof of transfer to confirm your deposit until <font style="font-family: courier;font-weight:bold;">
                
                <?php 
				  $invoice_date=$val_invoice_report[dateof_invoice];
				  $next_invoice_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($invoice_date)) . "+3 days"));
				?>
                <?php $dt=strtotime($next_invoice_date); echo date("d F Y",$dt)?>
                
                </font> , along with a signed copy of this page.</u><br>
				<i>Recommandation:</i> Print this page and use it in your local bank office to remit transfer.
		  </td>
		</tr>
	  </tbody>
	</table>
	<!-- table 5 !-->
  </td>
</tr>
<tr>
  <td class="sub">WARRANTS</td>
  <td class="sub">SUMMARY</td>
</tr>
<tr>
  <td class="quote" valign="top">
    <div class="company"><img src="images/companysignature.png"></div>
	<div class="admin">
      <img src="invoicesignature.php?text=<?php echo $res_admin['invoice_lading_sign'];?>&font=<?php echo $res_admin['invoice_lading_sign_font'];?>&size=<?php echo $res_admin['invoice_lading_font_size'];?>" >
    </div>
		Seller is the sole owner of the vehicle; Such vehicle is free of all encumbrances, security interests, and other defenses against seller; All disclosures to buyer and other matters in connection with such transaction are in all respects as required by, and in accordance with, all applicable laws and regulations governing them; The vehicle is being sold with implied warranty about condition and working order, through annexed Vehicle Inspection Report.
  </td>
  <td valign="top">
	<!-- table 6  !-->
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td class="sub">Prepaid value: </td>
		  <td class="in3">
			<?php 
			  if($val_invoice_report[tot_paid_until_now]!='')
			  {
				echo number_format($val_invoice_report[tot_paid_until_now],2);
			  }
			  else
			  {
				echo "0.00";  
			  }
			?>
		  </td>
		</tr>
		<tr>
		  <td class="sub">Previous Invoice #: </td>
		  <td class="in3">
			<?php 
			  if($val_invoice_report[previous_invoice]!='')
			  {
				 echo $val_invoice_report[previous_invoice];
			  }
			  else
			  {
			   	 echo "-";
			  }
			?>
		  </td>
		</tr>
		<tr>
		  <td class="sub">Sale value:</td>
		  <td class="in3">
			<?php 
			   if($val_invoice_report[price]!='')
			   {
				 echo number_format($val_invoice_report[price],2);
			   }
			?>
		  </td>
		</tr>
		<tr>
			<td class="sub">Shipping and handling:</td>
			<td class="in3">
				<?php 
				  if($val_invoice_report[shipping_fee]!='')
				  {
				  	echo number_format($val_invoice_report[shipping_fee],2);
				  }
				?>
			</td>
		</tr>
		<tr>
			<td class="sub">
				Total value:
			</td>
			<td class="in3">
				<?php
				  if($grand_tot!='')
				  {
				 	 echo number_format($grand_tot,2);
				  }
				?>
			</td>
		</tr>
		<tr>
			<td class="sub">Deposit value:</td>
			<td class="in3">
			<?php 
			  if($tot_deposite_val!=''){
			?>
            	<?php if($tot_deposite_val!=''){ echo number_format($tot_deposite_val,2); }?>
                
            <?php } else { ?>
            
				<?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?>
            <?php } ?></td>
		</tr>
		<tr>
			<td class="sub">Balance:</td>
			<td class="in3">
				<?php
				  if($remaining_fee!=''){
				?>
					<?php echo number_format($remaining_fee,2);?>
				<?php }else { ?>
					<?php if($rest_fee!=''){ echo number_format($rest_fee,2); } ?>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="sub" style="background-color: #000000;">
			</td>
		</tr>
		<tr>
			<td class="sub">Total to pay:</td>
			<td class="in3" style="background-color: #C4C4C4;"><?php echo $val_invoice_report['currency'];?>
			<?php 
			   if($tot_paid_amt!=''){
			?>
				<?php echo number_format($tot_paid_amt,2);?>
            <?php } else { ?>
				<?php if($percent_fee!=''){ echo number_format($percent_fee,2); }?>
            <?php } ?></td>
		</tr>
		</tbody>
	  </table>
	<!-- table 6 !-->
	</td>
</tr>
<tr>
	<td class="in2" valign="bottom">
		<!-- table 7 !-->
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td width="50%">
			</td>
			<td style="font-size:14px;font-family:courier;padding-right:10px;font-weight:bold;" align="right" width="50%">
				<?php echo $val_invoice_report[dateof_invoice];?>
			</td>
		</tr>
		<tr>
			<td style="font-size: 8px;font-family:verdana;" width="50%">Signature</td>
			<td style="font-size:8px;font-family:verdana;padding-right:20px;" align="right" width="50%">Date</td>
		</tr>
		</tbody>
		</table>
		<!-- table 7 !-->
	</td>
	<td class="in2" valign="bottom">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="font-size: 8px;font-family:verdana;" width="50%">Signature</td>
			<td style="font-size:8px;font-family:verdana;padding-right:20px;" align="right" width="50%">Date</td>
		</tr>
	  </table>
	</td>
</tr>
</tbody>
</table>
<style>

.company{
position:absolute;
width: 110px;
height:110px;
margin-top:45px;
margin-left:120px;
opacity:0.6;
filter:alpha(opacity=90);
-moz-transform: rotate(200deg);
-webkit-transform: rotate(200deg);
}

.company img
{
width: 110px;
height:110px;
}

.admin{
z-index:2;
position:absolute;
margin-top:70px;
margin-left:140px;
width:280px;
height:auto;
opacity:0.9;
filter:alpha(opacity=70);
-moz-transform: rotate(-3deg);
-webkit-transform: rotate(6deg);
}

.admin img
{
	width:100%;
	height:auto;
}
</style>
<table border="0" width="900px">
<tbody>
<tr>
	<td style="font-size: 10px;font-family: sans-serif;" align="center" nowrap="nowrap">
		 Transmith Group - Tax ID/VAT# 02316473 - Crawley Park, Husborne Crawley - MK43 0UU Bedford - United Kingdom - Fax: +44-1796250007 - Tel: +44-7961276317
	</td>
</tr>
</tbody>
</table>

<input onClick="if(this.value=='Edit'){this.value='Done';document.body.contentEditable='true';document.designMode='on';} else {this.value='Edit';document.body.contentEditable='false';document.designMode='off';}" ;="" value="Edit" type="button">
<input onClick="rotate();" ;="" value="Rotate" type="button">
<script language="Javascript">
function rotate(){
document.body.className = "rotatie";
}
</script>
</body>
</html>
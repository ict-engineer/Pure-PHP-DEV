<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Bill of Lading Report';
//Object initialization
$dbf = new User();

$res_admin=$dbf->fetchSingle("admin","id='1'");

$bil_reportid=base64_decode(base64_decode($_REQUEST[bil_report]));
$val_bil_report=$dbf->fetchSingle("tracking_system_billof_lading","id='$bil_reportid'");

$res_trackinfo=$dbf->fetchSingle("tracking_system","id='$val_bil_report[tracking_system_id]'");

//For Barcode======================
include '../barcode/Code128.php';
$code = isset($_GET['code']) ? $_GET['code'] :$res_trackinfo[tracking_no]; 
//For Barcode======================

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
</head>
<style>
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
h1
	{margin:0cm;
	margin-bottom:.0001pt;
	page-break-after:avoid;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";}
h2
	{margin:0cm;
	margin-bottom:.0001pt;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";}
h3
	{margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:11.0pt;
	font-family:"Arial","sans-serif";}
h4
	{margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";}
h5
	{margin-top:3.0pt;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:0cm;
	margin-bottom:.0001pt;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";}
	
p
{
	margin:0px;
	padding:0px;
	
}
 /* Page Definitions */
 @page WordSection1
	{size:612.0pt 792.0pt;
	margin:27.0pt 27.0pt 44.95pt 45.0pt;}
div.WordSection1
	{page:WordSection1;}
.rotatie {
-moz-transform:rotate(-90deg);
-webkit-transform:rotate(-90deg);
-o-transform:rotate(-90deg);
-ms-transform:rotate(-90deg);
}
</style>
<body spellcheck="false" lang="EN-GB">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Generator" content="Microsoft Word 12 (filtered)">
<title>Bill of Lading Report</title>
<div class="WordSection1">
	<table class="MsoNormalTable" style="width:558.0pt;margin-left:2.6pt;border-collapse:collapse;border:solid;border-width:1px;border-left:2px;border-top:2px;" border="1" cellpadding="0" cellspacing="0" width="744">
	<!-- table 1 !-->
	<tbody>
	<tr style="height:17.5pt">
	  <td colspan="21" nowrap="nowrap">
        <table width="100%" border="0">
          <tr>
            <td width="150"><h1><span style="position:absolute;z-index:3;margin-left:812px;margin-top: 1044px;width:12px;height:16px">
			</span><span style="font-size:10.0pt" lang="EN-US">Date&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $val_bil_report[dateof_bill];?></font></span></h1></td>
            <td><h2 style="text-align:center" align="center"><span lang="EN-US">Transmith Group - Bill of Lading</span></h2></td>
            <td width="150" align="right"><h1><span style="font-size:10.0pt" lang="EN-US">Page 1 of 1</span></h1></td>
          </tr>
        </table>
	  </td>
	</tr>
	<tr style="height:18.4pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt; border-top:none;background:#E0E0E0;padding:0cm 5.4pt 0cm 5.4pt;height:18.4pt" nowrap="nowrap" width="744">
			<h3><span style="font-size:10.0pt" lang="EN-US">Ship From</span></h3>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<h5><span style="font-size:9.0pt" lang="EN-US">Barcode</span></h5>
		</td>
	</tr>
	<tr style="height:8.8pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoNormal" style="margin-top:3.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Name:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[from_name];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Address&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[from_address];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">City/State/Zip:&nbsp;&nbsp;&nbsp;<font face="courier"> <?php echo $res_trackinfo[from_city];?>, <?php echo $res_trackinfo[from_state];?> - <?php echo $res_trackinfo[from_zip];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Country:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[from_country];?></font></span>
			</p>
			<br>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" align="center" width="368">
			<?php echo draw($code);?>
		</td>
	</tr>
	<tr style="height:8.8pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt; border-top:none;background:#E0E0E0;padding:0cm 5.4pt 0cm 5.4pt;height:18.4pt" nowrap="nowrap" width="744">
			<h3><span style="font-size:10.0pt" lang="EN-US">Ship To</span></h3>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<h5><span style="font-size:9.0pt" lang="EN-US">Carrier Name: Transmith Group LTD</span></h5>
		</td>
	</tr>
	<tr style="height:8.8pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoNormal" style="margin-top:3.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Name: &nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_name];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Address: &nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_address];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">City/State/Zip: &nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_city];?>, <?php echo $res_trackinfo[to_state];?> - <?php echo $res_trackinfo[to_zip];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Country: &nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_country];?></font></span>
			</p>
		  <br>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText">
				<span style="font-size:9.0pt" lang="EN-US">Trailer number: &nbsp;&nbsp;&nbsp;<font face="courier">TR9119242</font><br>
				 Serial number(s):&nbsp;&nbsp;&nbsp;<font face="courier">094857954831</font></span>
			</p>
		</td>
	</tr>
	<tr style="height:8.8pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt; border-top:none;background:#E0E0E0;padding:0cm 5.4pt 0cm 5.4pt;height:18.4pt" nowrap="nowrap" width="744">
			<h3><span style="font-size:10.0pt" lang="EN-US">Third Party Freight Charges Bill to:</span></h3>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Reference Number:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[shippers_ref];?></font></span></b>
			</p>
		</td>
	</tr>
	<tr style="height:43.7pt">
		<td colspan="12" style="width:281.85pt;border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:43.7pt" valign="top" width="744">
			<p class="MsoNormal" style="margin-top:3.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Name:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_name];?></font></span>
			</p>
			<p class="MsoBodyText" style="margin-top:1.0pt">
				<span style="font-size:9.0pt" lang="EN-US">Address:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_address];?></font></span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">City/State/Zip:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_city];?>, <?php echo $res_trackinfo[to_state];?> - <?php echo $res_trackinfo[to_zip];?></font>
				</span>
			</p>
			<p class="MsoNormal" style="margin-top:1.0pt">
				<span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Country:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[to_country];?></font>
				</span>
			</p>
			<br>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid 1.0pt;border-right:solid windowtext 1.0pt;height:43.7pt" align="center" valign="top" width="368">
			<img src="../images/qrcode.png" width="100" height="80">
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="12" rowspan="2" style="width:281.85pt; border:solid windowtext 1.0pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt; height:8.8pt" valign="top" width="744">
			<p class="MsoNormal" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;" lang="EN-US">Special Instructions:</span></b>
			</p>
		</td>
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Freight Charge Terms: </span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:9.0pt" lang="EN-US">Prepaid:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>X</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Collect:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3<sup>rd</sup>
				Party:</span><b><span lang="EN-US"></span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="9" style="width:276.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt;font-family:Symbol" lang="EN-US">&nbsp;</span></b><b><span style="font-size:9.0pt" lang="EN-US">&nbsp; </span></b><span style="font-size:9.0pt" lang="EN-US">Master bill of lading with attached underlying bills of lading<b>.</b></span>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="21" style="width:558.0pt;border:solid windowtext 1.0pt; border-top:none;background:#E0E0E0;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span lang="EN-US">Customer Order Information</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="8" style="width:207.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Customer Order No.</span></b>
			</p>
		</td>
		<td colspan="4" style="width:74.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" nowrap="nowrap" valign="top" width="100">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">No. Packages</span></b>
			</p>
		</td>
		<td style="width:45.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Weight</span></b>
			</p>
		</td>
		<td colspan="4" style="width:63.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="84">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Pallet/Slip<br>
				</span></b><span style="font-size:9.0pt" lang="EN-US"></span>
			</p>
		</td>
		<td colspan="4" style="width:168.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="224">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Additional Shipper Information</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="8" style="width:207.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $res_trackinfo[tracking_no];?></font></span></b>
			</p>
		</td>
		<td colspan="4" style="width:74.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="100">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">1</font></span></b>
			</p>
		</td>
		<td style="width:45.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">1839</font></span></b>
			</p>
		</td>
		<td style="width:27.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="84">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"><b>X</b></span></b>
			</p>
		</td>
		<td colspan="3" style="width:36.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"><b>X</b></span></b>
			</p>
		</td>
		<td colspan="4" style="width:168.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="224">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="8" style="width:207.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="4" style="width:74.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="100">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:45.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:27.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="84">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"></span></b>
			</p>
		</td>
		<td colspan="3" style="width:36.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"></span></b>
			</p>
		</td>
		<td colspan="4" style="width:168.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="224">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="8" style="width:207.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="4" style="width:74.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="100">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:45.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:27.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="84">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"></span></b>
			</p>
		</td>
		<td colspan="3" style="width:36.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="FR-CA"></span></b>
			</p>
		</td>
		<td colspan="4" style="width:168.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="224">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="FR-CA">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="8" style="width:207.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Grand Total</span></b>
			</p>
		</td>
		<td colspan="4" style="width:74.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="100">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:45.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="368">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:36.0pt;border:none;border-bottom: solid windowtext 1.0pt;background:#CCCCCC;padding:0cm 5.4pt 0cm 5.4pt; height:8.8pt" valign="top" width="84">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:27.0pt;border:none;border-bottom: solid windowtext 1.0pt;background:#CCCCCC;padding:0cm 5.4pt 0cm 5.4pt; height:8.8pt" valign="top" width="36">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="4" style="width:168.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; background:#CCCCCC;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="224">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span lang="EN-US">&nbsp;Shipping &amp; Handling:&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $val_bil_report[shipping_fee];?></font></span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="21" style="width:558.0pt;border:solid windowtext 1.0pt; border-top:none;background:#E0E0E0;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span lang="EN-US">Carrier Information</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="2" style="width:72.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Handling Unit</span></b>
			</p>
		</td>
		<td colspan="17" style="width:378.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Package</span></b>
			</p>
		</td>
		<td colspan="2" style="width:108.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">LTL Only</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Qty</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Type</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Qty</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Type</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Weight</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">U/M</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Description</span><span lang="EN-US"><br>
				</span></b><span style="font-size:6.0pt" lang="EN-US"></span>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">NMFC No.</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt;text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">Class</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">1</font></span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">Vehicle</font></span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">1</font></span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">Vehicle</font></span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">1839</font></span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">KG</font></span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $val_bil_report[make_model];?></font></span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;&nbsp;&nbsp;&nbsp;<font face="courier">13912741</font></span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;<font face="courier">Container</font></span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border-top:none;border-left:solid windowtext 1.0pt; border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td style="width:36.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:36.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; background:black;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="48">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:54.0pt;border-top:none;border-left:none; border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="504">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:20.8pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; background:black;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="28">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="2" style="width:45.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="60">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td colspan="10" style="width:213.2pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="284">
			<p class="MsoBodyText" style="text-align:center" align="center">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:50.65pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="144">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
		<td style="width:57.35pt;border-top:none;border-left: none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="76">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">&nbsp;</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="11" style="width:277.35pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:6.0pt" lang="EN-US">Where the rate is dependent on value, shippers are required to state specifically in writing the agreed or declared value of the property as follows: "The agreed or declared value of the property is specifically stated by the shipper to be not exceeding <u>&nbsp;&nbsp;<font face="courier"><?php echo $val_bil_report[price];?></font>&nbsp;&nbsp;</u></span>
			</p>
		</td>
		<td colspan="10" style="width:280.65pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" nowrap="nowrap" valign="top" width="374">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:8.0pt" lang="EN-US">COD Amount: <u>&nbsp;&nbsp;&nbsp;<font face="courier"><?php echo $val_bil_report[price];?></font>&nbsp;&nbsp;&nbsp;</u></span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:8.0pt" lang="EN-US">Free terms: Collect <u>X</u>, Prepaid <u>&nbsp;&nbsp;&nbsp;</u>, Customer check acceptable <u>&nbsp;&nbsp;&nbsp;</u></span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="21" style="width:558.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Liability limitation for loss or damage in this shipment is: &nbsp;&nbsp;<font face="courier">NOT APPLICABLE</font></span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:8.8pt">
		<td colspan="10" style="width:245.85pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="744">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:6.0pt" lang="EN-US">Received, subject to individually determined rates or contracts that have been agreed upon in writing between the carrier and shipper, if applicable, otherwise to the rates, classifications and rules that have been established by the carrier and are available to the shipper, on request, and to all applicable state and federal regulations.</span>
			</p>
		</td>
		<td colspan="11" style="width:312.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:8.8pt" valign="top" width="416">
			<div class="company"><img src="images/companysignature.png"></div>
            <div  class="admin"><img src="invoicesignature.php?text=<?php echo $res_admin[invoice_lading_sign];?>&font=<?php echo $res_admin[invoice_lading_sign_font];?>"></div>


    		<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:8.0pt" lang="EN-US">The carrier shall not make delivery of this shipment without full payment.</span></b>
			</p>
		</td>
	</tr>
	<tr style="page-break-inside:avoid;height:53.5pt" valign="top">
		<td colspan="6" style="width:180.0pt;border:solid windowtext 1.0pt; border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:53.5pt" nowrap="nowrap" valign="top" width="744">
			<div class="client"><img src="billofladingsignature.php?text=<?php echo $res_admin[billof_lading_signature];?>&font=<?php echo $res_admin[billof_lading_signature_font];?>" ></div>
            <p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Shipper Signature/Date</span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:6.0pt" lang="EN-US">This is to certify that the above named materials are properly classified, packaged, marked and labeled, and are in proper condition for transportation according to the applicable regulations of the DOT.</span>
			</p>
			<br>
			<p class="MsoBodyText">
				<span style="font-size:6.0pt" lang="EN-US">&nbsp;</span>
			</p>
			<p>
			</p>
			<p class="MsoBodyText">
				<span style="font-size:2.0pt" lang="EN-US">&nbsp;</span>
			</p>
			<p>
			</p>
			<p class="MsoBodyText" style="border:none;padding:0cm" align="right">
				<span style="font-size:6.0pt" lang="EN-US">&nbsp;<font face="courier" size="3px"><?php echo $val_bil_report[dateof_bill];?></font>&nbsp;&nbsp;&nbsp;</span>
			</p>
			<p class="MsoBodyText">
				<span style="font-size:6.0pt" lang="EN-US"><br>
				 Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date</span>
			</p>
		</td>
		<td colspan="4" style="width:65.85pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:53.5pt" valign="top" width="88">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:8.0pt" lang="EN-US">Trailer Loaded:</span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:8.0pt" lang="EN-US">_ By shipper</span>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:8.0pt" lang="EN-US"><b><u>X</u></b> By driver</span>
			</p>
		</td>
		<td colspan="6" style="width:135.0pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:53.5pt" valign="top" width="416">
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Freight Counted:</span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:8.0pt" lang="EN-US">_ By shipper</span>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:8.0pt" lang="EN-US"><b><u>X</u></b> By driver/pallets said to contain</span>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:8.0pt" lang="EN-US">_ By driver/pieces</span>
			</p>
		</td>
		<td colspan="5" style="width:177.15pt;border-top:none; border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:53.5pt" valign="top">
			
            
            <p class="MsoBodyText" style="margin-top:3.0pt">
				<b><span style="font-size:9.0pt" lang="EN-US">Carrier Signature/Pickup Date</span></b>
			</p>
			<p class="MsoBodyText" style="margin-top:3.0pt">
				<span style="font-size:6.0pt" lang="EN-US">Carrier acknowledges receipt of packages and required placards. Carrier certifies emergency response information was made available and/or carrier has the DOT emergency response guidebook or equivalent documentation in the vehicle<b>. Property described above is received in good order, except as noted.</b></span>
			</p>
			<br>
			<p class="MsoBodyText">
				<span style="font-size:6.0pt" lang="EN-US">&nbsp;</span>
			</p>
			<p>
			</p>
			<p class="MsoBodyText" style="border:none;padding:0cm" align="right">
				<span style="font-size:6.0pt" lang="EN-US">&nbsp;<font face="courier" size="3px"><?php echo $val_bil_report[dateof_bill];?></font>&nbsp;&nbsp;&nbsp;</span>
			</p>
			<p class="MsoBodyText">
				<span style="font-size:6.0pt" lang="EN-US"><br>
				 Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date</span>
			</p>
		</td>
	</tr>
	<tr height="0">
		<td style="border:none" width="744">
		</td>
		<td style="border:none" width="48">
		</td>
		<td style="border:none" width="504">
		</td>
		<td style="border:none" width="28">
		</td>
		<td style="border:none" width="396">
		</td>
		<td style="border:none" width="60">
		</td>
		<td style="border:none" width="88">
		</td>
		<td style="border:none" width="60">
		</td>
		<td style="border:none" width="100">
		</td>
		<td style="border:none" width="284">
		</td>
		<td style="border:none" width="416">
		</td>
		<td style="border:none" width="374">
		</td>
		<td style="border:none" width="368">
		</td>
		<td style="border:none" width="84">
		</td>
		<td style="border:none" width="48">
		</td>
		<td style="border:none" width="36">
		</td>
		<td style="border:none" width="12">
		</td>
		<td style="border:none" width="224">
		</td>
		<td style="border:none" width="168">
		</td>
		<td style="border:none" width="144">
		</td>
		<td style="border:none" width="76">
		</td>
	</tr>
	</tbody>
	</table>
	<!-- table 1  !-->
<p class="MsoNormal">
		<span lang="EN-US">&nbsp;</span>
	</p>
</div>
<style>

/*FOR LOCATE IMAGE IN DIFFERENT POSITION********************/
.client{
position:absolute;
margin-top:40px;
margin-left:8px;
width:250px;
height:auto;
opacity:0.9;
filter:alpha(opacity=70);
-moz-transform: rotate(-2deg);
-webkit-transform: rotate(-2deg);
}

.client img
{
	width:100%;
	height:auto;
}

.company{
position:absolute;
width: 110px;
height:110px;
margin-top:0px;
margin-left:100px;
opacity:0.6;
filter:alpha(opacity=90);
-moz-transform: rotate(180deg);
-webkit-transform: rotate(180deg);
}

.company img
{
width: 110px;
height:110px;
}

.admin{
z-index:2;
position:absolute;
margin-top:40px;
margin-left:120px;
width:300px;
height:auto;
opacity:0.9;
filter:alpha(opacity=70);
-moz-transform: rotate(10deg);
-webkit-transform: rotate(10deg);
}

.admin img
{
	width:100%;
	height:auto;
}
</style>

<div style="clear:both; padding:20px 0px 20px 8px;">
<input onClick="if(this.value=='Edit'){this.value='Done';document.body.contentEditable='true';document.designMode='on';} else {this.value='Edit';document.body.contentEditable='false';document.designMode='off';}" ;="" value="Edit" type="button">
<input onClick="rotate();" ;="" value="Rotate" type="button">
<script language="Javascript">
function rotate(){
document.body.className = "rotatie";
}
</script>
</div>
</body>
</html>
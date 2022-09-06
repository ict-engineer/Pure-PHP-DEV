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

$num=$dbf->countRows('tracking_system',"tracking_no='$_REQUEST[trackingno]' AND active_status='1'");
if($num==0)
{
	header("Location:tracking?msg=exist");
}
else
{
	$tracking_info=$dbf->fetchSingle("tracking_system","tracking_no='$_REQUEST[trackingno]'");
}

//Fetch data for Vehicle Inspection Report==========================
$res_vir_report=$dbf->fetchSingle("tracking_system_vehicle_report","tracking_system_id='$tracking_info[id]'");

//Fetch data for Bill of Lading Report==============================
$res_bil_report=$dbf->fetchSingle("tracking_system_billof_lading","tracking_system_id='$tracking_info[id]'");

//Fetch data for Invoice Report=====================================
$res_invoice_report=$dbf->fetchSingle("tracking_system_invoice","tracking_system_id='$tracking_info[id]'");

//For Barcode======================
include 'barcode/Code128.php';
$code = isset($_GET['code']) ? $_GET['code'] :$tracking_info[tracking_no]; 
//For Barcode======================
?>
<style>
#package_descr p{
	padding:0px;
	margin:0px;
}
</style>

<body> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv" style="width:100%;"> <div class="contentsec"> <h1>Transmith Group <span>TRACKING</span></h1> <div class="contxt"> <div class="trackingsmalldiv"> <div class="trackingdetailhead">TRACKING NUMBER: <?php echo $_REQUEST[trackingno];?></div> <div class="trackinginnerdiv" align="center"><?php echo draw($code);?></div> </div> <div class="trackingsmalldiv"> <div class="trackingdetailhead">SHIPPER'S REFFERENCE: <?php echo $tracking_info[shippers_ref];?></div> <div class="trackinginnerdiv" align="center"><img src="images/qrcode.png"></div> </div> <div class="spacer2"></div> <div class="trackingsmalldiv"> <div class="trackingdetailhead">PICK-UP INFO:</div> <div class="trackingtextdiv"> <strong>AGENT :</strong> <?php echo $tracking_info[pickup_agent];?><br> <strong>DATE & TIME :</strong> <?php echo $tracking_info[pickup_date];?><br> <strong>FROM :</strong> <?php echo $tracking_info[from_name];?><br> <?php echo $tracking_info[from_address];?><br> <?php echo $tracking_info[from_state];?> - <?php echo $tracking_info[from_zip];?><br> <?php echo $tracking_info[from_country];?> </div> </div> <div class="trackingsmalldiv"> <div class="trackingdetailhead">DELIVERY INFO:</div> <div class="trackingtextdiv"> <strong>AGENT :</strong> <?php echo $tracking_info[delivery_agent];?><br> <strong>DATE & TIME :</strong> <?php echo $tracking_info[delivery_date];?><br> <strong>TO :</strong> <?php echo $tracking_info[to_name];?><br> <?php echo $tracking_info[to_address];?><br> <?php echo $tracking_info[to_state];?> - <?php echo $tracking_info[to_zip];?><br> <?php echo $tracking_info[to_country];?> </div> </div> <div class="spacer2"></div> <div class="trackingdetailhead">PACKAGE:</div> <div class="trackingsmalldiv"> <div class="trackingtextdiv"> <strong>PACKAGE DESCRIPTION</strong><br> <span id="package_descr"><?php echo $tracking_info[package_description];?></span><br> <strong>PACKAGE WEIGHT :</strong> <?php echo $tracking_info[package_weight];?> </div> </div> <div class="trackingsmalldiv"> <div class="trackingtextdiv"> <strong>PACKAGE CONTENTS</strong><br> <span id="package_descr"><?php echo $tracking_info[package_contents];?></span><br> <strong>PACKAGE INSURANCE :</strong> <?php echo $tracking_info[package_insurance];?> </div> </div> <div class="spacer2"></div> <div class="trackingdetailhead">SHIPPER'S CERTIFICATION:</div> <div class="trackingsmalldiv"> <div class="trackingtextdiv"> <strong>ID TYPE :</strong> <?php echo $tracking_info[shippersid_type];?><br><strong>ID NUMBER:</strong> <?php echo $tracking_info[shippersid_no];?> </div> </div> <div class="spacer2"></div> <div class="trackingdetailhead">Package Status</div> <div class="trackingtextdiv"> <span id="package_descr"><?php echo $tracking_info[package_status_route_descr];?></span> </div> <div class="spacer2"></div> <div class="trackingdetailhead">Shipping Route</div> <div class="trackingmap"> <?php if($tracking_info[package_status]=='3'){ ?> <iframe noresize="noresize" frameborder="0" border="0" cellspacing="0" scrolling="no" marginwidth="0" marginheight="0" style="width: 100%; height: 100%;" src="maptracking.php?trackingnumber=<?php echo $tracking_info[tracking_no];?>"></iframe> <?php } ?> <?php if($tracking_info[package_status]=='2'){ ?> <img src="http://maps.googleapis.com/maps/api/staticmap?size=1000x200&markers=icon:http://www.google.com/mapfiles/dd-start.png|<?php echo $tracking_info[from_city];?>,<?php echo $tracking_info[from_country];?>&markers=icon:http://www.google.com/mapfiles/dd-end.png|<?php echo $tracking_info[to_city];?>,<?php echo $tracking_info[to_country];?>&sensor=false&maptype=roadmap" style="width:100%; height:100%;"> <?php } ?> <?php if($tracking_info[package_status]=='1'){ ?> <img src="../upload_route/<?php echo $tracking_info[upload_route];?>" height="100%" width="100%"> <?php } ?> </div> <div class="spacer2"></div> <div class="trackingdetailhead">UPLOADED DOCUMENTS:</div> <?php if($res_vir_report[uploaded_report]!=''){ ?> <div class="trackbilldiv"> <div class="trackbillhead"><a href="vehicle_report/<?php echo $res_vir_report[uploaded_report];?>" target="_blank">Vehicle Inspection Report</a></div> <div class="trackingbill" align="center"><a href="vehicle_report/<?php echo $res_vir_report[uploaded_report];?>" title="Vehicle Inspection Report" alt="Vehicle Inspection report" target="_blank"><img src="vehicle_report/<?php echo $res_vir_report[uploaded_report];?>" width="150" height="200" border="0"></a></div> </div> <?php } ?> <?php if($res_bil_report[uploaded_lading]!=''){ ?> <div class="trackbilldiv"> <div class="trackbillhead"><a href="billoflading_report/<?php echo $res_bil_report[uploaded_lading];?>" target="_blank">Bill Of Lading (BOL)</a></div> <div class="trackingbill" align="center"><a href="billoflading_report/<?php echo $res_bil_report[uploaded_lading];?>" title="Bill of Lading" alt="Bill of Lading" target="_blank"><img src="billoflading_report/<?php echo $res_bil_report[uploaded_lading];?>" height="200" width="150" border="0"></a></div> </div> <?php } ?> <?php if($res_invoice_report[uploaded_invoice]!='') { ?> <div class="trackbilldiv"> <div class="trackbillhead"><a href="invoice_report/<?php echo $res_invoice_report[uploaded_invoice];?>" target="_blank">Invoice</a></div> <div class="trackingbill" align="center"><a href="invoice_report/<?php echo $res_invoice_report[uploaded_invoice];?>" title="Vehicle Inspection Report" alt="Vehicle Inspection report" target="_blank"><img src="invoice_report/<?php echo $res_invoice_report[uploaded_invoice];?>" width="150" height="200" border="0"></a></div> </div> <?php } ?> <?php if($tracking_info[proof_of_transfer]!='') { ?> <div class="trackbilldiv"> <div class="trackbillhead"><a href="proof_of_transfer/<?php echo $tracking_info[proof_of_transfer];?>" target="_blank">Proof of Transfer</a></div> <div class="trackingbill" align="center"><a href="proof_of_transfer/<?php echo $tracking_info[proof_of_transfer];?>" title="Proof of Transfer" alt="Proof of Transfer" target="_blank"><img src="proof_of_transfer/<?php echo $tracking_info[proof_of_transfer];?>" width="150" height="200" border="0"></a></div> </div> <?php } ?> <div class="spacer1"></div> <div align="center"></div> <div class="spacer1"></div> <div align="center"></div> <div class="spacer1"></div> <div class="spacer1"></div><div align="center"><img src="images/trackingsoft.jpg" /></div><div></div></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="spacer2"></div><div class="spacer1"></div></div></div></body></html><script> window.print();</script>
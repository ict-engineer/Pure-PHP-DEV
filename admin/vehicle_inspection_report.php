<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Vehicle Inspection Report';
//Object initialization
$dbf = new User();

$res=$dbf->fetchSingle("admin","id='1'");
$res_contact=$dbf->fetchSingle("contact","id='1'");

$vir_reportid=base64_decode(base64_decode($_REQUEST[vir_report]));
$val_vir_report=$dbf->fetchSingle("tracking_system_vehicle_report","id='$vir_reportid'");
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<style>
td.cub{border:1px solid;empty-cells:show;width:35px;height:17px;}
td.cubmic{border:1px solid;empty-cells:show;width:12px;height:12px;}
td.cubmicc{border:1px solid;empty-cells:show;width:12px;height:12px;background:black;}
td.cubc{border:1px solid;empty-cells:show;width:35px;height:17px;background:black;}
td.line{empty-cells:show;height:17px;border-bottom:solid;border-width:1px;}
.contur{ border:1px; border-style:solid; }
td.top{text-align:center;border:none; }
td.uline{border-spacing:0;padding:0px;empty-cells:show;height:17px;border-bottom:solid;border-left:solid;border-right:solid;border-width:1px; }
.rotatie {
-moz-transform:rotate(-90deg);
-webkit-transform:rotate(-90deg);
-o-transform:rotate(-90deg);
-ms-transform:rotate(-90deg);
}

/*FOR LOCATE IMAGE IN DIFFERENT POSITION********************/
.company{
position:absolute;
width: 110px;
height:110px;
margin-top:-5px;
margin-left:70px;
opacity:0.6;
filter:alpha(opacity=90);
-moz-transform: rotate(120deg);
-webkit-transform: rotate(120deg);
}

.company img
{
width: 110px;
height:110px;
}

.admin{
z-index:2;
position:absolute;
margin-top:-10px;
margin-left:80px;
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


<body spellcheck="false" ;="">

<title>Vehicle Inspection Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<table valign="middle" style="border: 1px solid; padding:-1px;" align="left" width="750px">
<tr>
	<td align="center">
		<table name="main" border="0" width="700px">
		<tr>
			<td name="main">
				<table name="title" border="0" width="100%">
				<tr>
					<td align="center">
						<h3>VEHICLE&nbsp;INSPECTION&nbsp;REPORT</h3>
					</td>
				</tr>
				<tr>
					<td>
						<b>Select all that apply:</b>
					</td>
				</tr>
				</table>
				<table name="checkboxes" style="font-size:12px;" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
					</td>
					<td class="cubmic">
					</td>
					<td width="17%">
						&nbsp;Bus
					</td>
					<td>
					</td>
					<td class="cubmicc">
					</td>
					<td width="17%">
						&nbsp;Car
					</td>
					<td>
					</td>
					<td class="cubmic">
					</td>
					<td width="17%">
						&nbsp;Other
					</td>
					<td>
					</td>
					<td class="cubmicc">
					</td>
					<td width="17%">
						&nbsp;Initial Inspection
					</td>
					<td>
					</td>
					<td class="cubmic">
					</td>
					<td width="17%">
						&nbsp;Re-inspection
					</td>
				</tr>
				</table>
				<table name="bus_only" style="font-size:12px;" border="0" width="100%">
				<tr>
					<td collspan="4">
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						DOT&nbsp;No.&nbsp;(Bus&nbsp;only)
					</td>
					<td class="line" width="30%">
					</td>
					<td width="60%">
					</td>
				</tr>
				</table>
				<br>
				<table name="info" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						&nbsp;&nbsp;Make&nbsp;/&nbsp;Model&nbsp;
					</td>
					<td class="line" align="center" nowrap="nowrap" width="45%">
						<font face="courier"><?php echo $val_vir_report[make_model];?></font>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;Year&nbsp;
					</td>
					<td class="uline" align="center" width="10%">
						<font face="courier"><?php echo $val_vir_report[year];?></font>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;Odometer&nbsp;
					</td>
					<td class="line" align="center" width="25%">
						<font face="courier"><?php echo $val_vir_report[millage];?></font>
					</td>
				</tr>
				</table>
				<br>
				<table name="info2" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						&nbsp;&nbsp;Power&nbsp;(HP)&nbsp;
					</td>
					<td class="line" align="center" width="25%">
						<font face="courier"><?php echo $val_vir_report[power];?></font>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;Transmission&nbsp;
					</td>
					<td class="line" align="center" width="40%">
						<font face="courier"><?php echo $val_vir_report[transmission];?></font>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;Fuel&nbsp;
					</td>
					<td class="line" align="center" width="35%">
						<font face="courier"><?php echo $val_vir_report[fuel];?></font>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td name="main" width="100%">
				<table style="font-size:10px;" cellpading="0" name="secondary" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<table style="font-size:12px;" cellpading="0" name="secondary-first" border="0" cellspacing="0" width="100%">
						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td class="top">
								P
							</td>
							<td class="top">
								R
							</td>
							<td class="top">
								N/A
							</td>
						</tr>
						<tr>
							<td>
								1.
							</td>
							<td>
								Headlights
							</td>
							<td>
								1
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								2.
							</td>
							<td>
								Parking Lights
							</td>
							<td>
								2
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								3.
							</td>
							<td>
								Tail Light
							</td>
							<td>
								3
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								4.
							</td>
							<td>
								Brake Light
							</td>
							<td>
								4
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								5.
							</td>
							<td>
								Directional Signal
							</td>
							<td>
								5
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								6.
							</td>
							<td>
								Hazardous Warning Signal&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								6
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								7.
							</td>
							<td>
								Clearance Lamp
							</td>
							<td>
								7
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								8.
							</td>
							<td>
								Side Marker Lamp
							</td>
							<td>
								8
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								9.
							</td>
							<td>
								Identification Lamp
							</td>
							<td>
								9
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								10.
							</td>
							<td>
								Reflectors
							</td>
							<td>
								10
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								11.
							</td>
							<td>
								Brakes
							</td>
							<td>
								11
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								12.
							</td>
							<td>
								Steering System
							</td>
							<td>
								12
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								13.
							</td>
							<td>
								Suspension
							</td>
							<td>
								13
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								14.
							</td>
							<td>
								Windshield Wiper
							</td>
							<td>
								14
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								15.
							</td>
							<td>
								Horns
							</td>
							<td>
								15&nbsp;&nbsp;&nbsp;
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								16.
							</td>
							<td>
								Exhaust System
							</td>
							<td>
								16
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								17.
							</td>
							<td>
								Fuel System
							</td>
							<td>
								17
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								18.
							</td>
							<td>
								Engine Compartment
							</td>
							<td>
								18
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								19.
							</td>
							<td>
								Service Door
							</td>
							<td>
								19
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								20.
							</td>
							<td>
								Emergency Door
							</td>
							<td>
								20
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						<tr>
							<td>
								21.
							</td>
							<td>
								Emergency Exit
							</td>
							<td>
								21
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						<tr>
							<td>
								22.
							</td>
							<td>
								Inside Rearview Mirror
							</td>
							<td>
								22
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								23.
							</td>
							<td>
								Outside Rearview Mirror
							</td>
							<td>
								23
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						</table>
					</td>
					<td width="30">
					</td>
					<td>
						<!-- table 9 !-->
						<table style="font-size:12px;" cellpading="0" name="secondary-second" border="0" cellspacing="0" width="100%">
						<tbody>
						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td class="top">
								P
							</td>
							<td class="top">
								R
							</td>
							<td class="top">
								N/A
							</td>
						</tr>
						<tr>
							<td>
								24.
							</td>
							<td>
								Sideview Mirror
							</td>
							<td>
								24
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								25.
							</td>
							<td>
								Crossover Mirror
							</td>
							<td>
								25
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						<tr>
							<td>
								26.
							</td>
							<td>
								Fire Extinguisher
							</td>
							<td>
								26
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								27.
							</td>
							<td>
								First Aid Kid
							</td>
							<td>
								27
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>

						</tr>
						<tr>
							<td>
								28.
							</td>
							<td>
								Emergency Warning Device&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								28
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								29.
							</td>
							<td>
								Windshield
							</td>
							<td>
								29
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								30.
							</td>
							<td>
								Windows
							</td>
							<td>
								30
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								31.
							</td>
							<td>
								Rub Rails
							</td>
							<td>
								31
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								32.
							</td>
							<td>
								Bumpers
							</td>
							<td>
								32
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								33.
							</td>
							<td>
								Pupil Warning Lamp System
							</td>
							<td>
								33
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								34.
							</td>
							<td>
								Stop Arm
							</td>
							<td>
								34
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								35.
							</td>
							<td>
								Drive Shaft Guards
							</td>
							<td>
								35
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								36.
							</td>
							<td>
								Neutral Safety Switch
							</td>
							<td>
								36
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								37.
							</td>
							<td>
								Tires
							</td>
							<td>
								37
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								38.
							</td>
							<td>
								Wheels
							</td>
							<td>
								38&nbsp;&nbsp;&nbsp;
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								39.
							</td>
							<td>
								Seating + Driver Seat Belt
							</td>
							<td>
								39
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								40.
							</td>
							<td>
								Interior Lights
							</td>
							<td>
								40
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								41.
							</td>
							<td>
								Unsecured Items
							</td>
							<td>
								41
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						<tr>
							<td>
								42.
							</td>
							<td>
								Bus Condition
							</td>
							<td>
								42
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
							<td class="cubc">
							</td>
						</tr>
						<tr>
							<td>
								43.
							</td>
							<td>
								Electrical System
							</td>
							<td>
								43
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								44.
							</td>
							<td>
								Tag + Registration
							</td>
							<td>
								44
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								45.
							</td>
							<td>
								Tag Light
							</td>
							<td>
								45
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						<tr>
							<td>
								46.
							</td>
							<td>
								Liability Insurance
							</td>
							<td>
								46
							</td>
							<td class="cubc">
							</td>
							<td class="cub">
							</td>
							<td class="cub">
							</td>
						</tr>
						</tbody>
						</table>
						<!-- table 9 !-->
					</td>
				</tr>
				<tr>
					<td collspan="6">
						Code: P=Pass R=Rejected N/A=Not Applicable
					</td>
				</tr>
				<tr>
				</tr>
				</table>
				<!-- table 7 !-->
			</td>
		</tr>
		<tr>
			<td name="main">
				<!-- table 10 !-->
				<table name="third-first" valign="top" border="0" width="100%">
				<tbody>
				<tr>
					<td>
						Comments
					</td>
					<td class="line" align="center" width="100%">
						<font face="courier">14. Replaced (Reduced efficiency).</font>
					</td>
				</tr>
				<tr>
					<td class="line" colspan="2" width="100%">
					</td>
				</tr>
				<tr>
					<td class="line" colspan="2" width="100%">
					</td>
				</tr>
				<tr>
					<td class="line" colspan="2" width="100%">
					</td>
				</tr>
				</tbody>
				</table>
				<!-- table 10 !-->
				<!-- table 11 !-->
				<table name="third-second" valign="top" border="0" width="100%">
				<tbody>
				<tr>
					<td width="50%" valign="top">
						<!-- table 12 !-->
						<table name="third-second-first" valign="top" border="0">
						<tbody>
						<tr>
							<td>
								Inspected&nbsp;by
							</td>
							<td class="line" align="center" width="600px">
								<font face="courier"><?php echo $val_vir_report[inspected_by];?></font>
							</td>
						</tr>
						</tbody>
						</table>
						<!-- table 12 !-->
					</td>
					<td width="50%">
                   <div class="company"> <img src="images/companysignature.png"></div>
				   <div class="admin"><img src="inspectionsignature.php?text=<?php echo $res[inspection_report_sign];?>&font=<?php echo $res[inspection_report_sign_font];?>&size=<?php echo $res['inspection_report_font_size'];?>" ></div>

						<!-- table 13 !-->
						<table name="third-second-second" valign="top" border="0">
						<tbody>
						<tr>
							<td>
								ID&nbsp;#&nbsp;
							</td>
							<td class="uline" align="center" width="30%">
								<font face="courier"><?php echo $val_vir_report[id];?></font>
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;Date&nbsp;
							</td>
							<td class="uline" align="center" nowrap="nowrap" width="60%">
								<font face="courier"><?php echo $val_vir_report[inspection_date];?></font>
							</td>
						</tr>
						</tbody>
						</table>
						<!-- table 13 !-->
					</td>
				</tr>
				</tbody>
				</table>
				<!-- table 11 !-->
				<!-- table 14 !-->
				<table name="forth" valign="top" border="0" width="100%">
				<tbody>
				<tr>
					<td width="50%">
						<!-- table 15 !-->
						<table name="forth-first" valign="top" border="0">
						<tbody>
						<tr>
							<td>
								Business&nbsp;Name
							</td>
							<td class="line" align="center" width="600px">
								<font face="courier"><?php echo $res_contact['domain_name'];?></font>
							</td>
						</tr>
						</tbody>
						</table>
						<!-- table 15 !-->
					</td>
					<td width="50%">
						<!-- table  16 !-->
						<table name="forth-second" valign="top" border="0">
						<tbody>
						<tr>
							<td>Contact&nbsp;Nr.&nbsp;</td>
							<td class="uline" align="center" width="100%"><font face="courier"><?php echo $res_contact['tel_no'];?></font></td>
						</tr>
						</tbody>
						</table>
						<!-- table 16 !-->
					</td>
				</tr>
				</tbody>
				</table>
				<!-- table 14 !-->
				<!-- table 17  !-->
				<table name="fifth" valign="top" border="0" width="100%">
				<tbody>
				<tr>
					<td nowrap="nowrap" valign="top" width="50%">
						<!-- table 18 !-->
						<table name="fifth-first" valign="top" border="0">
						<tbody>
						<tr>
							<td>Address</td>
							<td class="line" align="center" width="100%"><font face="courier"><?php echo $res_contact['address'];?></font></td>
						</tr>
						<tr>
							<td class="line" colspan="2" align="center" width="100%"><font face="courier"><?php echo $res_contact['postcode'];?> <?php echo $res_contact['location'];?></font></td>
						</tr>
						<tr>
							<td class="line" colspan="2" align="center" width="100%"><font face="courier"><?php echo $res_contact['country'];?></font></td>
						</tr>
						</tbody>
						</table>
						<!-- table 18 !-->
					</td>
					<td width="50%">
						<!-- table 19 !-->
						<table class="contur" name="fifth-second" valign="top" width="100%">
						<tbody>
						<tr>
							<td>
								<!-- table 20 !-->
								<table name="fifth-third" valign="top" border="0">
								<tbody>
								<tr>
									<td>
										<!-- table 21 !-->
										<table name="fifth-third" valign="top" style="font-size:12px;" border="0">
										<tbody>
										<tr>
											<td>
											</td>
											<td class="cubmicc">
											</td>
											<td>
												Approved
											</td>
											<td>
											</td>
											<td class="cubmic">
											</td>
											<td>
												Rejected
											</td>
											<td>
											</td>
											<td class="cubmic">
											</td>
											<td>
												Passed&nbsp;Re-inspection
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td>
											</td>
											<td class="cubmic">
											</td>
											<td colspan="8">
												Unsafe&nbsp;Vehicle&nbsp;-&nbsp;Do&nbsp;Not&nbsp;Transport&nbsp;Children
											</td>
										</tr>
										<tr>
											<td colspan="10">
												 CANNOT BE APPROVED UNTIL ALL ITEMS ARE FOUND SATISFACTORY FOR SAFE OPERATION.
											</td>
										</tr>
										</tbody>
										</table>
										<!-- table 21 !-->
									</td>
								</tr>
								</tbody>
								</table>
								<!-- table 20 !-->
							</td>
						</tr>
						</tbody>
						</table>
						<!-- table 19 !-->
					</td>
				</tr>
				</tbody>
				</table>
				<!-- table 17 !-->
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>



<div style="clear:both; padding:20px 0px 20px 8px;">
    <input onClick="if(this.value=='Edit'){this.value='Done';document.body.contentEditable='true';document.designMode='on';} else {this.value='Edit';document.body.contentEditable='false';document.designMode='off';}" value="Edit" type="button">
    <input onClick="rotate();" value="Rotate" type="button">
    <script language="Javascript">
		function rotate(){
		document.body.className = "rotatie";
		}
	</script>
</div>


</body>
</html>
<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Manage Tracking Number';
include 'application_top.php';
//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
	header("location:index.php");
	exit;
}

if($_REQUEST['action']=='delete')
{
	//Delete data from tracking_system Table=======================================
	$dbf->deleteFromTable("tracking_system","id='$_REQUEST[id]'");
		
		//For unlink the existing "upload_route" AND "proof_of_transfer"===
		$unlink_route_prof_trans=$dbf->fetchSingle("tracking_system","id='$_REQUEST[id]'");
		
		$path1="../upload_route/".$unlink_route_prof_trans[upload_route];
		$path2="../proof_of_transfer/".$unlink_route_prof_trans[proof_of_transfer];
		unlink($path1);
		unlink($path2);
		
	
	//Delete data from tracking_system_vehicle_report Table========================
	$dbf->deleteFromTable("tracking_system_vehicle_report","tracking_system_id='$_REQUEST[id]'");
		
		//For unlink the existing vehicle_report
		$unlink_vir=$dbf->fetchSingle("tracking_system_vehicle_report","tracking_system_id='$_REQUEST[id]'");
		$path3="../vehicle_report/".$unlink_vir[uploaded_report];
		unlink($path3);
		
	
	//Delete data from tracking_system_billof_lading Table=========================
	$dbf->deleteFromTable("tracking_system_billof_lading","tracking_system_id='$_REQUEST[id]'");
	
		//For unlink the existing billoflading_report
		$unlink_bol=$dbf->fetchSingle("tracking_system_billof_lading","tracking_system_id='$_REQUEST[id]'");
		$path4="../billoflading_report/".$unlink_bol[uploaded_lading];
		unlink($path4);
		
	
	//Delete data from tracking_system_invoice Table===============================
	$dbf->deleteFromTable("tracking_system_invoice","tracking_system_id='$_REQUEST[id]'");
	
		//For unlink the existing vehicle_report
		$unlink_invoice=$dbf->fetchSingle("tracking_system_invoice","tracking_system_id='$_REQUEST[id]'");
		$path5="../invoice_report/".$unlink_invoice[uploaded_invoice];
		unlink($path5);
		
	
	header("Location:manage_tracking_number.php");
}

################# ACTIVE THE USER FROM tracking_system TABLE ##################################
if($_REQUEST['action']=='inactive')
{		
	$dbf->updateTable("tracking_system","active_status=0","id='$_REQUEST[id]'");
	header("Location:manage_tracking_number.php");
}
################# DE-ACTIVE THE USER FROM tracking_system TABLE ###############################
if($_REQUEST['action']=='active')
{
	$dbf->updateTable("tracking_system","active_status=1","id='$_REQUEST[id]'");
	header("Location:manage_tracking_number.php");
}

?>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<style>
.smalltextf
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:6px;
	color:#999;
}

.smalltextf p
{
	padding:0px;
	margin:0px;
}
</style>

<!--For Tracking Number------------------------------>
<script>
function Tracking_no(){	

	var track_no = document.getElementById('trackingnumber').value;
	//alert(track_no);
	location.href = "add_tracking_number.php?tracking_no=" + track_no;
	return false;   
}
</script>
<!--For Tracking Number------------------------------>

<!--table sorter ***************************************************** -->
<script type="text/javascript">
	$(function() {
		$("#sort_table")
			.tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
          5: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
		 
            4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
        } 
    })
		.tablesorterPager({container: $("#pager"), size: 10});
	});
</script>

<!--*******************************************************************-->
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
                          <td width="50%" align="left" valign="middle"><h2>Manage Tracking Number</h2></td>
                          <td width="50%" align="right" valign="middle">
                          	<form name="frm" action="add_tracking_number.php" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="track_no" id="track_no" value="<?php echo $_REQUEST[trackingnumber];?>">
                          	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="76%" align="right" valign="middle">
                                  <input value="" name="alltrackingnumbers" id="alltrackingnumbers" type="hidden">
                                  <input name="trackingnumber" id="trackingnumber" type="text" class="textfield2"></td>
                                <td width="2%" align="left" valign="middle">&nbsp;</td>
                                <td width="22%" align="left" valign="middle"><h2><input type="button" name="add" id="add" value="Add New" class="src_button" onClick="javascript:if(this.form.trackingnumber.value==''){ generatenr(this.form),Tracking_no(); } else { Tracking_no();}" ></h2></td>
                              </tr>
                            </table>
                            </form>
                          </td>
                        </tr>
                      </table></td>
                      <td width="10" align="right" valign="top"><img src="images/rightbox-bg.jpg" alt="rightboxbg" width="10" height="38" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top" bgcolor="#e2e2e2" height="320">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td width="1038">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="center" valign="top">
					<table height="61" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#ACACAC"  class="tablesorter" id="sort_table" width="100%">
                      <thead>
                        <tr>
                          <th width="20%" height="27" align="left" valign="middle" class="fetch_headers"> Tracking Number</th>
                          <th width="16%" align="left" valign="middle" class="fetch_headers">From </th>
                          <th width="16%" align="left" valign="middle" class="fetch_headers">To</th>
                          <th width="33%" align="left" valign="middle" class="fetch_headers"> Package</th>
						  <th colspan="6" align="center" valign="middle" class="fetch_headers">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
						 $num=$dbf->countRows('tracking_system');
						 foreach($dbf->fetch('tracking_system',"","id","","DESC") as $res_track) {
			            ?>
                        <tr bgcolor="<?=$color;?>" onMouseOver="this.style.backgroundColor='#E6E6E6'" onMouseOut="this.style.backgroundColor=''">
                          <td height="25" align="left" class="fetch_contents"><?php echo $res_track[tracking_no];?></td>
                          <td align="left" class="fetch_contents smalltextf"><?php echo $res_track[from_name];?><br/><?php echo $res_track[from_address];?><br/><?php echo $res_track[from_city];?><br/><?php echo $res_track[from_state];?><br/><?php echo $res_track[from_zip];?><br/><?php echo $res_track[from_country];?></td>
                          <td align="left" class="fetch_contents smalltextf"><?php echo $res_track[to_name];?><br/><?php echo $res_track[to_address];?><br/><?php echo $res_track[to_city];?><br/><?php echo $res_track[to_state];?><br/><?php echo $res_track[to_zip];?><br/><?php echo $res_track[to_country];?></td>
                          <td align="left" class="fetch_contents smalltextf"><?php echo $dbf->cut($res_track[package_description],200);?></td>
						  <td width="6%" align="center" class="fetch_contents">
                           <a href="../tracking_detail?trackingno=<?php echo $res_track[tracking_no];?>" target="_blank" class="text2">Preview</a></td>
                          <td width="3%" align="center" class="fetch_contents">
                          	<?php if($res_track["active_status"]==1) { ?>
                              <a href="manage_tracking_number.php?action=inactive&amp;id=<?php echo $res_track[id];?>" onClick="return confirm('Are you sure you want to de-activate the Tracking number ?')"> <img src="images/circle-green.png" width="19" height="19" border="0" title="Click to De-Activate Tracking Number." /></a>
                            <?php } else { ?>
                              <a href="manage_tracking_number.php?action=active&amp;id=<?php echo $res_track[id];?>"> <img src="images/red-circle.png" width="20" height="20" border="0" title="Click to Activate Tracking Number." /></a>
                            <?php } ?>
                          </td>
						  <td width="3%" align="center" class="fetch_contents">
                           <a href="edit_tracking_number.php?trackid=<?php echo base64_encode(base64_encode($res_track[id]));?>"  class="linktext"><img src="images/edit.png" width="18" height="18" title="Edit"></a></td>
						  <td width="3%" align="center" class="fetch_contents">
						   <a href="manage_tracking_number.php?action=delete&id=<?php echo $res_track[id];?>" class="linktext" onClick="return confirm('Are you sure you want to delete this record ?')"><img src="images/trash.jpg" width="15" height="16" title="Delete"></a></td>
                        </tr>
                        <?php } ?>
                        <?php if($num==0) { ?>
                        <tr>
                          <td colspan="12" align="center" class="noRecords"><span class="noRecords2">No Records Found</span> </td>
                        </tr>
						<?php } ?>
                      </tbody>
                    </table></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="10">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="12">&nbsp;</td>
                  </tr>
				  <?php if($num >0) { ?>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right">
					<table width="94%" border="0" cellpadding="0" cellspacing="0" align="center">
                      <tr>
                        <td width="76%" align="center">&nbsp;</td>
                        <td width="24%" >
						<form>
                          <div id="pager" class="pager" style="text-align:right; padding-top:10px;"> 
						  <img src="table_sorter/icons/first.png" alt="first" width="16" height="16" class="first"/> 
						  <img src="table_sorter/icons/prev.png" alt="prev" width="16" height="16" class="prev"/>
                            <input name="text" type="text" class="pagedisplay trans" size="5" readonly=""/>
                            <img src="table_sorter/icons/next.png" width="16" height="16" class="next"/> 
							<img src="table_sorter/icons/last.png" width="16" height="16" class="last"/>
                            <select name="select" class="pagesize">
                              <option selected="selected"  value="10">10</option>
                               <option  value="25">25</option>
                              <option value="50">50</option>
                              <option  value="75">75</option>
							  <option  value="75">100</option>
                            </select>
                          </div>
                        </form>
						</td>
                      </tr>
                    </table>
					</td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
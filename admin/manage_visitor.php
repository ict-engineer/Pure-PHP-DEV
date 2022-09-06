<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Manage Visitors';
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
	$dbf->deleteFromTable("visitors","id='$_REQUEST[id]'");
	header("Location:manage_visitor.php");
}

if($_REQUEST['action']=='deleteAll')
{
	$dbf->deleteFromTable("visitors");
	header("Location:manage_visitor.php");
}
################# ACTIVE VISITORS ##################################
if($_REQUEST['action']=='inactive')
{		
	$dbf->updateTable("visitors","status=1","id='$_REQUEST[id]'");
	header("Location:manage_visitor.php");
}
################# DE-ACTIVE VISITORS ###############################
if($_REQUEST['action']=='active')
{
	$dbf->updateTable("visitors","status=0","id='$_REQUEST[id]'");
	header("Location:manage_visitor.php");
}

?>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--table sorter ***************************************************** -->
<script type="text/javascript">
	$(function() {
		$("#sort_table")
			.tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
          7: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
		 
           9: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
        } 
    })
			
			.tablesorterPager({container: $("#pager"), size: 25});
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
                          <td width="50%" align="left" valign="middle"><h2>Manage Visitors</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_visitor.php?action=deleteAll" class="linkButton">Clear Log </a></h2></td>
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
                          <th width="9%" height="27" align="left" valign="middle" class="fetch_headers">Date</th>
                          <th width="16%" align="left" valign="middle" class="fetch_headers">Country</th>
                          <th width="9%" align="left" valign="middle" class="fetch_headers">IP</th>
                          <th width="9%" align="left" valign="middle" class="fetch_headers">Host Name</th>
                          <th width="12%" align="left" valign="middle" class="fetch_headers">Browser</th>
                          <th width="18%" align="left" valign="middle" class="fetch_headers">URL</th>
                          <th width="18%" align="left" valign="middle" class="fetch_headers">Referrer</th>
						  <th colspan="5" align="center" valign="middle" class="fetch_headers">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
						 $num=$dbf->countRows('visitors');
						 foreach($dbf->fetch('visitors',"","id","","DESC") as $res_visitor) {
			            ?>
                        <tr bgcolor="<?=$color;?>" onMouseOver="this.style.backgroundColor='#E6E6E6'" onMouseOut="this.style.backgroundColor=''">
                          <td height="25" align="left" class="fetch_contents"><?php echo $res_visitor['visit_date'];?></td>
                          <td align="left" class="fetch_contents">Country : <?php echo $res_visitor['country_name'];?><br/>City : <?php echo $res_visitor['city_name'];?></td>
                          <td align="left" class="fetch_contents"><?php echo $res_visitor['ip_address'];?></td>
                          <td align="left" class="fetch_contents"><?php echo $res_visitor['host_name'];?></td>
                          <td align="left" class="fetch_contents text2"><?php echo $res_visitor['browser_name'];?></td>
                          <td align="left" class="fetch_contents"><?php echo $res_visitor['url_address'];?></td>
                          <td align="left" class="fetch_contents"><?php echo $res_visitor['referrer'];?></td>
                          <!--<td width="4%" align="center" bgcolor="<?=$color;?>" class="fetch_contents">
                            <a href="#" class="linktext"><img src="images/view_btn.jpg" width="18" height="18" title="View"></a></td>-->
                          <td width="2%" align="center" bgcolor="<?=$color;?>" class="fetch_contents">
                            <?php if($res_visitor["status"]==0) { ?>
                              <a href="manage_visitor.php?action=inactive&amp;id=<?php echo $res_visitor[id];?>" onClick="return confirm('Are you sure you want to de-activate the Visitor ?')"><img src="images/circle-green.png" width="19" height="19" border="0" title="Click to De-Activate Visitor." /></a>
                            <?php } else { ?>
                              <a href="manage_visitor.php?action=active&amp;id=<?php echo $res_visitor[id];?>"><img src="images/red-circle.png" width="20" height="20" border="0" title="Click to Activate Visitor." /></a>
                            <?php } ?> 	</td>
                          <td width="2%" align="center" bgcolor="<?=$color;?>" class="fetch_contents"><a href="manage_visitor.php?action=delete&id=<?php echo $res_visitor['id'];?>" class="linktext" onClick="return confirm('Are you sure you want to delete this visitor ?')"><img src="images/trash.jpg" width="15" height="16" title="Delete"></a></td>
                        </tr>
                        <?php } ?>
                        <?php if($num==0) { ?>
                        <tr>
                          <td colspan="14" align="center" class="noRecords"><span class="noRecords2">No Records Found</span> </td>
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
                              <option selected="selected" value="25">25</option>
                              <option value="50">50</option>
                              <option  value="75">75</option>
							  <option  value="100">100</option>
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
	$('#user_id').show();	
	});
</script>
</body>
</html>
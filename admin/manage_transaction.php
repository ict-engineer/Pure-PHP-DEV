<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Manage Transaction';
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
	$dbf->deleteFromTable("member_transaction","id='$_REQUEST[id]'");
	header("Location:manage_transaction.php");
}

$res_bankMessage=$dbf->fetchSingle("bankac_message","id=1");

if(isset($_POST[submit])<>'')
{
	$bank_message=addslashes($_POST[bank_message]);	
	$string="bank_message='$bank_message'";
	$dbf->updateTable("bankac_message",$string,"id='1'");
	
	header("Location:manage_transaction.php");
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
          5: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
		 
           6: { 
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
                          <td width="50%" align="left" valign="middle"><h2>Manage Transaction</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><!--<a href="add_bank.php" class="linkButton">Add New </a>--></h2></td>
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
                          <th width="10%" height="27" align="left" valign="middle" class="fetch_headers">Transaction ID</th>
                          <th width="17%" align="left" valign="middle" class="fetch_headers">Party's Email</th>
                          <th width="16%" align="left" valign="middle" class="fetch_headers">Member Email</th>
                          <th width="7%" align="left" valign="middle" class="fetch_headers">Amount</th>
                          <th width="30%" align="left" valign="middle" class="fetch_headers">Current Status</th>
                          <th width="7%" align="left" valign="middle" class="fetch_headers">Transaction Status</th>
						  <th colspan="5" align="center" valign="middle" class="fetch_headers">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
						 $num=$dbf->countRows('member_transaction');
						 foreach($dbf->fetch('member_transaction',"","id","","DESC") as $res_membertransaction) {
							
							$res_member=$dbf->fetchSingle("members","id='$res_membertransaction[member_id]'");
							$res_status=$dbf->fetchSingle("member_transaction_status","mem_transaction_id='$res_membertransaction[id]' order by id DESC");  
			            ?>
                        <tr bgcolor="<?=$color;?>" onMouseOver="this.style.backgroundColor='#E6E6E6'" onMouseOut="this.style.backgroundColor=''">
                          <td height="25" align="left" class="fetch_contents"><?php echo $res_membertransaction[transaction_no];?></td>
                          <td align="left" class="fetch_contents"><?php echo $res_membertransaction[party_email];?> (<?php if($res_membertransaction['roleof_member']=="Buyer"){?>Seller<?php }else { ?>Buyer<?php } ?>)</td>
                          <td align="left" class="fetch_contents"><?php echo $res_member[email];?> (<?php echo $res_membertransaction['roleof_member'];?>)</td>
                          <td align="left" class="fetch_contents"><?php echo $res_membertransaction[total_price];?></td>
                          <td align="left" class="fetch_contents text2"><?php echo $res_status[status];?></td>
                          <td align="center" class="fetch_contents"><span class="text2">
                          	<?php if($res_membertransaction[status]=='0'){?>Active<?php } else { ?>Cancel<?php } ?></span></td>
                          <!--<td width="4%" align="center" bgcolor="<?=$color;?>" class="fetch_contents">
                            <a href="#" class="linktext"><img src="images/view_btn.jpg" width="18" height="18" title="View"></a></td>-->
                          <td width="4%" align="center" bgcolor="<?=$color;?>" class="fetch_contents">
                          	<a href="edit_transaction.php?id=<?php echo $res_membertransaction[id];?>" class="linktext"><img src="images/edit.png" width="18" height="18" title="Edit"></a></td>
						  <td width="4%" align="center" bgcolor="<?=$color;?>" class="fetch_contents">
						    <a href="manage_transaction.php?action=delete&id=<?php echo $res_membertransaction[id];?>" class="linktext" onClick="return confirm('Are you sure you want to delete this member ?')"><img src="images/trash.jpg" width="15" height="16" title="Delete"></a></td>
                        </tr>
                        <?php } ?>
                        <?php if($num==0) { ?>
                        <tr>
                          <td colspan="13" align="center" class="noRecords"><span class="noRecords2">No Records Found</span> </td>
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
                  <tr>
                    <td>&nbsp;</td>
                    <td>
                      <form action="" method="post" id="frm" enctype="multipart/form-data">
                        <table width="400" border="0">
                          <tr>
                            <td height="15" align="left" valign="middle" class="text1" style="padding-left:10px;">Bank account or Message</td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" style="padding-left:10px;"><textarea name="bank_message" id="bank_message" cols="50" rows="5" style="border:1px solid #CCC;"><?php echo $res_bankMessage['bank_message'];?></textarea></td>
                          </tr>
                          <tr>
                            <td height="25" align="left" valign="middle" class="text1" style="padding-left:10px;"><input name="submit" type="submit" class="button" id="submit" value="Submit"></td>
                          </tr>
                        </table>
                      </form>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td height="20">&nbsp;</td>
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
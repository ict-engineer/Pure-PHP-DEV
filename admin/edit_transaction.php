<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Edit Transaction';
include 'application_top.php';

//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

$res=$dbf->fetchSingle("member_transaction","id='$_REQUEST[id]'");

if(isset($_POST[submit])<>'')
{
	$dated=date("Y-m-d");
	$string="payment='$_POST[payment]',status='$_POST[transaction_status]',updated_date='$dated'";
	$dbf->updateTable("member_transaction",$string,"id='$_REQUEST[id]'");
	
	$dbf->deleteFromTable("member_transaction_status","mem_transaction_id='$_REQUEST[id]'");
	
	//For Multiple Field & Value=======================================
	  $totvar=$_REQUEST[count1]-1;
	  for($i=1; $i<=$totvar;$i++)
	  {		  
		$post_date = "post_date".$i;
		$post_date = $_REQUEST[$post_date];
		
		$status = "status".$i;
		$status = $_REQUEST[$status];
		
		$string2="mem_transaction_id='$_REQUEST[id]',status='$status',post_date='$post_date'";
		$dbf->insertSet("member_transaction_status",$string2);
	  }
	//For Multiple Field & Value=======================================
	
	header("Location:edit_transaction.php?msg=added&id=$_REQUEST[id]");
}

$todaydt=date("Y-m-d H:i:s");  //2013-08-03 17:47:14
?>

<script>
//For Add and Delete rows================================================
function add(){	
	var x = document.getElementById('count1').value;	
	var y = parseInt(x) - 1
	var z = 'post_date'+y;
	var t = 'status'+y;

	if((document.getElementById(z).value == '')||(document.getElementById(t).value == '')){
		alert("Plz fill the first field")
		return false;
	}
	var z='div'+x;
	document.getElementById(z).style.display = "block";
	x++;	
	document.getElementById('count1').value = x;
}
function del()
{	
	var x = document.getElementById('count1').value;

	if(x==2)
	{
		alert("You can not delete first row.");
		return false;
	}
	x = x - 1;
	var z='div'+x;
	document.getElementById(z).style.display = "none";	
	document.getElementById('count1').value = x;
}
</script>

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
                    <td class="midboxbg">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50%" align="left" valign="middle"><h2>Edit Transaction</h2></td>
                        <td width="50%" align="right" valign="middle"><h2><a href="manage_transaction.php" class="linkButton">BACK</a></h2></td>
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
                      <table width="90%" height="191" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:10px;">
						<?php 
						  if($_REQUEST[msg]=='added') {
						?>
						<tr>
						  <td width="39" height="10" align="left" class="headingtext"></td>
						  <td height="10" colspan="3" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="30" align="left" class="headingtext">&nbsp;</td>
						  <td height="30" colspan="3" align="left" valign="middle" class="success">Record  has been updated successfully. </td>
						</tr>
						<?php } ?>
						<tr>
						  <td width="39" height="15" align="left" class="headingtext">&nbsp;</td>
						  <td height="15" colspan="3" align="left" valign="middle">&nbsp;</td>
						  </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="3" align="left" valign="middle" class="text1">
                            <table width="500" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #999; padding:4px;">
                              <tr>
                                <td align="left" valign="top">
                                  <table width="500" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td align="center" width="192" valign="middle" bgcolor="#CCCCCC" class="text1">Date time</td>
                                      <td height="25" width="6" align="center" valign="middle">&nbsp;</td>
                                      <td align="center" width="260" valign="middle" bgcolor="#CCCCCC" class="text1">Status</td>
                                      <td align="center" width="21" valign="middle"><img src="images/plus-circle.png" width="16" height="16" onClick="add();"></td>
                                      <td align="center" width="21" valign="middle"><img src="images/minus1.png" width="14" height="14" onClick="del();"></td>
                                      </tr>
                                    <tr>
                                      <td height="5" colspan="5" align="left" valign="middle"></td>
                                      </tr>
                                    <tr>
                                      <td colspan="5" align="left" valign="middle">
                                        <?php
										  $a=1;
										  // Get Number of Records
										  $num=$dbf->countRows('member_transaction_status',"mem_transaction_id='$res[id]'");
										  foreach($dbf->fetch('member_transaction_status',"mem_transaction_id='$res[id]'","id","","ASC") as $res_transaction_status){
										?>
                                        <div id="div<?php echo $a;?>">
                                          <table width="500" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="192" align="left" valign="middle"><input name="post_date<?php echo $a;?>" value="<?php echo $res_transaction_status[post_date];?>" type="text" style="width:190px;" class="validate[required] textfield2" id="post_date<?php echo $a;?>" autocomplete="off"/></td>
                                              <td width="6" height="28" align="left" valign="middle">&nbsp;</td>
                                              <td width="260" align="left" valign="middle"><input name="status<?php echo $a;?>" value="<?php echo $res_transaction_status[status];?>" type="text" style="width:258px;" class="validate[required] textfield2" id="status<?php echo $a;?>" autocomplete="off"/></td>
                                              <td width="21" align="center" valign="middle"></td>
                                              <td width="21" align="center" valign="middle">
                                                <!--<input name="desp_hid<?php //echo $a;?>" type="hidden" id="desp_hid<?php //echo $a;?>" value="<?php //echo $res_ch[id];?>"/>
											  	<input name="vis_hid<?php //echo $a;?>" type="hidden" id="vis_hid<?php //echo $a;?>" value="visible"/>-->
                                              </td>
                                            </tr>
                                          </table>
                                        </div>
                                        <?php $a++; } ?>
                                        <div style="clear:both;"></div>
                                        <input name="count1" type="hidden" id="count1" value="<?php echo $a;?>"/>
                                        <?php $z=1; for($i=$a; $i<20;$i++){?>
                                        <div id="div<?php echo $i;?>" style="display:none;">
                                          <table width="500" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="192" align="left" valign="middle"><input name="post_date<?php echo $i;?>" type="text" style="width:190px;" class="validate[required] textfield2" value="<?php echo $todaydt;?>" id="post_date<?php echo $i;?>" autocomplete="off"/></td>
                                              <td width="6" height="28" align="left" valign="middle">&nbsp;</td>
                                              <td width="260" align="left" valign="middle"><input name="status<?php echo $i;?>" style="width:258px;" type="text" class="validate[required] textfield2" id="status<?php echo $i;?>" autocomplete="off"/></td>
                                              <td width="21" align="center" valign="middle"></td>
                                              <td width="21" align="center" valign="middle"></td>
                                            </tr>
                                          </table>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <?php $z++; }?>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td width="137" height="25" align="left" valign="middle" class="text1">Payment Status : </td>
                          <td width="695" height="25" colspan="2" align="left" valign="middle">
                            <input name="payment" type="text" value="<?php echo $res[payment];?>" style="width:175px;" class="validate[required] textfield2" id="payment" autocomplete="off"/>
                          </td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td width="137" height="25" align="left" valign="middle" class="text1">Transaction Status : </td>
                          <td width="695" height="25" colspan="2" align="left" valign="middle">
                            <select name="transaction_status" class="validate[required] textfield2" style="width:177px; height:24px; padding-top:2px; padding-bottom:2px; padding-right:2px;" id="transaction_status">
                              <option value="Active" <?php if($res[status]=="0"){ echo "Selected"; } ?>>Active</option>
                              <option value="Canceled" <?php if($res[status]=="1"){ echo "Selected"; } ?>>Canceled</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp; <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_transaction.php'"></td>
                          <td height="40" colspan="2" align="left" valign="bottom">&nbsp;</td>
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
                      <td width="5" align="left" valign="top"><img src="images/bottom-left-box-bg.jpg" alt="bot_left_bg" width="5" height="5"/></td>
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
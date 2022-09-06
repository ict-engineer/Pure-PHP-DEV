<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Add Bank';
include 'application_top.php';

//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

if(isset($_POST[submit])<>'')
{
	$dated=date("Y-m-d");
	$string="name='$_POST[name]',payment_type='$_POST[payment_type]',created_date='$dated'";
	$bank_id=$dbf->insertSet("tracking_bank",$string);
	
	//For Multiple Field & Value=======================================
	  $totvar=$_REQUEST[count1]-1;
	  for($i=1; $i<=$totvar;$i++)
	  {		
		$field_descr = "field_descr".$i;
		$field_descr = $_REQUEST[$field_descr];
		
		$field_value = "field_value".$i;
		$field_value = $_REQUEST[$field_value];
		
		$string2="trackbank_id='$bank_id',field_descr='$field_descr',field_value='$field_value'";
		$dbf->insertSet("tracking_bank_fields",$string2);
	  }
	//For Multiple Field & Value=======================================
	
	header("Location:add_bank.php?msg=added");
}
?>

<script>
//For Add and Delete rows================================================
function add(){	
	var x = document.getElementById('count1').value;	
	var y = parseInt(x) - 1
	/*var z = 'field_descr'+y;
	var t = 'field_value'+y;*/

	/*if((document.getElementById(z).value == '')||(document.getElementById(z).value == '')){
		alert("Plz fill the first field")
		return false;
	}*/
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
                      <td class="midboxbg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="50%" align="left" valign="middle"><h2>Add Bank</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_bank.php" class="linkButton">BACK</a></h2></td>
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
						  <td width="43" height="10" align="left" class="headingtext"></td>
						  <td height="10" colspan="3" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="30" align="left" class="headingtext">&nbsp;</td>
						  <td height="30" colspan="3" align="left" valign="middle" class="success">Record  has been added successfully. </td>
						</tr>
						<?php } ?>
						<tr>
                          <td height="15" align="left" class="headingtext">&nbsp;</td>
                          <td height="15" colspan="3" align="left" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="43" height="25" align="left" class="headingtext">&nbsp;</td>
                          <td width="143" height="25" align="left" valign="middle" class="text1"> Name  : </td>
                          <td width="468" height="25" align="left" valign="middle"><input name="name" type="text" class="validate[required] textfield121" id="name" autocomplete="off"/></td>
                          <td width="321" height="25" align="left" valign="bottom" style="padding-bottom:10px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
						</tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" colspan="3" align="left" valign="middle" class="text1">
                          	<table width="465" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #999; padding:4px;">
                              <tr>
                                <td align="left" valign="top">
                                   <div id="div1">
                                    <table width="465" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td align="center" valign="middle" bgcolor="#CCCCCC" class="text1">Field Description</td>
                                        <td height="25" align="center" valign="middle">&nbsp;</td>
                                        <td align="center" valign="middle" bgcolor="#CCCCCC" class="text1">Field Value</td>
                                        <td align="center" valign="middle"><img src="images/plus-circle.png" width="16" height="16" onClick="add();"></td>
                                        <td align="center" valign="middle"><img src="images/minus1.png" width="14" height="14" onClick="del();"></td>
                                      </tr>
                                      <tr>
                                        <td height="5" colspan="5" align="left" valign="middle"></td>
                                      </tr>
                                      <tr>
                                        <td width="192" align="left" valign="middle"><input name="field_descr1" type="text" style="width:190px;" class="validate[required] textfield2" id="field_descr1" autocomplete="off"/></td>
                                        <td width="6" height="28" align="left" valign="middle">&nbsp;</td>
                                        <td width="225" align="left" valign="middle"><input name="field_value1" type="text" class="validate[required] textfield2" id="field_value1" autocomplete="off"/></td>
                                        <td width="21" align="center" valign="middle"></td>
                                        <td width="21" align="center" valign="middle"></td>
                                      </tr>
                                    </table>
                                   </div>
                                    <div style="clear:both;"></div>
                                   <input name="count1" type="hidden" id="count1" value="2"/>
                                   <?php $z=1; for($i=2; $i<20;$i++){?>
                                    <div id="div<?php echo $i;?>" style="display:none;">
                                      <table width="465" border="0" cellspacing="0" cellpadding="0">
                                         <tr>
                                            <td width="192" align="left" valign="middle"><input name="field_descr<?php echo $i;?>" type="text" style="width:190px;" class="validate[required] textfield2" id="field_descr<?php echo $i;?>" autocomplete="off"/></td>
                                            <td width="6" height="28" align="left" valign="middle">&nbsp;</td>
                                            <td width="225" align="left" valign="middle"><input name="field_value<?php echo $i;?>" type="text" class="validate[required] textfield2" id="field_value<?php echo $i;?>" autocomplete="off"/></td>
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
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Payment Type : </td>
                          <td align="left" colspan="2" valign="middle">
                            <select name="payment_type" class="validate[required] textfield121" id="payment_type">
                          	  <option value="Bank Transfer">Bank Transfer</option>
                              <option value="Western Union">Western Union</option>
                              <option value="Money Gram">Money Gram</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp; <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_bank.php'"></td>
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
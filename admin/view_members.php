<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='View Member';
include 'application_top.php';

//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

$res_member=$dbf->fetchSingle("members","id='$_REQUEST[id]'");

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
                          <td width="50%" align="left" valign="middle"><h2>View Member</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_members.php" class="linkButton">BACK</a></h2></td>
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
						<tr>
                          <td height="15" align="left" class="headingtext">&nbsp;</td>
                          <td height="15" colspan="3" align="left" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="39" height="25" align="left" class="headingtext">&nbsp;</td>
                          <td width="137" height="25" align="left" valign="middle" class="text1">Name : </td>
                          <td width="410" align="left" valign="middle"><?php echo $res_member[title];?> <?php echo $res_member[name];?> <?php echo $res_member[surname];?></td>
                          <td width="285" align="left" valign="bottom" style="padding-bottom:10px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
						</tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Email : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[email];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Password :</td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[gen_password];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">MD5 Password :</td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[password];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Activation key :</td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[activation_key];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Sex : </td>
                          <td align="left" colspan="2" valign="middle"><?php if($res_member[title]=="Mr"){ echo "Male";} else { echo "Female";}?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Company :</td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[company];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <?php
						  $res_countryresidence=$dbf->fetchSingle("countries","id='$res_member[country_residence]'");
						?>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Residence : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_countryresidence[country_code];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Payment Option : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[payment_option];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Date of Birth : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[birth_day];?>/<?php echo $res_member[birth_month];?>/<?php echo $res_member[birth_year];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Address1 : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[address1];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Address2 : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[address2];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">City : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[city];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Region : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[region];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <?php
						  $res_country=$dbf->fetchSingle("countries","id='$res_member[country]'");
						?>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Country : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_country[country_code];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Zip : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[postcode];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Phone : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[phone];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Fax : </td>
                          <td align="left" colspan="2" valign="middle"><?php echo $res_member[fax];?></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td height="25" align="left" class="headingtext">&nbsp;</td>
                          <td height="25" align="left" valign="middle" class="text1">Active Account : </td>
                          <td align="left" colspan="2" valign="middle"><?php if($res_member[status]=="0"){ echo "Active";} else { echo "Inactive";} ?></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;<input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_members.php'"></td>
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
                <td align="left" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5" align="left" valign="top"><img src="images/bottom-left-box-bg.jpg" alt="bot_left_bg" width="5" height="5"/></td>
                      <td height="5" class="botmidboxbg"></td>
                      <td width="5"><img src="images/bot-right-box-bg.jpg" alt="bot_right" width="5" height="5" /></td>
                    </tr>
                  </table>
                </td>
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
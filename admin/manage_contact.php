<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Manage Contact';
include 'application_top.php';
//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
	header("location:index.php");
	exit;
}

$res=$dbf->fetchSingle("contact","id='1'");

if(isset($_POST[submit])<>'')
{
	$address=nl2br($_POST[address]);	
	$string="contact_title='$_POST[contact_title]',domain_name='$_POST[domain_name]',email='$_POST[email]',tel_no='$_POST[tel_no]',address='$address',fax_no='$_REQUEST[fax]',postcode='$_REQUEST[postcode]',location='$_POST[location]',country='$_POST[country]'";

	$dbf->updateTable("contact",$string,"id='1'");
	header("Location:manage_contact.php?msg=added");
}

?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" height="116"><?php include 'header.php';?></td>
  </tr>
  <tr>
    <td align="left" valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" colspan="3" align="left" valign="top"></td>
          </tr>
          <tr>
            <td width="226" align="left" valign="top" height="365"><?php include 'left.php';?></td>
            <td width="10">&nbsp;</td>
            <td align="left" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="10" align="left" valign="top"><img src="images/leftbox-bg.jpg" alt="leftboxbg" width="10" height="38" /></td>
                      <td class="midboxbg">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="50%" align="left" valign="middle"><h2>Manage Contact </h2></td>
                          <td width="50%" align="right" valign="middle"><h2>&nbsp;</h2></td>
                        </tr>
                      </table>
					  </td>
                      <td width="10" align="right" valign="top"><img src="images/rightbox-bg.jpg" alt="rightboxbg" width="10" height="38" /></td>
                    </tr>
                </table>
				</td>
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
					<form action="" method="post" id="frm" enctype="multipart/form-data">
                      <table width="92%" height="191" border="0" align="center" cellpadding="0" cellspacing="0" class="add_table">
                    	<?php if($_REQUEST[msg]=='added'){ ?>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="2" align="left" valign="middle" class="success">Record has been updated successfully.</td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td width="20" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="159" height="30" align="left" valign="middle" class="text1">Contact Title :* </td>
                          <td width="689" colspan="2" align="left" valign="middle"><input name="contact_title" type="text" class="validate[required] textfield2" id="contact_title" value="<?php echo $res['contact_title'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td width="20" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="159" height="30" align="left" valign="middle" class="text1">Domain Name :* </td>
                          <td width="689" colspan="2" align="left" valign="middle"><input name="domain_name" type="text" class="validate[required] textfield2" id="domain_name" value="<?php echo $res['domain_name'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td width="20" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="159" height="30" align="left" valign="middle" class="text1">Email :* </td>
                          <td width="689" colspan="2" align="left" valign="middle"><input name="email" type="text" class="validate[required,custom[email]] textfield2" id="email" value="<?php echo $res['email'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td width="20" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="159" height="30" align="left" valign="middle" class="text1">Phone no :* </td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="tel_no" type="text" class="validate[required] textfield2" id="tel_no" value="<?php echo $res['tel_no'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Fax:* </td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="fax" type="text" class="validate[required] textfield2" id="fax" value="<?php echo $res['fax_no'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="top" class="text1">Address : </td>
                          <td height="30" colspan="2" align="left" valign="middle">
                      	  <textarea name="address" class="textarea" id="address" style="border:1px solid #CCC; width:260px;"><?php echo strip_tags($res['address']);?></textarea></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left" class="text1">Postcode:</td>
                          <td height="40" colspan="5" align="left" valign="middle"><input name="postcode" type="text" class="validate[required] textfield2" id="postcode" value="<?php echo $res['postcode'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left" class="text1">Location :</td>
                          <td height="40" colspan="5" align="left" valign="middle"><input name="location" type="text" class="textfield2" id="location" value="<?php echo $res['location'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left" class="text1">Country :</td>
                          <td height="40" colspan="5" align="left" valign="middle"><input name="country" type="text" class="validate[required] textfield2" id="country" value="<?php echo $res['country'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;</td>
                          <td height="40" colspan="5" align="left" valign="bottom"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;</td>
                          <td colspan="5" align="left">&nbsp;</td>
                        </tr>
                      </table>
                    </form>
					</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="10">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td width="12">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
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
	$('#gen_id').show();	
});
</script>
</body>
</html>
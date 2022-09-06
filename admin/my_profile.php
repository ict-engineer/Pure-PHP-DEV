<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='My Profile';
include 'application_top.php';
//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
	header("location:index.php");
	exit;
}

$res=$dbf->fetchSingle("admin","id='1'");

if(isset($_POST[submit])<>'')
{
	$exist=$dbf->existsInTable("tracking_system","tracking_no='$_POST[tracking_password]'");
	if($exist=='')
	{
		$string="admin_name='$_POST[admin_name]',email='$_POST[email]',tracking_password='$_POST[tracking_password]',alt_email='$_POST[alt_email]',invoice_lading_sign='$_POST[invoice_lading_sign]',invoice_lading_sign_font='$_POST[invoice_lading_sign_font]',invoice_lading_font_size='$_POST[invoice_lading_font_size]',inspection_report_sign='$_POST[inspection_report_sign]',inspection_report_sign_font='$_POST[inspection_report_sign_font]',inspection_report_font_size='$_POST[inspection_report_font_size]',site_url='$_POST[site_url]'";
	
		$dbf->updateTable("admin",$string,"id='1'");
		header("Location:my_profile.php?msg=added");
	}
	else
	{
		header("location:my_profile.php?msg=exist");
	}
}

?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" height="116"><?php include 'header.php'; ?></td>
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
                          <td width="50%" align="left" valign="middle"><h2>My Profile</h2></td>
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
                    <td></td>
                    <td width="1038" height="10"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td align="center" valign="top">
					<form action="" method="post" id="frm" enctype="multipart/form-data">
                      <table width="92%" height="191" border="0" align="center" cellpadding="0" cellspacing="0" class="add_table">
						<?php if($_REQUEST[msg]=='added'){ ?>
                        <tr>
                          <td height="20" align="left" class="headingtext"></td>
                          <td height="20" colspan="2" align="left" valign="middle" class="success">Your profile has been updated successfully. </td>
                        </tr>
                        <?php } if($_REQUEST[msg]=='exist'){ ?>
                        <tr>
                          <td height="20" align="left" class="headingtext"></td>
                          <td height="20" colspan="2" align="left" valign="middle" class="error">Tracking Password is already exit.</td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td width="22" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="174" height="30" align="left" valign="middle" class="text1">Admin Name :* </td>
                          <td width="779" colspan="2" align="left" valign="middle"><input name="admin_name" type="text" class="validate[required] textfield2" id="admin_name" value="<?php echo $res[admin_name];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td width="22" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="174" height="30" align="left" valign="middle" class="text1">Email Address  :* </td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="email" type="text" class="validate[required,custom[email]] textfield2" id="email" value="<?php echo $res[email];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Alternate Email :</td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="alt_email" type="text" class="validate[required,custom[email]] textfield2" id="alt_email" value="<?php echo $res[alt_email];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Website URL : </td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="site_url" type="text" class="validate[required] textfield2" id="site_url" value="<?php echo $res[site_url];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Tracking Password : </td>
                          <td height="30" colspan="2" align="left" valign="middle"><input name="tracking_password" type="text" class="validate[required] textfield2" id="tracking_password" value="<?php echo $res['tracking_password'];?>" autocomplete="off" style="width:260px;"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="3" align="left" valign="middle" class="text25" style="text-decoration:underline;">Signature :: </td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Invoice/lading Signature : </td>
                          <td height="30" colspan="2" align="left" valign="middle">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="35%"><input name="invoice_lading_sign" maxlength="19" type="text" class="validate[required] textfield2" id="invoice_lading_sign" value="<?php echo $res[invoice_lading_sign];?>" autocomplete="off" style="width:260px;"/></td>
                              <td width="8%" align="center" class="text1">Font :</td>
                              <td width="2%" align="right" valign="middle" class="text2">1 </td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="invoice_lading_sign_font" id="invoice_lading_sign_font" value="1" <?php if($res[invoice_lading_sign_font]=='1'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">2</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="invoice_lading_sign_font" id="invoice_lading_sign_font" value="2" <?php if($res[invoice_lading_sign_font]=='2'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">3</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="invoice_lading_sign_font" id="invoice_lading_sign_font" value="3" <?php if($res[invoice_lading_sign_font]=='3'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">4</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="invoice_lading_sign_font" id="invoice_lading_sign_font" value="4" <?php if($res[invoice_lading_sign_font]=='4'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">5</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="invoice_lading_sign_font" id="invoice_lading_sign_font" value="5" <?php if($res[invoice_lading_sign_font]=='5'){?> checked <?php } ?>></td>
                              <td width="2%">&nbsp;</td>
                              <td width="12%" align="center" class="text1">Font Size :</td>
                              <td width="23%" align="left">
                                <select name="invoice_lading_font_size" id="invoice_lading_font_size" class="validate[required] textfield2" style="width:40px; height:22px;">
                                  <option value="24" <?php if($res[invoice_lading_font_size]=='24'){?> selected <?php } ?>>24</option>
                                  <option value="30" <?php if($res[invoice_lading_font_size]=='30'){?> selected <?php } ?>>30</option>
                                  <option value="36" <?php if($res[invoice_lading_font_size]=='36'){?> selected <?php } ?>>36</option>
                                  <option value="42" <?php if($res[invoice_lading_font_size]=='42'){?> selected <?php } ?>>42</option>
                                  <option value="48" <?php if($res[invoice_lading_font_size]=='48'){?> selected <?php } ?>>48</option>
                                  <option value="50" <?php if($res[invoice_lading_font_size]=='50'){?> selected <?php } ?>>50</option>
                                  <option value="56" <?php if($res[invoice_lading_font_size]=='56'){?> selected <?php } ?>>56</option>
                                  <option value="60" <?php if($res[invoice_lading_font_size]=='60'){?> selected <?php } ?>>60</option>
                                </select>
                              </td>
                            </tr>
                          </table>
                          </td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext"></td>
                          <td align="left" valign="middle" class="text1"></td>
                          <td height="10" colspan="2" align="left" valign="middle"><img src="invoicesignature.php?text=<?php echo $res[invoice_lading_sign];?>&font=<?php echo $res[invoice_lading_sign_font];?>&size=<?php echo $res['invoice_lading_font_size'];?>" style="margin-top:2px; margin-bottom:2px;" width="180"/></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Inspection Report Signature : </td>
                          <td height="30" colspan="2" align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="35%"><input name="inspection_report_sign" maxlength="19" type="text" class="validate[required] textfield2" id="inspection_report_sign" value="<?php echo $res[inspection_report_sign];?>" autocomplete="off" style="width:260px;"/></td>
                              <td width="8%" align="center" class="text1">Font :</td>
                              <td width="2%" align="right" valign="middle" class="text2">1 </td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="inspection_report_sign_font" id="inspection_report_sign_font" value="1" <?php if($res[inspection_report_sign_font]=='1'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">2</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="inspection_report_sign_font" id="inspection_report_sign_font" value="2" <?php if($res[inspection_report_sign_font]=='2'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">3</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="inspection_report_sign_font" id="inspection_report_sign_font" value="3" <?php if($res[inspection_report_sign_font]=='3'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">4</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="inspection_report_sign_font" id="inspection_report_sign_font" value="4" <?php if($res[inspection_report_sign_font]=='4'){?> checked <?php } ?>></td>
                              <td width="2%" align="right" valign="middle" class="text2">5</td>
                              <td width="2%" align="left" valign="middle" class="text2"><input type="radio" name="inspection_report_sign_font" id="inspection_report_sign_font" value="5" <?php if($res[inspection_report_sign_font]=='5'){?> checked <?php } ?>></td>
                              <td width="2%">&nbsp;</td>
                              <td width="12%" align="center" class="text1">Font Size :</td>
                              <td width="23%" align="left">
                                <select name="inspection_report_font_size" id="inspection_report_font_size" class="validate[required] textfield2" style="width:40px; height:22px;">
                                  <option value="24" <?php if($res[inspection_report_font_size]=='24'){?> selected <?php } ?>>24</option>
                                  <option value="30" <?php if($res[inspection_report_font_size]=='30'){?> selected <?php } ?>>30</option>
                                  <option value="36" <?php if($res[inspection_report_font_size]=='36'){?> selected <?php } ?>>36</option>
                                  <option value="42" <?php if($res[inspection_report_font_size]=='42'){?> selected <?php } ?>>42</option>
                                  <option value="48" <?php if($res[inspection_report_font_size]=='48'){?> selected <?php } ?>>48</option>
                                  <option value="50" <?php if($res[inspection_report_font_size]=='50'){?> selected <?php } ?>>50</option>
                                  <option value="56" <?php if($res[inspection_report_font_size]=='56'){?> selected <?php } ?>>56</option>
                                  <option value="60" <?php if($res[inspection_report_font_size]=='60'){?> selected <?php } ?>>60</option>
                                </select>
                              </td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" class="headingtext"></td>
                          <td align="left" valign="middle" class="text1"></td>
                          <td height="10" colspan="2" align="left" valign="middle"><img src="inspectionsignature.php?text=<?php echo $res['inspection_report_sign'];?>&font=<?php echo $res['inspection_report_sign_font'];?>&size=<?php echo $res['inspection_report_font_size'];?>" style="margin-top:2px; margin-bottom:2px;" width="180"/></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;</td>
                          <td height="40" colspan="5" align="left" valign="bottom"><input name="submit" type="submit" class="button" id="submit" value="Submit">                            &nbsp;</td>
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
                </table></td>
              </tr>
              <tr>
                <td align="left" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5" align="left" valign="top"><img src="images/bottom-left-box-bg.jpg" alt="bot_left_bg" width="5" height="5" /></td>
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
	$('#accnt').show();	
	});
</script>
</body>
</html>
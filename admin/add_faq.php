<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Add FAQs';
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
	$question=addslashes($_POST[question]);
	$string="faq_type='$_POST[faq_type]',question='$question',answer='$_POST[answer]',post_date='$dated'";
	
	$dbf->insertSet("faq",$string);
	header("Location:add_faq.php?msg=added");
}
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
                          <td width="50%" align="left" valign="middle"><h2>Add FAQs</h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_faq.php" class="linkButton">BACK</a></h2></td>
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
						  <td height="10" align="left" class="headingtext"></td>
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
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="141" height="30" align="left" valign="middle" class="text1">FAQ Type : </td>
                          <td width="470" align="left" valign="middle">
                            <select name="faq_type" id="faq_type" class="validate[required] textfield121">
                          	  <option value="">--Select FAQ Type--</option>
                              <option value="Question About General Use">Question About General Use</option>
                              <option value="Financial Question">Financial Question</option>
                            </select>
                          </td>
                          <td width="321" rowspan="5" align="left" valign="bottom" style="padding-bottom:10px;">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3" align="left" class="headingtext"></td>
						</tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="141" height="30" align="left" valign="middle" class="text1">Question : </td>
                          <td width="470" align="left" valign="middle"><input name="question" type="text" class="validate[required] textfield121" id="question" autocomplete="off"/></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3" align="left" class="headingtext"></td>
						</tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Answer : </td>
                          <td align="left" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="43" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="3" align="left" valign="middle">
                            <textarea name="answer" cols="45" rows="5" class="validate[required]" id="answer"></textarea>
                            <script type="text/javascript">
							  //<![CDATA[
								CKEDITOR.replace( 'answer', {
									extraPlugins : 'autogrow',
									height : 250/*,
									toolbar:[
								['Bold','Italic','Underline','Strike'],
								['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
								['Undo','Redo']]*/
								});
							  //]]>
							</script>
                          </td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp; <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_faq.php'"></td>
                          <td height="40" colspan="5" align="left" valign="bottom">&nbsp;</td>
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
	$('#gen_id').show();	
	});
</script>
</body>
</html>
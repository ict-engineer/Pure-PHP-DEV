<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='SEO / Meta Tags';
include 'application_top.php';
//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
	header("location:index.php");
	exit;
}

$res_seo=$dbf->fetchSingle("seo","id='1'");

if(isset($_POST[submit])<>'')
{
	$meta_title=addslashes($_POST[meta_title]);
	$meta_descr=addslashes($_POST[meta_descr]);
	$meta_keyword=addslashes($_POST[meta_keyword]);
	
	$string="meta_title='$meta_title',meta_descr='$meta_descr',meta_keyword='$meta_keyword'";
	$dbf->updateTable("seo",$string,"id='1'");
	header("Location:seo_url.php?msg=added");
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
                          <td width="50%" align="left" valign="middle"><h2>SEO / Meta Tags</h2></td>
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
                    <td width="10">&nbsp;</td>
                    <td width="1038">&nbsp;</td>
                    <td width="12">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td align="center" valign="top">
					<form action="" method="post" id="frm" enctype="multipart/form-data">
                      <table width="92%" height="191" border="0" align="center" cellpadding="0" cellspacing="0" class="add_table">
                   
                      <?php if($_REQUEST[msg]=='added')
					  {
					  ?>
                        <tr>
                          <td width="2%" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="2" align="left" valign="middle" class="suc_msg">Record has been updated successfully. </td>
                        </tr>
                        <?php
						}
						?>

                        <tr>
                          <td height="5" colspan="2" align="left"></td>
                          <td width="83%" height="5" colspan="5" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td height="30" align="left">&nbsp;</td>
                          <td width="15%" height="30" align="left" valign="top" class="fetch_header">Meta Title :</td>
                          <td height="30" colspan="5" align="left" valign="middle">
						  <textarea name="meta_title" id="meta_title" cols="50" rows="3" style="border:1px solid #CCC;"><?php echo $res_seo[meta_title];?></textarea></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="2" align="left"></td>
                          <td height="5" colspan="5" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td height="30" align="left">&nbsp;</td>
                          <td height="30" align="left" valign="top" class="fetch_header">Meta Description :</td>
                          <td height="30" colspan="5" align="left" valign="middle">
						  <textarea name="meta_descr" id="meta_descr" cols="50" rows="5" style="border:1px solid #CCC;"><?php echo $res_seo[meta_descr];?></textarea></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="2" align="left"></td>
                          <td height="5" colspan="5" align="left" valign="middle"></td>
                        </tr>
                        <tr>
                          <td height="30" align="left">&nbsp;</td>
                          <td height="30" align="left" valign="top" class="fetch_header">Meta Keyword :</td>
                          <td height="30" colspan="5" align="left" valign="middle">
						  <textarea name="meta_keyword" id="meta_keyword" cols="50" rows="3" style="border:1px solid #CCC;"><?php echo $res_seo[meta_keyword];?></textarea></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left">&nbsp;</td>
                          <td height="40" colspan="5" align="left" valign="bottom"><input name="submit" type="submit" class="button" id="submit" value="Submit">                            &nbsp;</td>
                        </tr>
                      </table>
                    </form>					</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                  </td>
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
	$('#gen_id').show();	
	});
</script>
</body>
</html>
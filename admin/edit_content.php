<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Edit Content';
include 'application_top.php';
//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

$res=$dbf->fetchSingle("contents","id='$_REQUEST[id]'");

if(isset($_POST[submit])<>'')
{
	$path="../content_img/";
	$file_name=$_FILES['images']['name'];

	$page_title=addslashes($_POST[page_title]);
	$page_title2=addslashes($_POST[page_title2]);
	$main_title=addslashes($_POST[main_title]);
	$main_title2=addslashes($_POST[main_title2]);
	
	if($_FILES['images']['name']!='')
	{
		$fileName=$dbf->getDataFromTable('contents', 'photo', "id='$_REQUEST[id]'");
		$path1="../content_img/".$fileName;
		unlink($path1);
		move_uploaded_file($_FILES['images']['tmp_name'],$path.$file_name);
		$string="main_title='$main_title',main_title2='$main_title2',page_title='$page_title',page_title2='$page_title2',photo='$file_name',content='$_POST[content]'";
	}
	else if($_FILES['images']['name']=='')
	{
		$string="main_title='$main_title',main_title2='$main_title2',page_title='$page_title',page_title2='$page_title2',content='$_POST[content]'";
	}
	
	$dbf->updateTable("contents",$string,"id='$_REQUEST[id]'");
	header("Location:edit_content.php?msg=added&id=$_REQUEST[id]");
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
                          <td width="50%" align="left" valign="middle"><h2>Edit Contents </h2></td>
                          <td width="50%" align="right" valign="middle"></td>
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
						<?php if($_REQUEST[msg]=='added'){ ?>
						<tr>
						  <td height="10" align="left" class="headingtext"></td>
						  <td height="10" colspan="3" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="30" align="left" class="headingtext">&nbsp;</td>
						  <td height="30" colspan="3" align="left" valign="middle" class="success">Content has been updated successfully. </td>
						</tr>
						<?php }?>
						<tr>
                          <td height="15" align="left" class="headingtext">&nbsp;</td>
                          <td height="15" colspan="3" align="left" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Page Name :</td>
                          <td colspan="2" align="left" valign="middle">&nbsp;<input name="page_title" type="text" class="validate[required] textfield121" id="page_name" value="<?php echo $res['page_name'];?>" autocomplete="off" readonly="readonly"/></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <?php if($_REQUEST[id]=='5'){ ?>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Main Title :</td>
                          <td colspan="2" align="left" valign="middle"><table width="450" border="0">
                            <tr>
                              <td width="295" align="left" valign="middle"><input name="main_title" type="text" class="validate[required] textfield121" id="main_title" value="<?php echo $res['main_title'];?>" autocomplete="off"/></td>
                              <td width="5" align="left" valign="middle">&nbsp;</td>
                              <td width="150" align="left" valign="middle"><input name="main_title2" type="text" class="textfield2" style="width:146px;" id="main_title2" value="<?php echo $res['main_title2'];?>" autocomplete="off"/></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="153" height="30" align="left" valign="middle" class="text1"> Title : </td>
                          <td colspan="2" align="left" valign="middle"><table width="450" border="0">
                            <tr>
                              <td width="295" align="left" valign="middle"><input name="page_title" type="text" class="validate[required] textfield121" id="page_title" value="<?php echo $res['page_title'];?>" autocomplete="off"/></td>
                              <td width="5" align="left" valign="middle">&nbsp;</td>
                              <td width="150" align="left" valign="middle">
                              <?php
								if($_REQUEST[id]=='3' ||$_REQUEST[id]=='5' || $_REQUEST[id]=='7' || $_REQUEST[id]=='9' || $_REQUEST[id]=='10' || $_REQUEST[id]=='12' || $_REQUEST[id]=='14' || $_REQUEST[id]=='15' || $_REQUEST[id]=='16' || $_REQUEST[id]=='20'){ 
							  ?>
                              <input name="page_title2" type="text" class="textfield2" style="width:146px;" id="page_title2" value="<?php echo $res['page_title2'];?>" autocomplete="off"/>
                              <?php } ?></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="4" align="left" class="headingtext"></td>
                        </tr>
                        <?php
						  if($_REQUEST[id]=='10' || $_REQUEST[id]=='17' || $_REQUEST[id]=='18'){ 
						?>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="middle" class="text1">Upload Image : </td>
                          <td width="236" align="left" valign="middle">&nbsp;&nbsp;<input type="file" name="images" id="images" /></td>
                          <td width="543" rowspan="3" align="left" valign="bottom" style="padding-bottom:7px;">
                          	<img src="../content_img/<?php echo $res[photo];?>" width="62" height="60" align="middle"/>
                          </td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3" align="left" class="headingtext"></td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" valign="bottom" class="text1">Content</td>
                          <td align="left" valign="middle">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="43" height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" colspan="3" align="left" valign="middle" class="">
                            <textarea name="content" cols="45" rows="5" class="validate[required]" id="content"><?php echo $res[content];?></textarea>
                            <script type="text/javascript">
							  //<![CDATA[
								CKEDITOR.replace( 'content', {
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
                          <td align="left"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp; <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_content.php'"></td>
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
	$('#gen_id').show();	
});
</script>
</body>
</html>
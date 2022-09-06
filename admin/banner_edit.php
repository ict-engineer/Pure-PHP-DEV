<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
$pageTitle='Edit Banner';
include 'application_top.php';

//Object initialization
$dbf = new User();

if(isset($_SESSION['admin_id'])=="")
{
header("location:index.php");
exit;
}

//Fetch data from friends Table
$res_banner=$dbf->fetchSingle("banner","id='$_REQUEST[id]'");

if(isset($_POST[submit])<>'')
{
   	$path="../banner_img/";
	$file_name=time()."_".$_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'],$path.$file_name);
	$dated=date("Y-m-d");

	if($_FILES['image']['name']!='') {
	$fileName=$dbf->getDataFromTable('banner', 'image',  "id='$_REQUEST[id]'");
	$path="../banner_img/".$fileName;
	$path1="../banner_img/banner/".$fileName;
	if(file_exists($path)){
		unlink($path);
	}
	if(file_exists($path1)){
	   unlink($path1);
	}

		$string="image='$file_name'";
	}
	
	
	//****************************image cropping****************************************
		$source_path="../banner_img/".$file_name;
		
		
		$imgsize = getimagesize($source_path);	
		$new_width = 692;	
		$new_height = 245;
		$destination_path="../banner_img/banner/".$file_name;
					
		$destimg=ImageCreateTrueColor($new_width,$new_height) or die("Problem In Creating image");
	
		if($_FILES[image][type] == "image/JPG" || $_FILES[image][type] == "image/JPEG" || $_FILES[image][type] == "image/jpg" || $_FILES[image][type]=='image/jpeg' ){
			    //for small                
                $srcimg=ImageCreateFromJPEG($source_path) or die("Problem In opening Source Image");
                ImageCopyResampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die("Problem In resizing");
                ImageJPEG($destimg,$destination_path,100) or die("Problem In saving");
            }else if($_FILES[image][type] == "image/png" || $_FILES[image][type] == "image/PNG"){ 
			     //for small          
                $srcimg = imagecreatefrompng($source_path);
                ImageCopyResampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
                ImageJPEG($destimg,$destination_path,100) or die("Problem In saving"); 
                     
            }else if($_FILES[image][type] == "image/gif" || $_FILES[image][type] == "image/GIF"){  
			    //for small          
                $srcimg = imagecreatefromgif($source_path);
                ImageCopyResampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
                ImageJPEG($destimg,$destination_path,100) or die("Problem In saving");
            }  
			
	$path11="../banner_img/".$file_name;
	unlink($path11);
	
	$dbf->updateTable("banner",$string,"id='$_REQUEST[id]'");

	header("Location:banner_edit.php?msg=added&id=$_REQUEST[id]");
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
                          <td width="50%" align="left" valign="middle"><h2>Edit  Banner </h2></td>
                          <td width="50%" align="right" valign="middle"><h2><a href="manage_banner.php" class="linkButton">BACK</a></h2></td>
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
						<?php if($_REQUEST[msg]=='added') {?>
						<tr>
						  <td width="39" height="10" align="left" class="headingtext"></td>
						  <td height="10" colspan="6" align="left" valign="middle"></td>
						</tr>
						<tr>
						  <td height="30" align="left" class="headingtext">&nbsp;</td>
						  <td height="30" colspan="6" align="left" valign="middle" class="success">Record  has been updated successfully. </td>
						</tr>
						<?php } ?>
                        <tr>
                          <td height="5" colspan="6" align="left" class="headingtext"></td>
						  <td width="285" rowspan="4" align="left" valign="bottom" style="padding-bottom:10px;">						    </td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td width="156" height="30" align="left" valign="middle" class="text1">Upload Banner : &nbsp;<span class="text2"> (upload logo in h='182' & w= '692')</span></td>
                          <td width="391" colspan="5" align="left" valign="middle"><input id="image" type="file" name="image" /></td>
                        </tr>
                        <tr>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="30" align="left" class="headingtext">&nbsp;</td>
                          <td height="35" colspan="5" align="left" class="headingtext"><img src="../banner_img/banner/<?php echo $res_banner[image];?>" width="135" height="65" align="middle"/></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="7" align="left" class="headingtext"></td>
                        </tr>
                        <tr>
                          <td align="left">&nbsp;</td>
                          <td align="left"></td>
                          <td height="40" colspan="5" align="left" valign="bottom"><input name="submit" type="submit" class="button" id="submit" value="Submit">&nbsp;               					    <input name="submit2" type="button" class="button" id="submit2" value="Cancel" onClick="javascript:window.location='manage_banner.php'"></td>
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
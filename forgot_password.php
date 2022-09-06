<?php
ob_start();
session_start();
include_once 'includes/class.Main.php';
//Object initialization
$dbf = new User();

$menu_title=$dbf->fetchSingle("seo","id='1'");
$pageTitle=$menu_title[meta_title];
$metaDescr=$menu_title[meta_descr];
$metaKeyword=$menu_title[meta_keyword];

include 'application_top.php';

//register
if($_REQUEST['action']=='forgot'){
	$name=addslashes($_REQUEST['name']);
	$surname=addslashes($_REQUEST['surname']);
	$exist=$dbf->existsInTable("members","email='$_REQUEST[email]' and name='$name' and surname='$surname' and birth_month='$_REQUEST[month]' and birth_day='$_REQUEST[day]' and birth_year='$_REQUEST[year]'");
	if($exist==1){
		 $user_id=$dbf->getDataFromTable("members","id","email='$_REQUEST[email]' and name='$name' and surname='$surname' and birth_month='$_REQUEST[month]' and birth_day='$_REQUEST[day]' and birth_year='$_REQUEST[year]'");
		$_SESSION['user_id']=$user_id;
		header("location:forgot_change_password");
		}else{
		header("location:forgot_password?msg=invalid");
	}
}
?>
<body><?php include 'header.php';?></header><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h1>Password <span>Reset</span></h1><div class="spacer1"></div><div class="contxt">To change your password, fill in this form and click on Verify.On the next page you will be able to change your password.</div><div class="spacer2"></div><form name="frm_forgot" id="frm_forgot" action="forgot_password" method="post" onSubmit="return validate_forgot_password();"><input type="hidden" id="action" name="action" value="forgot"/><div class="memberlogdiv"><div class="memlogindiv"><?php if($_REQUEST[msg]=='invalid'){ ?><div class="error_msg" align="center">Invalid information.</div><div class="spacer"></div><?php } ?><div class="memlogintxt">Your e-mail address</div><div class="memlogintbcon"><input type="text" class="memlogintb"  id="email" name="email"/></div><div id="lbl_email"></div><div class="memlogintxt">Name</div><div class="memlogintbcon"><input type="text" class="memlogintb" name="name" id="name" /></div><div id="lbl_name"></div><div class="memlogintxt">Surname</div><div class="memlogintbcon"><input type="text" class="memlogintb"  name="surname" id="surname"/></div><div id="lbl_surname"></div><div class="memlogintxt1">Date of birth - needed only for corroboration</div><div class="memlogintxt">Month</div><div class="memlogintbcon"><select  class="memlogintb"  id="month" name="month"><option value="">Select From List</option><?php for ($i = 1; $i <= 12; $i++) { $month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));?><option value="<?php echo $i; ?>"><?php echo $month_name; ?></option><?php } ?></select></div><div id="lbl_month"></div><div class="memlogintxt">Day</div><div class="memlogintbcon"><select name="day" id="day" class="memlogintb" ><option value="">Select From List</option><?php for ($i = 1; $i <= 31; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?></select></div><div id="lbl_day"></div><div class="memlogintxt">Year</div><div class="memlogintbcon"><input type="text" class="memlogintb"  id="year" name="year" onKeyPress="return PhoneNo1(event,this.value)" value="19"/></div><div id="lbl_year"></div><div class="spacer1"></div><div align="center" class="enterbtn"><input type="image" src="images/verify.png" /></div><div class="spacer1"></div></div></div></form><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php';?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
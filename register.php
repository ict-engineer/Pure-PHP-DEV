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

if($_SESSION['user_id']!=''){
	header("location:my_account");
}

//register
if($_REQUEST['action']=='insert'){
	$exist=$dbf->existsInTable("members","email='$_REQUEST[email]'");
	if($exist!=1){
	$password=md5($_REQUEST['password']);
	$gen_password=$_REQUEST['password'];
	$name=addslashes($_REQUEST['name']);
	$surname=addslashes($_REQUEST['surname']);
	$company=addslashes($_REQUEST['company']);
	$address1=addslashes($_REQUEST['address1']);
	$address2=addslashes($_REQUEST['address2']);
	$city=addslashes($_REQUEST['city']);
	$region=addslashes($_REQUEST['region']);
	$postcode=addslashes($_REQUEST['postcode']);
	$fax=addslashes($_REQUEST['fax']);
	$payment_opt=addslashes($_REQUEST['payment_opt']);
	//$payment_opt=$_REQUEST['payment_opt'];
	$activation_key1=mt_rand(1000000000, 9999999999);
	$activation_key2=mt_rand(1000000000, 9999999999);
	$activation_key3=mt_rand(10000000, 99999999);
	
	$activation_key=$activation_key1.''.$activation_key2.''.$activation_key3;
	
	$exist_partyEmail=$dbf->existsInTable("member_transaction","party_email='$_REQUEST[email]'");
	if($exist_partyEmail>0)
	{
		$res_memtransaction=$dbf->fetchSingle("member_transaction","party_email='$_REQUEST[email]'");
		$member_transid=$res_memtransaction['id'];
		if($res_memtransaction['roleof_member']=="Buyer"){
			$trans_name="Seller";
		}else{
			$trans_name="Buyer";
		}
		
		$string2="mem_transaction_id='$member_transid',status='Transaction accepted by the $trans_name',post_date=now();";
		$dbf->insertSet("member_transaction_status",$string2);
	}
	
	$string="activation_key='$activation_key',email='$_REQUEST[email]',password='$password',gen_password='$gen_password',title='$_REQUEST[title]',name='$name',surname='$surname',company='$company',country_residence='$_REQUEST[country_residence]',payment_option='$payment_opt',birth_day='$_REQUEST[day]',birth_month='$_REQUEST[month]',birth_year='$_REQUEST[year]',address1='$address1',address2='$address2',city='$city',region='$region',country='$_REQUEST[country]',postcode='$postcode',phone='$_REQUEST[phone]',fax='$fax',status='1',created_date=now()";
	$ins_id=$dbf->insertSet("members",$string);
	//$_SESSION[user_id]=$ins_id;
	//############################### Mail Section Starts here ###########################
	if($ins_id!=''){
		
	//****************************** Mail to admin **************************************\\	
		//Fetch Single Data From Admin
		$res_admin=$dbf->fetchSingle("admin","id='1'");	
		$res_contact=$dbf->fetchSingle("contact","id='1'");	
		$res_activation_key=$dbf->fetchSingle("members","id='$ins_id'");	
		$to=$res_admin['email'];
		$from=addslashes($_REQUEST['email']);
		$fullname=$_REQUEST['title']." ".$name." ".$surname;
		$dob=$_REQUEST['day']."-".$_REQUEST['month']."-".$_REQUEST['year'];
		$country_name=$dbf->getDataFromTable("countries","country_name","id='$_REQUEST[country]'");
		$residence_country=$dbf->getDataFromTable("countries","country_name","id='$_REQUEST[country_residence]'");
		
		$imgPath=$res_admin[site_url]."/images/logo.png";
			
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:".$res_contact[domain_name]." <".$from.">\n";
		
		$body='<table width="666" height="710" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="9%" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
			<td width="91%" height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
		  </tr>
		  <tr>
		    <td height="35" colspan="3" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:15px;" >Dear '.$res_admin[admin_name].',</td>
  </tr>
		  <tr>
			<td align="left" valign="top" >&nbsp;</td>
			<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:30px;"> Followings are member details  : </span></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" >&nbsp;</td>
			<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold;">Name : '.$fullname.'</span></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" >&nbsp;</td>
			<td height="35" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">E-Mail address :  '.$from.'</span></td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Company :  '.$company.'</span>
			</td>
  </tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Residence Country :  '.$residence_country.'</span></td>
  </tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Payment option :  '.$payment_opt.'</span>
			
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Date of birth :  '.$dob.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Address1 :  '.$address1.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Address2 :  '.$address2.'</span></td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">city :  '.$city.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Region :  '.$region.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Country :  '.$country_name.'</span>
			</td>
 		 </tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Postcode :  '.$postcode.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Phone :  '.$_REQUEST[phone].'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" >
			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal;">Fax :  '.$fax.'</span>
			</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #191919; font-weight: bold;">&nbsp;</td>
  		</tr>
		  <tr>
		    <td align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #191919; font-weight: bold;">&nbsp;</td>
  		</tr>
		  <tr>
			<td align="left" valign="top" ></td>
			<td height="10" colspan="2" align="left" valign="top" ></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" >&nbsp;</td>
			<td height="25" colspan="2" align="right" valign="top" style="padding-right:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #191919; font-weight: bold;">Thanks,<br/>
			'.$name.' </span></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" ></td>
			<td height="20" colspan="2" align="left" valign="top" ></td>
		  </tr>
		</table>';
		//mail( "someone@example.com", "Subject: $subject", $message, "From: $email" );
		$subject = 'New User Registration';
		//echo $body;exit;
		@mail($to,$subject,$body,$headers);
//****************************** Mail to user **************************************\\	
    
		$from1=$res_admin['email'];
		$to1=addslashes($_REQUEST['email']);
		
		$imgPath=$res_admin[site_url]."/images/logo.png";
			
		$headers1 = "MIME-Version: 1.0\n";
		$headers1 .= "Content-type: text/html; charset=UTF-8\n";
		$headers1 .= "From:".$res_contact[domain_name]." <".$from1.">\n";
		
		$body1='<table width="800"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="1%" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
			<td height="15" colspan="2" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight: bold;"></td>
		  </tr>
		  <tr>
		    <td height="25" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:10px;" >&nbsp;</td>
		    <td width="85%" height="35" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:7px;" >Dear '.$name.',</td>
		    <td width="14%" height="25" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: bold; padding-left:7px;" >&nbsp;</td>
  		  </tr>
		  <tr>
		    <td height="25" align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal; padding-left:15px;">Thank you for registering your Transmith Group account. To finally activate your account please click the following link.</td>
  		  </tr>
		  <tr>
		    <td height="12" align="left" valign="top" ></td>
		    <td height="12" colspan="2" align="left" valign="top" ></td>
  		  </tr>
		  <tr>
		    <td height="25" align="left" valign="top" >&nbsp;</td>
		    <td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal; padding-left:15px;">'.$res_admin[site_url].'/confirmation?page=esregistered&activationkey='.$res_activation_key[activation_key].' <br/>
Your activation key is: '.$res_activation_key[activation_key].'</td>
  		  </tr>
          <tr>
		    <td height="20" align="left" valign="top" ></td>
		    <td height="20" colspan="2" align="left" valign="top" ></td>
  		  </tr>
		  <tr>
			<td height="25" align="left" valign="top" >&nbsp;</td>
			<td height="25" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal; padding-left:15px;">If clicking the link doesnot work you can copy the link into your browser window or type it there directly.</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" ></td>
		    <td height="20" colspan="2" align="left" valign="top" ></td>
  		  </tr>
		  <tr>
		    <td align="left" valign="top" ></td>
		    <td height="20" colspan="2" align="left" valign="top" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; color:#191919; font-weight: normal; padding-left:15px;"><strong>Your Login Email :</strong> '.$res_activation_key[email].' <br/>
            <strong>Password :</strong> '.$res_activation_key[gen_password].'</td>
		  </tr>
		  <tr>
			<td align="left" valign="top" ></td>
			<td height="50" colspan="2" align="left" valign="top" ></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" >&nbsp;</td>
			<td height="25" colspan="2" align="left" valign="top" style="padding-left:10px;" ><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #191919; font-weight: bold;">Thank you for choosing Transmith Group !<br/><br/>
			Transmith Group Team<br />
            Email '.$res_contact[email].'<br />
            Home '.$res_admin[site_url].'<br />
            Fax  '.$res_contact[fax_no].' </span> </span></td>
		  </tr>
		  <tr>
			<td align="left" valign="top" ></td>
			<td height="20" colspan="2" align="left" valign="top" ></td>
		  </tr>
		</table>';
		//mail( "someone@example.com", "Subject: $subject", $message, "From: $email" );
		$subject1 = 'Thank you for registering';
		//echo $body1;exit;
		@mail($to1,$subject1,$body1,$headers1);
	//############################### Mail Section Starts here ###########################
				
	}
	header("location:register?msg=success");
	}else{
		header("location:register?msg=exist");
	}
}
?>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php'; ?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec"> <h1>Register <span>free</span></h1> <div class="spacer1"></div> <div class="contxt"><strong>The obligatory points are marked with </strong> <span>*</span> </div> <div class="spacer2"></div> <form name="frm_register" id="frm_register" action="register" method="post" onSubmit="return validate_register();"> <input type="hidden" id="action" name="action" value="insert"/> <div class="resisterdiv"> <?php if($_REQUEST[msg]=='success') { ?> <div class="suc_msg" align="center">Registration has been completed successfully, Please check mail to activate your account.</div> <div class="spacer"></div> <?php } ?> <?php if($_REQUEST[msg]=='exist') { ?> <div class="error_msg" align="center">Email address already exist.</div> <div class="spacer"></div> <?php } ?> <div><h3>Access information</h3></div> <div class="spacer1"></div> <div> Type in your e-mail address and choose a password. Your e-mail address will be used as the access key. Your password has to be at least 6 characters long.</div> <div class="spacer"></div> <div class="memlogintxt">Your e-mail address <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="email" autocomplete="off" name="email" /></div> <div id="lbl_email"></div> <div class="memlogintxt">Choose your password <span>*</span></div> <div class="memlogintbcon"><input type="password" class="memlogintb" autocomplete="off" id="password" name="password"/></div> <div id="lbl_password"></div> <div class="memlogintxt">Retype your password <span>*</span></div> <div class="memlogintbcon"><input type="password" class="memlogintb" autocomplete="off" id="re_pwd" name="re_pwd" /></div> <div id="lbl_re_pwd"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Identification of the Client</h3></div> <div class="spacer1"></div> <div class="memlogintxt"> <input type="radio" name="title" value="Mr" id="title_0" />Mr <input type="radio" name="title" value="Miss" id="title_1" />Miss </div> <div id="lbl_identification"></div> <div class="memlogintxt">Name <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="name" name="name" /></div> <div id="lbl_name"></div> <div class="memlogintxt">Surname <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="surname" name="surname" /></div> <div id="lbl_surname"></div> <div class="memlogintxt">Company</div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="company" name="company" /></div> <div id="lbl_company"></div> <div class="memlogintxt">Country of residence <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="country_residence" name="country_residence"> <option value="">Select From List</option> <?php foreach($dbf->fetch("countries","","country_name","","ASC") as $countries){?> <option value="<?php echo $countries['id'];?>"><?php echo $countries['country_name'];?></option> <?php } ?> </select> </div> <div id="lbl_counry_residence"></div> <div class="spacer1"></div><div class="spacer1"></div> <div><h3>Payment option</h3></div> <div class="spacer1"></div> <div>You want the cheque to be sent and payable to : </div> <div class="memlogintxt"> <input type="radio" name="payment_opt" value="only your name" />only your name <input type="radio" name="payment_opt" value="your company's name" />your company's name <input type="radio" name="payment_opt" value="your name / company's name"/>your name / company's name </div> <div id="lbl_payment_opt"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Security and Privacy</h3></div> <div class="spacer1"></div> <div>Type in your date of birth. This information is strictly confidential and is needed only for corroboration, (e.g. to recover a password).</div> <div class="memlogintxt">Month <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="month" name="month"> <option value="">Select From List</option> <?php for ($i = 1; $i <= 12; $i++) { $month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));?> <option value="<?php echo $i; ?>"><?php echo $month_name; ?></option> <?php } ?> </select> </div> <div id="lbl_month"></div> <div class="memlogintxt">Day <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="day" name="day"> <option value="">Select From List</option> <?php for ($i = 1; $i <= 31; $i++) { ?> <option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?> </select> </div> <div id="lbl_day"></div> <div class="memlogintxt">Year <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="year" name="year" onKeyPress="return PhoneNo1(event,this.value)" value="19" /></div> <div id="lbl_year"></div> <div class="spacer1"></div><div class="spacer1"></div> <div><h3>Information on the address</h3></div> <div class="spacer1"></div> <div>Type in your address bellow. For the Sellers, it will be the place where SafeDeal will send the cheque and to where the Buyers will, if the case be so, return the goods. For the Buyers this is the consignment address, although an alternative address for the consignment can be given at the moment of payment.</div> <div class="memlogintxt">Address 1 <span>*</span> <em>(eg. Street 20)</em></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="address1" name="address1" /></div> <div id="lbl_address1"></div> <div class="memlogintxt">Address 2 <em>(eg. Apartment #6)</em></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="address2" name="address2" /></div> <div id="lbl_address2"></div> <div class="memlogintxt">City <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="city" name="city" /></div> <div id="lbl_city"></div> <div class="memlogintxt">Region <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="region" name="region" /></div> <div id="lbl_region"></div> <div class="memlogintxt">Country <span>*</span></div> <div class="memlogintbcon"> <select class="memlogintb" id="country" name="country"> <option value="">Select From List</option> <?php foreach($dbf->fetch("countries","","country_name","","ASC") as $countries){?> <option value="<?php echo $countries['id'];?>"><?php echo $countries['country_name'];?></option> <?php } ?> </select> </div> <div id="lbl_country"></div> <div class="memlogintxt">ZIP, Post Code <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="postcode" name="postcode"/></div> <div id="lbl_postcode"></div> <div class="memlogintxt">Telephone Number<em> (no mobile phone)</em> <span>*</span></div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="phone" name="phone" onKeyPress="return PhoneNo(event);"/></div> <div id="lbl_phone"></div> <div class="memlogintxt">Fax</div> <div class="memlogintbcon"><input type="text" class="memlogintb" id="fax" name="fax" /></div> <div id="lbl_fax"></div> <div class="spacer1"></div> <div><input name="chk" type="checkbox" value="" id="chk"/>I declare to have taken note of the Service Rules and to accept each and every point.</div> <div id="lbl_chk"></div> <div class="spacer1"></div> <div align="center"><input type="image"src="images/register.png" /></div> <div class="spacer1"></div> <div class="spacer1"></div> <div>For further information <a href="contact">Click here</a></div> <div class="spacer1"></div> </div> </form> <div class="spacer1"></div> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php');?></footer></body></html>
<?php
ob_start();
session_start();
include_once '../includes/class.Main.php';
include 'application_top.php';

//Check whether user is logged in or not
$dbf = new User();
if ($dbf->get_session())
{
	if(isset($_SESSION['admin_id']))
	{
	
?>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />

<link href="css/format.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/accordian_menu.js"></script>

<table width="100%" height="397" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="4" class="lefttableborder"></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="lefttableborder">	
	<!--------------------------------- Accordion Menu Starts here------------------------------------------->              
	   	<div id="wrapper" >
		  	<div class="accordionButton"><span style="float:left">GENERAL SETTINGS</span></div>
			<div class="accordionContent" id="gen_id">
			  <div style="border-radius:5px; -moz-border-radius:5px; background:#49447a;">
				<div class="left-menu"><a href="manage_content.php" class="submenu">Manage Contents</a></div>
                <div class="left-menu"><a href="manage_category.php" class="submenu">Manage Category</a></div>
				<div class="left-menu"><a href="manage_contact.php" class="submenu">Manage Contact</a></div>
                <div class="left-menu"><a href="manage_banner.php" class="submenu">Manage Banner</a></div>
				<div class="left-menu"><a href="seo_url.php" class="submenu">Manage SEO / Meta Tags </a></div>
				<div class="left-menu"><a href="manage_faq.php" class="submenu">Manage FAQs</a></div>
                <div class="left-menu"><a href="manage_testimonial.php" class="submenu">Manage Testimonial</a></div>
                <div class="left-menu"><a href="manage_terms_conditions.php" class="submenu">Manage Terms & Conditions</a></div>
			  </div>
			</div>
            
            <div class="accordionButton"><span style="float:left">MEMBER MANAGEMENT</span></div>
		  	<div class="accordionContent" id="user_id">
			  <div style="border-radius:5px; -moz-border-radius:5px; background:#49447a;">
                <div class="left-menu"><a href="manage_members.php" class="submenu">Manage Members</a></div>
                <div class="left-menu"><a href="manage_transaction_originate.php" class="submenu">Manage Transaction Originate</a></div>
              	<div class="left-menu"><a href="manage_transaction.php" class="submenu">Manage Transaction</a></div>
                <div class="left-menu"><a href="manage_visitor.php" class="submenu">Manage Visitors</a></div>
			  </div>
			</div>
            
            <div class="accordionButton"><span style="float:left">TRACKING SYSTEM</span></div>
		  	<div class="accordionContent" id="track_id">
			  <div style="border-radius:5px; -moz-border-radius:5px; background:#49447a;">
                <div class="left-menu"><a href="manage_bank.php" class="submenu">Manage Bank</a></div>
              	<div class="left-menu"><a href="manage_tracking_number.php" class="submenu">Manage Tracking Number</a></div>
			  </div>
			</div>
			  
		 	<div class="accordionButton"><span style="float:left">MY ACCOUNT</span></div>
		  	<div class="accordionContent" id="accnt">
			  <div style="border-radius:5px; -moz-border-radius:5px; background:#49447a;">
				<div class="left-menu"><a href="my_profile.php" class="submenu">My Profile </a></div>
				<div class="left-menu"><a href="change_password.php" class="submenu">Change Password </a></div>
			  </div>
			</div>
	  	 </div>
	<!-------------------------------------------------- Accordion Menu endss here-------------------------------------->
	</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="lefttableborder">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top" class="lefttableborder">&nbsp;</td>
  </tr>
</table>
<?php
	}
}
?>
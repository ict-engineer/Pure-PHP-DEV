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

if($_SESSION['user_id']=='')
{
	header("location:index");
}

if($_REQUEST[transactionid]=='')
{
	header("location:my_account");
}

//Fetch data from member_transaction====================================
$member_transaction=$dbf->fetchSingle("member_transaction","transaction_no='$_REQUEST[transactionid]'");
//Fetch data from members ==============================================
$membername=$dbf->fetchSingle("members","id='$member_transaction[member_id]'");
//Fetch data from transaction_originate ================================
$originate=$dbf->fetchSingle("transaction_originate","id='$member_transaction[transaction_originate]'");


if($_REQUEST['action']=='view_transaction')
{
	if($_REQUEST[transaction_type]=="modify")
	{
		header("Location:edit_transaction?transactionid=$_REQUEST[transaction_no]");
		exit;	
	}
	
	if($_REQUEST[transaction_type]=="cancel")
	{
		$string="status='1'";
	
		$dbf->updateTable("member_transaction",$string,"id='$_REQUEST[transaction_id]'");
		header("Location:view_transaction_next?msg=added&transactionid=$_REQUEST[transaction_no]");
	}
}

?>
<body><?php include 'header.php'; ?><nav><div class="menubar"><?php include 'menu.php'; ?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php'; ?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec"> <h4>Transaction number <span><?php echo $_REQUEST[transactionid];?></span> of <span><?php echo $membername[email];?></span></h4> <div class="spacer1"></div> <div class="spacer2"></div> <form name="view_transaction_frm" id="view_transaction_frm" action="view_transaction_next" method="post"> <input type="hidden" id="action" name="action" value="view_transaction"/> <input type="hidden" id="transaction_id" name="transaction_id" value="<?php echo $member_transaction[id];?>"/> <input type="hidden" id="transaction_no" name="transaction_no" value="<?php echo $member_transaction[transaction_no];?>"/> <div class="resisterdiv"> <?php if($_REQUEST[msg]=='success') { ?> <div class="suc_msg" align="center">Registration successfully completed.</div> <div class="spacer"></div> <?php } ?> <?php if($_REQUEST[msg]=='exist') { ?> <div class="error_msg" align="center">Email address already exist.</div> <div class="spacer"></div> <?php } ?> <div><h3>Information on the Buyer - Seller </h3></div> <div class="spacer1"></div> <div class="memlogintxt">Your role in the transaction : <strong><?php echo $member_transaction[roleof_member];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">The other parties E-mail : <strong><?php echo $member_transaction[party_email];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">The origin of the transaction : <strong><?php echo $originate[originate_from];?></strong></div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Transaction details</h3></div> <div class="spacer1"></div> <div class="memlogintxt">Currency : <strong><?php echo $member_transaction[currency];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">Description : <strong><?php echo $member_transaction[brief_descr];?></strong></div> <div class="spacer1"></div> <div class="spacer2"></div> <div> <!--Responsive table Starts here------------------------> <div class="table"> <div class="table-head"> <div class="column" data-label="Goods" style="width:22%;">Goods</div> <div class="column" data-label="Qantity" style="width:8%;">Qantity</div> <div class="column" data-label="Description" style="width:40%;">Description</div> <div class="column" data-label="Unit Price" style="width:15%;">Unit Price</div> <div class="column" data-label="Total Price" style="width:15%;">Total Price</div> </div> <div class="row"> <div class="column memlogintxt" data-label="Goods"><strong><?php echo $member_transaction[goods];?></strong></div> <div class="column memlogintxt" data-label="Qantity"><strong><?php echo $member_transaction[quantity];?></strong></div> <div class="column memlogintxt" data-label="Description"><strong><?php echo $member_transaction[description];?></strong></div> <div class="column memlogintxt" data-label="Unit Price"><strong><?php echo $member_transaction[unit_price];?> <?php echo $member_transaction[currency];?></strong></div> <div class="column memlogintxt" data-label="Total Price"><strong><?php echo $member_transaction[total_price];?> <?php echo $member_transaction[currency];?></strong></div> </div> </div> <!--Responsive table Ends here--------------------------> </div> <div class="spacer1"></div> <div class="spacer1"></div> <div><h3>Inspection period and cost </h3></div> <div class="spacer1"></div> <div class="memlogintxt">Length of the Inspection Period : <strong><?php echo $member_transaction[inspection_period];?></strong>Days</div> <div class="spacer2"></div> <div class="memlogintxt">Who will pay for the SafeDeal service : <strong><?php echo $member_transaction[safedeal_pay];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">Postage and packing cost : <strong><?php echo $member_transaction[postage_packing_cost];?> <?php echo $member_transaction[currency];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">Who pays the postage and packing : <strong><?php echo $member_transaction[postage_packing_pay];?></strong></div> <div class="spacer2"></div> <div class="memlogintxt">Way of payment : <strong>Bank Transfer</strong></div> <div class="spacer1"></div> <div class="memlogintxt"> <table class="tablediv" border="1" bordercolor="#535353" style="border-radius:3px; -moz-border-radius:3px;"> <tr> <td height="28" colspan="2" align="center" bgcolor="#BFC6EE">Debit</td> </tr> <tr> <td height="25" align="left" valign="middle">Purchasing Price : </td> <td height="25" align="right" valign="top"><strong><?php echo $member_transaction[total_price];?> <?php echo $member_transaction[currency];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">Postage and Packing Cost : </td> <td height="25" align="right" valign="middle"><strong><?php echo $member_transaction[postage_packing_cost];?> <?php echo $member_transaction[currency];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">SafeDeal's fees : </td> <td height="25" align="right" valign="middle"><strong><?php echo $member_transaction[safedeal_fee];?> <?php echo $member_transaction[currency];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">Bank's Costs : </td> <td height="25" align="right" valign="middle"><strong><?php echo $member_transaction[banks_cost];?> <?php echo $member_transaction[currency];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">Total Debit : </td> <td height="25" align="right" valign="middle"><?php echo $member_transaction[total_price];?> (Price) - <?php echo $member_transaction[safedeal_fee];?> (SafeDeal) = <strong><?php echo $member_transaction[total_debit];?> <?php echo $member_transaction[currency];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">Payment : </td> <td height="25" align="right" valign="middle"><strong><?php echo $member_transaction[payment];?></strong></td> </tr> <tr> <td height="25" align="left" valign="middle">Balance : </td> <td height="25" align="right" valign="middle"><strong><?php echo $member_transaction[balance];?> <?php echo $member_transaction[currency];?></strong></strong></td> </tr> </table> </div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="memlogintxt"> <table class="tablediv" border="1" bordercolor="#535353" style="border-radius:3px; -moz-border-radius:3px;"> <tr> <td height="28" align="left" valign="middle" bgcolor="#BFC6EE">Date time </td> <td height="28" align="left" valign="middle" bgcolor="#BFC6EE">Status</td> </tr> <?php foreach($dbf->fetch('member_transaction_status',"mem_transaction_id='$member_transaction[id]'","id","","DESC") as $res_transaction_status) { ?> <tr> <td height="25" align="left" valign="middle"><strong><?php echo $res_transaction_status[post_date];?></strong></td> <td height="25" align="left" valign="middle"><strong><?php echo $res_transaction_status[status];?></strong></td> </tr> <?php } ?> </table> </div> <div class="spacer1"></div> <div class="memlogintbcon"> <select class="memlogintb" id="transaction_type" name="transaction_type"> <option value="modify">Modify Transaction</option> <option value="cancel">Cancel Transaction</option> </select> </div> <div class="spacer1"></div> <div align="center"><input type="image"src="images/changetra.png" /></div> <div class="spacer1"></div> <div class="spacer1"></div> </div> </form> <div class="spacer1"></div> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php'); ?></footer></body></html>
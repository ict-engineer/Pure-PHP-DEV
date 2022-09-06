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

$user_details=$dbf->fetchSingle("members","id=$_SESSION[user_id]");

$res_transaction=$dbf->fetchSingle("member_transaction","party_email='$user_details[email]' order by id DESC");
$transaction_no=$res_transaction['transaction_no'];
$mem_type=$res_transaction['roleof_member'];

$res_member=$dbf->fetchSingle("members","id='$res_transaction[member_id]'");
$member_email=$res_member['email'];

$num_status=$dbf->countRows('member_transaction_status',"mem_transaction_id='$res_transaction[id]'");

/*if($_REQUEST['action']=="accept")
{
	if($mem_type=="Buyer"){
		$trans_name="Seller";
	}else{
		$trans_name="Buyer";
	}
	
	$string2="mem_transaction_id='$res_transaction[id]',status='Transaction accepted by the $trans_name',post_date=now();";
	$dbf->insertSet("member_transaction_status",$string2);
	
	header("Location:transactions");exit;
}*/

?>
<script src="js/transaction_option.js"></script><body><?php include 'header.php'; ?><nav><div class="menubar"><?php include 'menu.php'; ?></div></nav> <div class="contentouterdiv"> <div class="contentsecdiv"> <div class="contentleftdiv"> <div class="bannerdiv"><?php include 'banner.php'; ?></div> <div class="spacer1"></div> <div class="spacer2"></div> <div class="contentsec"> <h1>Welcome <span><?php echo $user_details['name']; ?></span></h1> <div class="spacer1"></div> <div class="resisterdiv"> <div class="transactiontoplinkdiv"> <div class="regtoplink"><a href="new_transaction">Start a New Transation</a></div> <div class="regtoplink"><a href="my_account">My Account</a></div> </div> <div class="transaction_title">Transactions Detail</div> <div class="spacer1"></div> <?php if($_REQUEST[msg]=='added'){ ?> <div class="error_msg" align="center">Transaction has been canceled successfully.</div> <?php } ?> <div class="spacer1"></div> <div class="transaction_text">Transactions associated to <em><?php echo $user_details['email']; ?></em></div> <?php if($num_status=='1'){?><br/><div class="transactionmsg_text">Please accept transaction number <a href="#"><?php echo $transaction_no;?></a> opened by the <?php echo $mem_type;?> <em><?php echo $member_email;?></em></div><?php } ?><div class="spacer1"></div> <div> <!--Responsive table Starts here------------------------> <form id="frm" name="frm" method="post" action=""> <div class="table"> <div class="table-head"> <div class="column" data-label="Transaction ID" style="width:16%;">Transaction ID</div> <div class="column" data-label="Description" style="width:17%;">Description</div> <div class="column" data-label="Status" style="width:20%;">Status</div> <div class="column" data-label="Total Price" style="width:13%;">Total Price</div> <div class="column" data-label="Email" style="width:25%;">Email</div> <div class="column" data-label="Options" style="width:9%;">Options</div> </div> <?php $i=1; $num=$dbf->countRows('member_transaction',"member_id='$_SESSION[user_id]' || party_email='$user_details[email]' AND status='0'"); foreach($dbf->fetch('member_transaction',"member_id='$_SESSION[user_id]' || party_email='$user_details[email]' AND status='0'","id","","DESC") as $res_membertransaction){ $res_status=$dbf->fetchSingle("member_transaction_status","mem_transaction_id='$res_membertransaction[id]' order by id DESC");?> <div class="row"> <div class="column" data-label="Transaction ID"><a href="view_transaction_next?transactionid=<?php echo $res_membertransaction[transaction_no];?>"><?php echo $res_membertransaction[transaction_no];?></a></div> <div class="column" data-label="Description" style="color:#242424;"><?php echo $res_membertransaction[brief_descr];?></div> <div class="column" data-label="Status" style="color:#242424;"><?php echo $res_status[status];?></div> <div class="column" data-label="Total Price" style="color:#242424;"><?php echo $res_membertransaction[total_price];?> <?php echo $res_membertransaction[currency];?></div> <div class="column" data-label="Email"><a href="mailto:<?php echo $res_membertransaction[party_email];?>"><?php echo $res_membertransaction[party_email];?></a></div> <div class="column" data-label="Options"> <select name="option<?php echo $i;?>" id="option<?php echo $i;?>" onChange="ChangeOption(<?php echo $i;?>)"> <option value="">Select</option> <?php if($num_status=='1'){?><option value="accept">Accept</option><?php } ?> <option value="view">View</option> <option value="modify">Modify</option> <option value="cancel">Cancel</option> </select> <input type="hidden" name="memberTransactionID" id="memberTransactionID<?php echo $i;?>" value="<?php echo $res_membertransaction[id];?>"> </div> </div> <?php $i++; } ?> </div> <?php if($num==""){ ?> <div class="spacer2"></div> <div class="error_msg" align="center">No transaction found</div> <?php } ?> </form> <!--Responsive table Ends here--------------------------> </div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="spacer1"></div> <div class="spacer1"></div> </div> <div class="spacer1"></div> </div><div class="shadow"><img src="images/shadow.png" /></div> </div> <div class="contentrightdiv"><?php include 'right_menu.php'; ?></div> <div class="spacer2"></div> <div class="spacer1"></div> </div> </div><footer><?php include('footer.php');?></footer></body></html>
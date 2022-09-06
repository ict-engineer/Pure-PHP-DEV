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

//Fetch data from member_transaction====================================
$member_transaction=$dbf->fetchSingle("member_transaction","transaction_no='$_REQUEST[transactionid]'");
//Fetch data from members ==============================================
$membername=$dbf->fetchSingle("members","id='$member_transaction[member_id]'");
//Fetch data from transaction_originate ================================
$originate=$dbf->fetchSingle("transaction_originate","id='$member_transaction[transaction_originate]'");

if($_REQUEST['action']=='edit_transaction')
{
	//$transaction_no=mt_rand(10000, 99999);
	$brief_descr=addslashes($_REQUEST['brief_descr']);
	$currency=addslashes($_REQUEST['currency']);
	$goods=addslashes($_REQUEST['goods']);
	$quantity=addslashes($_REQUEST['quantity']);
	$description=addslashes($_REQUEST['description']);
	$unit_price=addslashes($_REQUEST['amount']);
	$total_price=addslashes($_REQUEST['total']);
	$inspection_period=addslashes($_REQUEST['inspection_period']);
	$safedeal_pay=addslashes($_REQUEST['safedeal_pay']);
	$postage_packing_cost=addslashes($_REQUEST['postage_packing_cost']);
	$postage_packing_pay=addslashes($_REQUEST['postage_packing_pay']);
	
	$tot_price=str_replace("," , "", $total_price);
	
	if($currency=="EUR" || $currency=="USD")
	{
		if($tot_price<=5000){
			$safedeal_fee=($tot_price/100)*2;
		}
		//Total Price is 5001 to 25000==========
		if($tot_price>=5001 AND $tot_price<=25000){
			$safedeal_fee=($tot_price/100)*1.5;
		}
		//Total Price is 25001 to 250000==========
		if($tot_price>=25001 AND $tot_price<=250000){
			$safedeal_fee=($tot_price/100)*1;
		}
		//Total Price is 250001 to 500000==========
		if($tot_price>=250001 AND $tot_price<=500000){
			$safedeal_fee=($tot_price/100)*0.85;
		}
		//Total Price is above 500000==============
		if($tot_price>500000){
			$safedeal_fee=($tot_price/100)*0.65;
		}
	}
	
	else if($currency=="GBP")
	{
		if($tot_price<=3500){
			$safedeal_fee=($tot_price/100)*2;
		}
		//Total Price is 3501 to 17000==========
		if($tot_price>=3501 AND $tot_price<=17000){
			$safedeal_fee=($tot_price/100)*1.5;
		}
		//Total Price is 17001 to 176000==========
		if($tot_price>=17001 AND $tot_price<=176000){
			$safedeal_fee=($tot_price/100)*1;
		}
		//Total Price is 176001 to 352000==========
		if($tot_price>=176001 AND $tot_price<=352000){
			$safedeal_fee=($tot_price/100)*0.85;
		}
		//Total Price is above 352000==============
		if($tot_price>352000){
			$safedeal_fee=($tot_price/100)*0.65;
		}
	}
	
	$banks_cost=round($tot_price/100);
	$total_debit=round($tot_price-$safedeal_fee);
	$balance=$total_debit;
	
	$dated=date("Y-m-d");
	
	//Update data from member_transaction Table=========================
	$string="brief_descr='$brief_descr',currency='$currency',goods='$goods',quantity='$quantity',description='$description',unit_price='$unit_price',total_price='$total_price',inspection_period='$inspection_period',safedeal_pay='$safedeal_pay',postage_packing_cost='$postage_packing_cost',postage_packing_pay='$postage_packing_pay',safedeal_fee='$safedeal_fee',banks_cost='$banks_cost',total_debit='$total_debit',balance='$balance',updated_date='$dated'";
	
	$dbf->updateTable("member_transaction",$string,"id='$_REQUEST[transaction_id]'");
	header("location:edit_transaction?msg=added&transactionid=$_REQUEST[transaction_no]");
}

?>
<script language="Javascript" src="js/calculations.js"></script>
<body><?php include 'header.php';?><nav><div class="menubar"><?php include 'menu.php';?></div></nav><div class="contentouterdiv"><div class="contentsecdiv"><div class="contentleftdiv"><div class="bannerdiv"><?php include 'banner.php';?></div><div class="spacer1"></div><div class="spacer2"></div><div class="contentsec"><h4>Modify Transaction number <span><?php echo $_REQUEST[transactionid];?></span> of <span><?php echo $membername[email];?></span></h4><div class="spacer1"></div><div class="contxt"><strong>The obligatory points are marked with </strong> <span>*</span></div><div class="spacer2"></div><form name="edit_transaction_frm" id="edit_transaction_frm" action="edit_transaction" method="post" onSubmit="return validate_edittransaction();"><input type="hidden" id="action" name="action" value="edit_transaction"/><input type="hidden" id="transaction_id" name="transaction_id" value="<?php echo $member_transaction[id];?>"/><input type="hidden" id="transaction_no" name="transaction_no" value="<?php echo $member_transaction[transaction_no];?>"/><div class="resisterdiv"><?php if($_REQUEST[msg]=='added'){ ?><div class="suc_msg" align="center">Transaction has been updated successfully.</div><div class="spacer"></div><?php } ?><div class="spacer1"></div><div><h3>Transaction details</h3></div><div class="spacer"></div><div class="memlogintxt">Brief description (Max 50 Character) : <span>*</span></div><div class="memlogintbcon"><input type="text" class="memlogintb" id="brief_descr" name="brief_descr" value="<?php echo $member_transaction[brief_descr];?>" maxlength="50"/></div><div id="lbl_brief_descr"></div><div>(Example : Audi car, Yamaha motorcyle, Sony-Vaio Laptop")</div><div class="spacer1"></div><div class="memlogintxt">Currency <span>*</span></div><div class="memlogintbcon"><select class="memlogintb" id="currency" name="currency"><option value="EUR" <?php if($member_transaction[currency]=="EUR"){ echo "Selected"; } ?>>EUR</option><option value="USD" <?php if($member_transaction[currency]=="USD"){ echo "Selected"; } ?>>USD</option><option value="GBP" <?php if($member_transaction[currency]=="GBP"){ echo "Selected"; } ?>>GBP</option></select></div><div class="spacer1"></div><div class="spacer"></div><div><div class="table"><div class="table-head"><div class="column" data-label="Goods" style="width:23%;">Goods</div><div class="column" data-label="Qantity"  style="width:10%;">Qantity</div><div class="column" data-label="Description" style="width:41%;">Description</div><div class="column" data-label="Unit Price" style="width:13%;">Unit Price</div><div class="column" data-label="Total Price" style="width:13%;">Total Price</div></div><div class="row"><div class="column" data-label="Goods"><input type="text" style="width:100%;" name="goods" id="goods" value="<?php echo $member_transaction[goods];?>"></div><div class="column" data-label="Qantity"><input type="text" style="width:100%; text-align:center;" value="<?php echo $member_transaction[quantity];?>" maxlength="3" name="quantity" id="quantity" onKeyUp="javascript:doTotalsCalc(form);calcfee(form);"></div><div class="column" data-label="Description"><input type="text" style="width:100%;" value="<?php echo $member_transaction[description];?>" name="description" maxlength="99" id="description"></div><div class="column" data-label="Unit Price"><input type="text" style="width:100%;" value="<?php echo $member_transaction[unit_price];?>" name="amount" id="amount" onKeyUp="javascript:doTotalsCalc(form);calcfee(form);" onBlur="this.value=trim(this.value);doTotalsCalc(form);calcfee(form);"></div><div class="column" data-label="Total Price"><input type="text" style="width:100%;" value="<?php echo $member_transaction[total_price];?>" name="total" readonly="readonly" id="total" onBlur="doTotalsCalc(form);"></div></div></div></div><div id="lbl_company"></div><div class="spacer1"></div><div class="spacer1"></div><div><h3>Inspection period and cost </h3></div><div class="spacer1"></div><div class="memlogintxt">Length of the Inspection period (in days): <span>*</span></div><div class="memlogintbcon"><input type="text" class="memlogintb" value="<?php echo $member_transaction[inspection_period];?>" id="inspection_period" name="inspection_period" /></div><div id="lbl_inspection_period"></div><div class="spacer1"></div><div class="memlogintxt">Who pays for the SafeDeal service ? <span>*</span></div><div class="memlogintbcon"><select class="memlogintb" id="safedeal_pay" name="safedeal_pay"><option value="Buyer" <?php if($member_transaction[safedeal_pay]=="Buyer"){ echo "Selected"; } ?>>Buyer</option><option value="Seller" <?php if($member_transaction[safedeal_pay]=="Seller"){ echo "Selected"; } ?>>Seller</option><option value="Both Parties" <?php if($member_transaction[safedeal_pay]=="Both Parties"){ echo "Selected"; } ?>>Both Parties</option></select></div><div id="lbl_payment_opt"></div><div class="spacer1"></div><div class="memlogintxt">Postage and packing cost : <span>*</span></div><div class="memlogintbcon"><input type="text" class="memlogintb" value="<?php echo $member_transaction[postage_packing_cost];?>" id="postage_packing_cost" name="postage_packing_cost" /></div><div id="lbl_postage_packing_cost"></div><div class="spacer1"></div><div class="memlogintxt">Who pays for the postage and packing : <span>*</span></div><div class="memlogintbcon"><select class="memlogintb" id="postage_packing_pay" name="postage_packing_pay"><option value="Buyer" <?php if($member_transaction[postage_packing_pay]=="Buyer"){ echo "Selected"; } ?>>Buyer</option><option value="Seller" <?php if($member_transaction[postage_packing_pay]=="Seller"){ echo "Selected"; } ?>>Seller</option></select></div><div id="lbl_payment_opt"></div><div class="spacer1"></div><div class="spacer1"></div><div align="center"><input type="image"src="images/submit.png" /></div><div class="spacer1"></div><div class="spacer1"></div></div></form><div class="spacer1"></div></div><div class="shadow"><img src="images/shadow.png" /></div></div><div class="contentrightdiv"><?php include 'right_menu.php'; ?></div><div class="spacer2"></div><div class="spacer1"></div></div></div><footer><?php include('footer.php');?></footer></body></html>
function ChangeOption(row){
	//alert("hello");
	var memberTransactionID = "memberTransactionID"+row;
	var memberTransactionID = document.getElementById(memberTransactionID).value;
	//alert(memberTransactionID);
	var option = "option"+row;
	var transaction_option = document.getElementById(option).selectedIndex;
	var option = document.getElementById(option).options[transaction_option].text;
	//alert(option);
	//$.post("ajax_Change_transactionoption.php",{"memberTransactionID":memberTransactionID,"option":option})
	window.location.href = "ajax_Change_transactionoption.php?memberTransactionID=" + memberTransactionID+"&option=" + option;
	//window.location.href = "index";
}
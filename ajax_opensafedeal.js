//For Add Images Fancybox starts here================
function fancy_safedeal(){
	$.fancybox.showActivity();
	var url="safedeal_fee.php";	
	$.post(url,function(res){ 
		//$.fancybox(res);	
		$.fancybox.hideActivity();
		$.fancybox(res,{centerOnScroll:true,hideOnOverlayClick:false});
	});
}
function print_trackingdetail()
{
	window.print("print_tracking_detail.php?trackingno=<?php echo $_REQUEST[trackingno];?>");
	/*document.frm.action='print_tracking_detail';
	document.frm.submit();*/
}
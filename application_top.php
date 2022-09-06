<?php
$ip=$_SERVER['REMOTE_ADDR'];
$num_visitor=$dbf->countRows("visitors","ip_address='$ip' and status='1'");
if($num_visitor!=0){
	//header("location:index");exit;
	header("Location: block.html");
}
 //Browser Name Script Starts here===============================
 if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
 	$brawserName='Internet explorer';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
 	$brawserName='Mozilla Firefox';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
 	$brawserName='Google Chrome';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
 	$brawserName='Apple Safari';
 else
 	$brawserName='Unknown Browser';
 //Browser Name Script Ends here================================
 	
 $server_url=$_SERVER['REQUEST_URI'];
 //echo "<pre>";
 //print_r($_SERVER['HTTP_USER_AGENT']);exit;
 $referrer=$_SERVER['HTTP_REFERER'];
 $hostname=$_SERVER['HTTP_HOST'];

 $address_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
 //$address_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=180.87.255.62'));
 //echo "<pre>";
 //print_r($address_details);exit;
 $city = stripslashes(ucfirst($address_details[geoplugin_city]));
 $country = stripslashes(ucfirst($address_details[geoplugin_countryName]));
 
 $string="country_name='$country',city_name='$city',ip_address='$ip',host_name='$hostname',browser_name='$brawserName',url_address='$server_url',referrer='$referrer',visit_date=now()";	
 $dbf->insertSet("visitors",$string);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" /><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"><title><?php echo $pageTitle;?></title><meta name="Keywords" content="<?php echo $metaKeyword;?>"/><meta name="Description" content="<?php echo $metaDescr;?>"/><link rel="stylesheet" type="text/css" href="css/tranrun.css" /><link rel="stylesheet" type="text/css" href="css/layout.css" /><link rel="stylesheet" type="text/css" href="css/medium.css" /><link rel="stylesheet" type="text/css" href="css/narrow.css" /><link rel="stylesheet" type="text/css" href="css/narrower.css" /><link rel="stylesheet" type="text/css" href="css/narrowest.css" /><link rel="stylesheet" type="text/css" href="css/respmenu.css" /><link rel="stylesheet" href="css/table.css" type="text/css" /><script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script><script src="js/jquery-1.7.2.min.js"></script><script src="js/validation.js"></script><link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" /><script src="js/jquery.flexslider-min.js"></script><script src="js/banneronload.js"></script><script type="text/javascript" src="fancybox/jquery.fancybox-1.3.2.js"></script><link href="fancybox/jquery.fancybox-1.3.2.css" type="text/css" rel="stylesheet" /></head>
<?php
include_once 'config.php';
include_once 'class.dbFunctions.php';

//Involves Any User operations*********************************************************************************************************************
class User extends Dbfunctions
{
//Database connect 
public function __construct()
{
$db = new DB_Class();
}

//Registration process 
public function register_user($company_id, $email, $password)
{
$password = md5($password);
$sql = mysql_query("SELECT id from users WHERE email = '$email'");
$no_rows = mysql_num_rows($sql);
if ($no_rows == 0)
{
$result = mysql_query("INSERT INTO users values ('', '$company_id','$email','$password')") or die(mysql_error());
return $result;
}
else
{
return FALSE;
}
}

// Login process
public function check_login($emailusername, $password)
{
//$password = md5($password);
$result = mysql_query("SELECT * from admin WHERE email  = '$emailusername'  and password = '$password' AND active_status='1'");
$admin_data = mysql_fetch_array($result);
$no_rows = mysql_num_rows($result);
if ($no_rows == 1)
{
$_SESSION['login'] = true;
	
$_SESSION['admin_id'] = $admin_data['id'];
return TRUE;
}
else
{
return FALSE;
}
}
// Getting name
public function get_fullname($uid)
{
$result = mysql_query("SELECT name FROM users WHERE uid = $uid");
$user_data = mysql_fetch_array($result);
echo $user_data['name'];
}


// Getting email
public function get_email($uid)
{
$result = mysql_query("SELECT email FROM users WHERE id = $uid");
$user_data = mysql_fetch_array($result);
echo $user_data['email'];
}

// Getting session 
public function get_session()
{
return $_SESSION['login'];
}

// Logout 
public function user_logout()
{
$_SESSION['login'] = FALSE;
session_destroy();
}

}
//**************************************************************************************************************************************************************

//Class for Database oriented Functions END*****************************************************************************************************************************

/********CURRENCY CONVERSION(up to 2 decimal places)*********/
function convert_currency($from_Currency,$to_Currency,$amount) {

$amount = urlencode($amount);
$from_Currency = urlencode($from_Currency);
$to_Currency = urlencode($to_Currency);
$rawdata= mb_convert_encoding(file_get_contents("http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency"),"HTML-ENTITIES","UTF-8");
$data = explode('"', $rawdata);//Array ( [0] => {lhs: [1] => 1 U.S. dollar [2] => ,rhs: [3] => 55.819146 Indian rupees [4] => ,error: [5] => [6] => ,icc: true} ) 
$data = explode(' ', $data['3']); //Array ( [0] => 55.7786702 [1] => Indian [2] => rupees ) 
$var = $data['0'];
//return $var;
return round($var,2);
}

/********GET CURRENCY CODE FROM IP*********/
function get_currency_fromIp(){
	//$_SERVER['REMOTE_ADDR']='180.87.201.222';
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
	 //check for ip from share internet
	 $ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
	 // Check for the Proxy User
	 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
	{
	 $ip = $_SERVER["REMOTE_ADDR"];
	}
	
	$result_arr=array(); 
	$result_arr=unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	return $result_arr['geoplugin_currencyCode'];
}


/********GET CONVERTED PRICE ACCORDING TO CURRENCY (up to 2 decimal places)*********/
function get_converted_price($to_currency,$amount,$currency_value){
	
	$price=$amount*$currency_value;
	return round($price,2);
}
/********GET RANDON PROMOCODE*********/
/*function get_promocode(){
$code= substr(number_format(time() * rand(),0,'',''),0,16); 
$num=countDigits($code);
$required=15-$num;
  if($required>0){
	  if($required==1){
		$min=1;
		$max=9;	
	  }
	  elseif($required==2){
		$min=10;
		$max=99;	
	  }
	  elseif($required==3){
		$min=100;
		$max=999;	
	  }
	  $code.=rand($min,$max);
  }
return $code;
}*/
/********GET NUMBER OF DIGITS*********/
/*function countDigits( $str )
{
    return preg_match_all( "/[0-9]/", $str,$out );
}
*/
/********GET RANDOM PROMOCODE*********/
function get_promocode($length='') {
	
	if($length=='')
    $length = 15;
	
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = "";    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
	
	$result=mysql_query("select id from promo_code where promo_code='$string' AND NOW() < end_date");
	$count = mysql_num_rows($result);
	if($count>0){
		get_promocode();
	}
    return $string;
}

/********GENERATE RANDOM PASSWORD*********/
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/********PAYPAL REFUND*********/
function PPHttpPost($methodName_, $nvpStr_,$api_user,$api_pwd,$api_signature,$environment) {
	
 
	// Set up your API credentials, PayPal end point, and API version.
/*	$API_UserName = urlencode('deepik_1357280183_biz_api1.bletindia.com');
	$API_Password = urlencode('1357280206');
	$API_Signature = urlencode('AdtxUajNMHAmtArnznRg9--TMlKCAJUOuj8rFTp0vVtSf0PGoZOJH70G');*/
	$API_UserName = urlencode($api_user);
	$API_Password = urlencode($api_pwd);
	$API_Signature = urlencode($api_signature);
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment) {
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode('51.0');
 
	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
 
	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
 
	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
 
	// Set the request as a POST FIELD for curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
 
	// Get response from the server.
	$httpResponse = curl_exec($ch);
 
	if(!$httpResponse) {
		exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
	}
 
	// Extract the response details.
	$httpResponseAr = explode("&", $httpResponse);
 
	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}
 
	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	}
 
	return $httpParsedResponseAr;
}

/********CURRENCY CONVERSION(up to 2 decimal places)*********/
function convert_currency1($from_Currency,$to_Currency,$amount) {

$amount = urlencode($amount);
$from_Currency = urlencode($from_Currency);
$to_Currency = urlencode($to_Currency);
$rawdata= mb_convert_encoding(file_get_contents("http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency"),"HTML-ENTITIES","UTF-8");
$data = explode('"', $rawdata);//Array ( [0] => {lhs: [1] => 1 U.S. dollar [2] => ,rhs: [3] => 55.819146 Indian rupees [4] => ,error: [5] => [6] => ,icc: true} ) 
$data = explode(' ', $data['3']); //Array ( [0] => 55.7786702 [1] => Indian [2] => rupees ) 
$var = $data['0'];
return $var;

}
/********GET CONVERTED PRICE ACCORDING TO CURRENCY (up to 2 decimal places)*********/
function get_converted_price1($to_currency,$amount,$currency_value){
	
	return $price=$amount*$currency_value;
	
}
/*function convert_me($str) { 
    //preg_replace('/\s+/', '', $string);   
    $str = preg_replace("/[^\w\d\.\-]/","-",$str);
    return $str;
}*/
?>
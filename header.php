<?php

if ($_REQUEST['lang_id']){
	
	setcookie('lang',$_REQUEST['lang_id'],time() + (86400* 700));
	$_COOKIE['lang'] = $_REQUEST['lang_id'];
	//echo $_COOKIE['lang'];
}

function translate($html,$dest) {
	
	$html = str_replace("\n"," ", $html);
	preg_match_all("/<([^>]*)>/", $html, $matches, PREG_SET_ORDER);

	$i=1;
	$chk = array();
	foreach ($matches as $val) {
		
		$tag = $val[1];
		if(!$chk[base64_encode($tag)]) {
			$chk[base64_encode($tag)] = $i;
			$html = str_replace("<$tag>"," [$i] ",$html);
		}
		$i++;
	}
	//echo "<hr>$html<hr><br>";
	//$html = preg_replace("/<([^>]*)>/is","@base64_encode($1)@",$html);
	//$html =	preg_replace_callback('/<([^>]*)>/is', create_function('$m', 'return "<".(base64_encode($m[1]).">";'), $html);
	//echo "<hr>".$html."<hr>";
	
	$useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";

 	$curl = curl_init();
    $url = 'http://translate.google.com/';
    $post = 'js=n&prev=_t&hl=en&ie=UTF-8&layout=2&eotf=1&sl=en&tl='.$dest.'&text=' . utf8_encode(urlencode($html));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $page = curl_exec($curl);
	//echo $page;
	
    curl_close($curl);
    preg_match('/<span id=result_box class="(long_text|short_text)">(.*?)<\/span><\/span><\/div><\/div>/is', $page, $matches);
    $page = $matches[2];
	$page = preg_replace('/<span title="[^>]*>/is',"",$page);
    $page = str_replace('</span>', '', $page);
	//$page = preg_replace("/@([^@]*)@/is","<".base64_decode($1).">",$page);
	$page =	preg_replace_callback('/<([^>]*)>/is', create_function('$m', 'return "<".base64_decode($m[1]).">";'), $page);
	
	foreach ($chk as $tag => $value) {
		$page = str_replace("[$value]","<".base64_decode($tag).">",$page);
		$page = str_replace("[$value ]","<".base64_decode($tag).">",$page);
		$page = str_replace("[ $value]","<".base64_decode($tag).">",$page);
	}
	
	if ($page) {
    	return $page;
	} else {
		return $html;
	} 
}

if(isset($_POST["page"]))
{ 
	$page = $_POST["page"];
	
	if($page=="home")
	{
		$page="index";
	}
	
	if($page=="trackingnumber")
	{
		$page = "tracking";
	}
	
	if($page=="ldd")
	{
		$page = "ldd";
	}
	
	if($page=="pdfd")
	{
		$page = "pdfd";
	}
	
	if($page=="escrow")
	{
		$page = "safedeal";
	}
	
	if($page=="ctsandmvr")
	{
		$page = "ctsandmvr";
	}
	
	if($page=="esgarage")
	{
		$page = "garage";
	}
	
	if($page=="support")
	{
		$page = "support";
	}
	
	if($page=="contact")
	{
		$page = "contact";
	}
	header("Location: $page");
}
?>
<div class="topbar"><div class="topcon"><div class="logocon"><a href="index"><img src="images/logo.png" border="0" /></a></div><div class="logoresp" align="center"><a href="index"><img src="images/logo.png" border="0" /></a></div><div class="toprightdiv"><div class="topbarlistdiv"><div class="langlistdiv"><form action="" name="mul_languages" method="post"><select size="1" name="lang_id" id="lang_id" alt="" class="toplistmenu" onChange="document.mul_languages.submit();"><option selected="" value="en">Language (Beta)</option><option value="ar">Arabic</option><option value="bg">Bulgarian</option><option value="ca">Catalan</option><option value="hr">Croatian</option><option value="cs">Czech</option><option value="da">Danish</option><option value="nl">Dutch</option><option value="en">English</option><option value="tl">Filipino</option><option value="fi">Finnish</option><option value="fr">French</option><option value="de">German</option><option value="el">Greek</option><option value="iw">Hebrew</option><option value="hi">Hindi</option><option value="hu">Hungarian</option><option value="id">Indonesian</option><option value="it">Italian</option><option value="ja">Japanese</option><option value="lv">Latvian</option><option value="lt">Lithuanian</option><option value="mt">Maltese</option><option value="no">Norwegian</option><option value="pl">Polish</option><option value="ro">Romanian</option><option value="sr">Serbian</option><option value="sk">Slovak</option><option value="sl">Slovenian</option><option value="es">Spanish</option><option value="sv">Swedish</option><option value="th">Thai</option><option value="vi">Vietnamese</option></select></form></div><form name="quicklinks" method="POST" action=""><div class="categorydiv"><select name="page" class="toplistmenu" onChange="javascript:document.quicklinks.submit();"><option>Select a Category</option><?php foreach($dbf->fetch('category_tbl',"","id","","ASC") as $res_cat){ ?><option value="<?php echo $res_cat['category_url'];?>"><?php echo $res_cat['category_name'];?></option><?php } ?></select></div></form></div><div class="spacer"></div><div class="topmenu"><ul><li><a href="lbskilos_converter">LBS-Kilos Converter </a></li><li><a href="timezones">Timezones</a></li><li><a href="packaging">Packaging tips</a></li><li><a href="about">About Transmith Group</a></li><?php if($_SESSION['user_id']!=''){ ?><li><a href="logout">Log Out</a></li><?php } ?></ul></div></div></div></div>
<?php
$fhtml = ob_get_contents();
ob_end_clean();

if ($_COOKIE['lang'])
{
	if ($_COOKIE['lang'] == "en")
	{ 
		echo $fhtml;
	} 
	else 
	{
		echo html_entity_decode(translate( $fhtml, $_COOKIE['lang']));
	}
}

else{
	echo $fhtml;	
}	
?>
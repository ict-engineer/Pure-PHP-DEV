<?php
/*define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'bletpw9w_tranrun');
define('DB_PASSWORD', 'tranrun@2013');
define('DB_DATABASE', 'bletpw9w_tranrun');*/

/*define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tranrunc_tranrun');
define('DB_PASSWORD', 'tranrun@123');
define('DB_DATABASE', 'tranrunc_tran');
*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'hachier_tsmith');
define('DB_PASSWORD', 'tsmith@123');
define('DB_DATABASE', 'hachier_tsmith');

class DB_Class
{
	function __construct()
	{
		$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or
		die('Oops connection error -> ' . mysql_error());
		mysql_select_db(DB_DATABASE, $connection)
		or die('Database error -> ' . mysql_error());
	}
}

/**********************General WebSite Settings************************************/
//define('DATE_FORMAT', 'd-M-Y');
//define('DATE_TIME_FORMAT', 'd-M-Y, h:i a');
?>
<?php
require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');

// Check if the user is AdworkMedia
$ip = getIp();
if ($ip == '67.227.230.75' || $ip = '67.227.230.76')
{
	// Get the adworkmedia data
	$sid = mysql_real_escape_string($_GET['sid']);
	$status = mysql_real_escape_string($_GET['status']);
	$vc_value = mysql_real_escape_string($_GET['vc_value']);
	
	// Check the status
	if ($status == 1)
	{
		// Update the user credits
		$query = $BDD->prepare('UPDATE exchange_users SET points=points+:vc_value WHERE id=:sid LIMIT 1;');
		$query->bindParam(':vc_value', intval(vc_value));
		$query->bindParam(':sid', intval(sid));
		$query->execute();
	}
}
else
{
	displayNotAllowed();
	exit();
}

?>
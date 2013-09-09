<?php
require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get the user infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));

?>
<html>
	<head>
		<title>Survey - <?=$SITE_TITLE?></title>
	</head>
	
	<body>
		<script type="text/javascript">awm = false;</script> 
		<script src="http://www.adworkmedia.com/gLoader.php?GID=8300&go=&sid=<?=$user_id?>" type="text/javascript"></script>
		<script type="text/javascript">if (!awm) { window.location = 'http://adworkmedia.com/help/removeAB.php'; }</script>
		<noscript>Please enable JavaScript to access this page.  <meta http-equiv="refresh" content="0;url=http://adworkmedia.com/help/enableJS.php" /></noscript>	  	
	</body>
</html>
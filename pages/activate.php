<?php

require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');

if ( isLoggedOn() )
{
	displayAlreadyLoggedOn();
	exit();
}

if(isset($_GET['key']) && $_GET['key'] != 0)
{
	$key = htmlspecialchars($_GET['key']);
	$query = $BDD->prepare('UPDATE exchange_users SET activate=\'0\' WHERE activate=:key LIMIT 1;');
	$query->bindParam(':key', $key);
	$query->execute();
	
	if ($query->rowCount() == 1)
		echo '<center><b>E-mail address successfully verified!</b></center>';
	else
		echo '<center><b>Incorrect Link!</b></center>';
}
else
{
	echo '<center><b>Incorrect Link!</b></center>';
}

echo '<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=index.php">';
?>
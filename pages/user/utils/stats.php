<?php

require('../../../config/config.php');
require('../../../config/mysql.php');
require('../../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

$user_id = intval(htmlspecialchars($_SESSION['userid']));
$query = $BDD->prepare('SELECT points FROM exchange_users WHERE id=:id LIMIT 1;');
$query->bindParam(':id', $user_id);
$query->execute();
$points = $query->fetchColumn();

echo $points == 0 ? 'None' : $points;

?>
<?php

require('../../../config/config.php');
require('../../../config/mysql.php');
require('../../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get user id
$user_id = intval(htmlspecialchars($_SESSION['userid']));

// Get timer
$query = $BDD->prepare('SELECT timestamp FROM exchange_done WHERE user_id=:userid AND validated=0 AND type=1 LIMIT 1;');
$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
$query->execute();

$now = time();
$expected = strtotime($query->fetchColumn()) + 13;
if ($query->rowCount() == 1 && $now >= $expected)
{
	// Get membership
	$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
	$query->bindParam(':id', $user_id, PDO::PARAM_INT);
	$query->execute();
	$isPremium = $query->fetchColumn() == 1;
	$membership = $isPremium ? 'Premium' : 'Free';
	$rates = $isPremium ? $PREMIUM_RATES * 2 : $NORMAL_RATES * 2;
	
	// Get website id
	$query = $BDD->prepare('SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=1 AND validated=0 LIMIT 1;');
	$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
	$query->execute();
	$website_id = $query->fetchColumn();

	// Set the website as validated
	$query = $BDD->prepare('UPDATE exchange_done SET validated=1 WHERE user_id=:userid AND type=1 AND validated=0 LIMIT 1;');
	$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
	$query->execute();

	// Increment user points
	$query = $BDD->prepare('UPDATE exchange_users SET points=points+:points WHERE id=:userid LIMIT 1;');
	$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
	$query->bindParam(':points', $rates, PDO::PARAM_INT);
	$query->execute();
	
	// Change website stats
	$query = $BDD->prepare('UPDATE exchange_youtube_views SET available=available-:points, done=done+1 WHERE id=:site_id LIMIT 1;');
	$query->bindParam(':site_id', $website_id, PDO::PARAM_INT);
	$query->bindParam(':points', $rates, PDO::PARAM_INT);
	$query->execute();
	
	echo 'VALID';
	exit();
}
else
{
	echo 'INVALID';
	exit();
}

?>
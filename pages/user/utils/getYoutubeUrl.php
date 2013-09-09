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

// Get membership
$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$isPremium = $query->fetchColumn() == 1;
$membership = $isPremium ? 'Premium' : 'Free';
$rates = $isPremium ? $PREMIUM_RATES * 2 : $NORMAL_RATES * 2;

// Invalidate all
$query = $BDD->prepare('DELETE FROM exchange_done WHERE (user_id=:user_id AND type=1 AND validated=0) OR ((timestamp+24*60*1000)<NOW()) LIMIT 1;');
$query->bindParam(':user_id', intval(htmlspecialchars($_SESSION['userid'])));
$query->execute();

// Get next url
$query = $BDD->prepare('SELECT id, url FROM exchange_youtube_views WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=1) AND available>:minimum ORDER BY priority DESC LIMIT 1;');
$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
$query->bindParam(':minimum', intval($rates));
$query->execute();
$site = $query->fetchAll();

if ($query->rowCount() == 1)
{
	$site_id = $site[0]['id'];
	$site_url = $site[0]['url'];

	// Set current
	$query = $BDD->prepare('INSERT INTO exchange_done VALUES (\'\', :site_id, 1, :userid, NOW(), 0);');
	$query->bindParam(':site_id', intval($site_id));
	$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
	$query->execute();

	// Display id and url
	echo str_replace('http://', '', $site_url);
	exit();
}
else
{
	echo str_replace('http://', '', $SITE_URL).'noentry.php';
	exit();
}

?>
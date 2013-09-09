<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get the user infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));

// Get top 10
$query = $BDD->prepare('SELECT username, points FROM exchange_users ORDER BY points DESC LIMIT 10;');
$query->execute();
$users = $query->fetchAll();

// Get personnal rank
$query = $BDD->prepare('SELECT (SELECT COUNT(*) FROM exchange_users WHERE id<=:userid1 ORDER BY points DESC) AS position FROM exchange_users WHERE id=:userid2 LIMIT 1;');
$query->bindParam(':userid1', $user_id, PDO::PARAM_INT);
$query->bindParam(':userid2', $user_id, PDO::PARAM_INT);
$query->execute();
$rank = $query->fetchColumn();

// Get total users
$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_users;');
$query->execute();
$total = $query->fetchColumn();
?>

<h2 class="title">Leaderboard</h2>

<div class="large center">
	Here is a list of our members who own the biggest amount of points.<br />
	You are currently ranked <?=$rank?> on <?=$total?>.<br /><br />
	<table class="table">
		<tr>
			<th>Username</th>
			<th>Points</th>
		</tr>
		<?php
		foreach($users as $user)
		{
			echo '<tr><td>'. $user['username'] .'</td><td>'. $user['points'] .'</td></tr>';
		}
		?>
		<tr>
			<th colspan="2"></th>
		</tr>
		</table>
</div>
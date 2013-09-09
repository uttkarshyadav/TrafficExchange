<?php

require('../../../config/config.php');
require('../../../config/mysql.php');
require('../../../config/authentification.php');

if ( !isLoggedOn() )
{
	printResponse(false, array('You have to be logged in to edit your account.'));
	exit();
}

$user_id = intval(htmlspecialchars($_SESSION['userid']));

if (isset($_POST['type']))
{
	$type = intval(htmspecialchars($_POST['type']));
	$name = htmspecialchars($_POST['name']);
	
	switch ($type)
	{
		case 0:
			$query = $BDD->prepare('IF EXISTS (SELECT id FROM exchange_accounts WHERE userid=:id1 AND type=0) UPDATE exchange_accounts SET username=:username1 WHERE userid=:id2 AND type=0 ELSE INSERT INTO exchange_accounts VALUES (NULL, 0, :username2, :id3);');
			$query->bindParam(':id1', $user_id);
			$query->bindParam(':id2', $user_id);
			$query->bindParam(':id3', $user_id);
			$query->bindParam(':username1', $name);
			$query->bindParam(':username2', $name);
			$query->execute();
			printResponse(true, array('Your Facebook account has been updated.'));
			exit();
			break;
		case 1:
			$query = $BDD->prepare('IF EXISTS (SELECT id FROM exchange_accounts WHERE userid=:id1 AND type=1) UPDATE exchange_accounts SET username=:username1 WHERE userid=:id2 AND type=1 ELSE INSERT INTO exchange_accounts VALUES (NULL, 1, :username2, :id3);');
			$query->bindParam(':id1', $user_id);
			$query->bindParam(':id2', $user_id);
			$query->bindParam(':id3', $user_id);
			$query->bindParam(':username1', $name);
			$query->bindParam(':username2', $name);
			$query->execute();
			printResponse(true, array('Your Twitter account has been updated.'));
			exit();
			break;
		case 2:
			$query = $BDD->prepare('IF EXISTS (SELECT id FROM exchange_accounts WHERE userid=:id1 AND type=2) UPDATE exchange_accounts SET username=:username1 WHERE userid=:id2 AND type=2 ELSE INSERT INTO exchange_accounts VALUES (NULL, 2, :username2, :id3);');
			$query->bindParam(':id1', $user_id);
			$query->bindParam(':id2', $user_id);
			$query->bindParam(':id3', $user_id);
			$query->bindParam(':username1', $name);
			$query->bindParam(':username2', $name);
			$query->execute();
			printResponse(true, array('Your Youtube account has been updated.'));
			exit();
			break;
		case 3:
			$query = $BDD->prepare('IF EXISTS (SELECT id FROM exchange_accounts WHERE userid=:id1 AND type=3) UPDATE exchange_accounts SET username=:username1 WHERE userid=:id2 AND type=3 ELSE INSERT INTO exchange_accounts VALUES (NULL, 3, :username2, :id3);');
			$query->bindParam(':id1', $user_id);
			$query->bindParam(':id2', $user_id);
			$query->bindParam(':id3', $user_id);
			$query->bindParam(':username1', $name);
			$query->bindParam(':username2', $name);
			$query->execute();
			printResponse(true, array('Your Digg account has been updated.'));
			exit();
			break;
		case 4:
			$query = $BDD->prepare('IF EXISTS (SELECT id FROM exchange_accounts WHERE userid=:id1 AND type=4) UPDATE exchange_accounts SET username=:username1 WHERE userid=:id2 AND type=4 ELSE INSERT INTO exchange_accounts VALUES (NULL, 4, :username2, :id3);');
			$query->bindParam(':id1', $user_id);
			$query->bindParam(':id2', $user_id);
			$query->bindParam(':id3', $user_id);
			$query->bindParam(':username1', $name);
			$query->bindParam(':username2', $name);
			$query->execute();
			printResponse(true, array('Your Google account has been updated.'));
			exit();
			break;
		default:
			printResponse(false, array('This account type doesn\'t exist.'));
			exit();
			break;
	}
}
else
{
	displayNotAllowed();
	exit();
}

?>
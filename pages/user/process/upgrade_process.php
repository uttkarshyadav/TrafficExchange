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

if (isset($_POST['password']))
{
	$password = htmlspecialchars($_POST['password']);
	$password = hashPwd($password);
	$captcha = htmlspecialchars($_POST['captcha']);
	if (strtoupper($captcha) == $_SESSION['captcha'])
	{
		// Check password
		$query = $BDD->prepare('SELECT COUNT(id), registration_date FROM exchange_users WHERE id=:id AND password=:password LIMIT 1;');
		$query->bindParam(':id', $user_id);
		$query->bindParam(':password', $password);
		$query->execute();
		$user = $query->fetchAll();
		
		if ($query->rowCount() == 1)
		{
			// Check if the user is not already premium
			$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
			$query->bindParam(':id', $user_id);
			$query->execute();
			$isPremium = $query->fetchColumn() == 1;
			if ($isPremium)
			{			
				// Check registration date (60 days)
				$registration_date = $user[0]['registration_date'];
				if ( strtotime($registration_date) + 5184000 < time() )
				{
					// Check referals
					$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_users WHERE ref=:userid;');
					$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
					$query->execute();
					if ($query->fetchColumn() >= 5)
					{
						// Add the user to the database
						$query = $BDD->prepare('INSERT INTO exchange_upgrade VALUES (NULL, :userid, NOW(), 0);');
						$query->bindParam(':userid', $userid);
						$query->execute();
						
						printResponse(true, array('Your upgrade request has been successfully sent. We\'ll treat it soon.'));
						exit();
					}
					else
					{
						printResponse(false, array('You must have refered at least 5 members.'));
						exit();
					}
				}
				else
				{
					printResponse(false, array('You are not a member of this site for at least 2 month. Please try again later.'));
					exit();
				}
			}
			else
			{
				printResponse(false, array('You are already premium.'));
				exit();
			}
		}
		else
		{
			printResponse(false, array('The password doesn\'t match with your account.'));
			exit();
		}
	}
	else
	{
		printResponse(false, array('This security code you entered does not match the code we sent, or it has expired.'));
		exit();
	}
}
else
{
	displayNotAllowed();
	exit();
}
<?php
require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( isLoggedOn() )
{
	printResponse(false, array('You are already logged on.'));
	exit();
}

// Something has been sent
if (isset($_POST['username']))
{
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$password = hashPwd($password);
	$captcha = htmlspecialchars($_POST['captcha']);
	
	if (strtoupper($captcha) == $_SESSION['captcha'])
	{
		// Get user infos
		$query = $BDD->prepare('SELECT id, activate, banned FROM exchange_users WHERE username=:username AND password=:password LIMIT 1;');
		$query->bindParam(':username', $username);
		$query->bindParam(':password', $password);
		$query->execute();
		$user = $query->fetchAll();
		
		if ($query->rowCount() == 1)
		{
			$userid = intval($user[0]['id']);
			$activate = $user[0]['activate'];
			$banned = $user[0]['banned'];
			$ip = ' '.getIp();
			
			// Check if the account has been activated
			if ($activate != 0)
			{
				printResponse(false, array('You first need to confirm your email address !'));
				exit();
			}
			if ($banned != 0)
			{
				printResponse(false, array('You have been banned, never come back !'));
				exit();
			}
			
			// Set session
			setSession($userid, $password);
			
			// Update the last_ips field and the last_login
			$query = $BDD->prepare('UPDATE exchange_users SET last_ips=last_ips+:current_ip, last_login=NOW() WHERE id=:userid LIMIT 1;');
			$query->bindParam(':userid', $userid);
			$query->bindParam(':current_ip', $ip);
			$query->execute();
			
			// TODO display dashboard + menu
			printResponse(true, array('You have been successfully logged in.', 'You will be redicted shortly.'));
			exit();
		}
		else
		{
			printResponse(false, array('The username doesn\'t match with the password or the username doesn\t exists.'));
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
	
?>
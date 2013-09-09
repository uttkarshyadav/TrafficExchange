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

if (isset($_POST['email']))
{
	$email = htmlspecialchars($_POST['email']);
	$newsletter = htmlspecialchars($_POST['subscribe']);
	
	$query = $BDD->prepare('UPDATE exchange_users SET email=:email, newsletter=:newsletter WHERE id=:userid LIMIT 1;');
	$query->bindParam(':email', $email);
	$query->bindParam(':newsletter', $newsletter);
	$query->bindParam(':userid', $user_id);
	$query->execute();
	
	if ($query->rowCount() == 1)
	{
		printResponse(true, array('Your email settings have been successfully changed.'));
		exit();
	}
	else
	{
		printResponse(false, array('A error occued while trying to change your email settings.'));
		exit();
	}
}
else if (isset($_POST['password']))
{
	$password = htmlspecialchars($_POST['password']);
	$password = hashPwd($password);
	$new_password = htmlspecialchars($_POST['new_password']);
	$new_password = hashPwd($new_password);
	
	$query = $BDD->prepare('UPDATE exchange_users SET password=:new_password WHERE id=:userid AND password=:password LIMIT 1;');
	$query->bindParam(':email', $email);
	$query->bindParam(':password', $password);
	$query->bindParam(':new_password', $new_password);
	$query->execute();
	
	if ($query->rowCount() == 1)
	{
		printResponse(true, array('Your password has been successfully updated.', 'It may require a reconnection.'));
		exit();
	}
	else
	{
		printResponse(false, array('Your current password might be wrong. Please try again.'));
		exit();
	}
}
else
{
	displayNotAllowed();
	exit();
}
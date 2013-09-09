<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( isLoggedOn() )
{
	printResponse(false, array('You cannot create a new account while beging already logged in.'));
	exit();
}

// Something has been sent
if (isset($_POST['username']))
{
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$password = hashPwd($password);
	$gender = htmlspecialchars($_POST['gender']);
	$country = htmlspecialchars($_POST['country']);
	$captcha = htmlspecialchars($_POST['captcha']);
	$subscribe = htmlspecialchars($_POST['subscribe']);
	
	if (strtoupper($captcha) == $_SESSION['captcha'])
	{
		// Check if user or email already exists
		$query = $BDD->prepare('SELECT id FROM exchange_users WHERE username=:username OR email=:email LIMIT 1;');
		$query->bindParam(':username', $username);
		$query->bindParam(':email', $email);
		if ($query->rowCount() == 1)
		{
			printResponse(false, array('This E-mail or this usernmae is already taken by one of our members. Please choose another.'));
			exit();
		}
	
		// Check coupon
		$points = 0;
		if (isset($_POST['coupon']))
		{
			$coupon = htmlspecialchars($_POST['coupon']);
			$query = $BDD->prepare('SELECT value FROM exchange_coupons WHERE coupon=:coupon LIMIT 1;');
			$query->bindParam(':coupon', $value);
			$query->execute();
			$points = intval($query->fetchColumn());
		}
		
		
		
		// If there is a referer, give him some points
		if (isset($_COOKIE['referal']))
		{
			$ref_id = htmlspecialchars($_COOKIE['referal']);
			$query = $BDD->prepare('UPDATE exchange_users SET points=points+:amount WHERE id=:id LIMIT 1;');
			$query->bindParam(':id', $ref_id, PDO::PARAM_INT);
			$query->bindParam(':amount', $REFERAL_POINTS);
			$query->execute();
			
			// Insert into DB
			$query = $BDD->prepare('INSERT INTO exchange_users VALUES (NULL, :username, :password, :email, :gender, :country, :subscribe, 0, :points, 0, :last_ips, NOW(), :ref, NOW());');
			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password);
			$query->bindParam(':email', $email);
			$query->bindParam(':gender', $gender);
			$query->bindParam(':country', $country);
			$query->bindParam(':subscribe', $subscribe);
			$query->bindParam(':points', $points);
			$query->bindParam(':last_ips', getIp());
			$query->bindParam(':ref', $ref_id);
			$query->execute();
		}
		else
		{
			// Insert into DB
			$query = $BDD->prepare('INSERT INTO exchange_users VALUES (NULL, :username, :password, :email, :gender, :country, :subscribe, 0, :points, 0, :last_ips, NOW(), NOW());');
			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password);
			$query->bindParam(':email', $email);
			$query->bindParam(':gender', $gender);
			$query->bindParam(':country', $country);
			$query->bindParam(':subscribe', $subscribe);
			$query->bindParam(':points', $points);
			$query->bindParam(':last_ips', getIp());
			$query->execute();
		}
		
		printResponse(true, array('Your account has been successfully created.', 'Please check your email inbox to activate your account.'));
		exit();
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
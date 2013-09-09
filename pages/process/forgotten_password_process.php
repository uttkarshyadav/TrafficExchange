<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( isLoggedOn() )
{
	printResponse(false, array('If you are already logged in, it means you know your password !'));
	exit();
}

// Something has been sent
if (isset($_POST['email']))
{
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$captcha = htmlspecialchars($_POST['captcha']);
	
	if (strtoupper($captcha) == $_SESSION['captcha'])
	{
		// Generate a new password
		$caracteres_aleatoire = str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
		$password = substr($caracteres_aleatoire, 0, 8);
		$password_enc = hashPwd($password);
		
		// Set user infos
		$query = $BDD->prepare('UPDATE exchange_users SET password=:password WHERE username=:username AND email=:email LIMIT 1;');
		$query->bindParam(':username', $username);
		$query->bindParam(':email', $email);
		$query->bindParam(':password', $password_enc);
		$query->execute();
		
		if ($query->rowCount() == 1)
		{
			// Send an email with the new password
			$email_subject = 'Password recovery - '. $SITE_TITLE;
			$email_message = 'Hello,'."\n".'Your password has been reseted.'."\n".'Your new password is '.$password."\n\n".'We hope to see you soon.'."\n".$SITE_TITLE;
			$email_headers = 'From: '.$SITE_EMAIL."\r\n" .
			'Reply-To: '.$SITE_EMAIL."\r\n" .
			'X-Mailer: PHP/' . phpversion();

			mail($SITE_CONTACT, $email_subject, $email_message, $email_headers);
			
			printResponse(true, array('Your password has been reseted.', 'A new password has been sent to your email address.'));
			exit();
		}
		else
		{
			printResponse(false, array('Can\'t find any account with the given information.'));
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
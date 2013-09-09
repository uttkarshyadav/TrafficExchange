<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

// Something has been sent
if (isset($_POST['name']))
{
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$message = htmlspecialchars($_POST['message']);
	$captcha = htmlspecialchars($_POST['captcha']);
	
	if (strtoupper($captcha) == $_SESSION['captcha'])
	{
		// Send an email with the new password
		$email_subject = 'New message From '. $SITE_TITLE;
		$email_message = $name.'('.$message.') has sent you the following message:'."\n\n".$message;
		$email_headers = 'From: '.$SITE_EMAIL."\r\n" .
		'Reply-To: '.$SITE_EMAIL."\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($email, $email_subject, $email_message, $email_headers);
		
		printResponse(true, array('Your message has been sent. We\'ll answer as soon as possible.'));
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
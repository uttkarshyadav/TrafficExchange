<?php
require('../../config/config.php');

if (isset($_GET['e']))
{
	$error_id = htmlspecialchars($_GET['e']);
	$error_type = 'Page not found';
	if ($error_type == '500')
	{
		$message = 'Our server is encountering an unexpected error. Please try again later.';
	}
	else
	{
		$message = 'It appears the page you were looking for doesn\'t exist or might have been moved.';
	}	
}
else
{
	$error_id = 'Ukn';
	$error_type = 'Unknown error';
	$message = 'It appears the page you were looking for doesn\'t exist or might have been moved.';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?=$SITE_TITLE?> - <?=$error_id?> <?=$error_type?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="robots" content="noindex,nofollow" />
		
		<link rel="icon" type="image/png" href="<?=$SITE_URL?>assets/images/logo.png">
		<link href='<?=$SITE_URL?>assets/stylesheets/404.css' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<div class="error_page">
			<div class="error_left">
				<img alt="<?=$error_id?> <?=$error_type?>" src="<?=$SITE_URL?>assets/images/404.png" />
			</div>
			<div class="error_right">
				<h1><?=$error_id?></h1>
				<h2>Sorry</h2>
				<p><?=$message?></p>
			</div>
			<p><a href="<?=$SITE_URL?>">Return to the homepage</a></p>
		</div>
	</body>
</html>
<?php
require('config/config.php');

if($_GET['ref'] != '')
{
	$referal = htmlspecialchars($_GET['ref']);
	setcookie('referal', $referal, time()+3600);
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title><?=$SITE_TITLE?></title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="description" content="<?=SITE_DESCRIPTION?>" />
	<meta name="keywords" content="<?=SITE_KEYWORDS?>" />
	<meta name="robots" content="index, follow" />
	
	<link rel="icon" type="image/png" href="<?=$SITE_URL?>assets/images/logo.png">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href="<?=$SITE_URL?>assets/stylesheets/style.css" rel="stylesheet" type="text/css">
	
	<noscript>
		<META HTTP-EQUIV="Refresh" CONTENT="1; URL=<?=$SITE_URL?>/noscript.php">
	</noscript>
</head>
<body>
	<div id="loading">
		<img id="loading-image" src="<?=$SITE_URL?>assets/images/loader.gif" alt="Loading ..." /><br />
		<div id="loading-text"><strong>Loading ... Please wait</strong></div>
	</div>

	<div id="sidebar"></div>
	<div id="page">
		<div id="alert">ADSENSE</div>
		<div id="pageContents"></div>
		<div id="footer">
			<a href="http://validator.w3.org/check?uri=referer" target="_blank"><img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/html401.png" alt="Valid HTML 4.01 Transitional" title="Valid HTML 4.01 Transitional"></a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank"><img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/css21.gif" alt="Valid CSS level 2.1" title="Valid CSS level 2.1"></a>
			<img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/javascript.png" alt="JavaScript Powered" title="JavaScript Powered">
			<img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/ajax.png" alt="AJAX Powered" title="AJAX Powered">
			<a href="http://www.php.net/" target="_blank"><img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/php5.png" alt="PHP Powered" title="PHP Powered"></a>
			<a href="http://www.mysql.com/" target="_blank"><img style="border:none;" src="<?=$SITE_URL?>assets/images/icons/mysql.gif" alt="MySQL Powered" title="MySQL Powered"></a><br />
			<?=$SITE_TITLE?> - Copyright &copy; 2013
		</div>
	</div>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=$SITE_URL?>assets/javascripts/validate.min.js"></script>
<script type="text/javascript" src="<?=$SITE_URL?>assets/javascripts/content_provider.js"></script>
<script type="text/javascript" src="<?=$SITE_URL?>assets/javascripts/traffic_exchange.js"></script>
<script type="text/javascript" src="<?=$SITE_URL?>assets/javascripts/jquery.knob.js"></script>


<script type="text/javascript">
	firstLaunch();
</script>

</html>
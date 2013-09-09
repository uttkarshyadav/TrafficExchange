<?php
require('config/config.php');
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Error - Traffic Exchange</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="description" content="<?=SITE_DESCRIPTION?>" />
	<meta name="keywords" content="<?=SITE_KEYWORDS?>" />
	<meta name="robots" content="index, follow" />
	
	<link rel="icon" type="image/png" href="<?=$SITE_URL?>assets/images/logo.png">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href="<?=$SITE_URL?>assets/stylesheets/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<center><h1 style="color:#FF0000;">Oops !</h1></center><br /><br />
	<div class="large center" style="width:60%;color:#DBDBDB;">
		<center><p style="color:#FF0000;">
			<strong>Javascript is not enabled on your browser.  To use this website, you must have Javascript enabled on your browser.</strong>
		</p></center>
		<br /><br />
		<p>
			<input value="What is Javascript ?" class="button blue" /><br />
			Javascript is a programming language that can interact with the user (you) and instruct your browser to behave in certain ways.
		</p>
		<br /><br />
		<p>
			<input value="Why does this website need Javascript ?" class="button blue" /><br />
			<?=$SITE_TITLE?> contains a lot of dynamic content - by which I mean that the contents of each page changes each time you view it (as opposed to static web pages, which never change). The website uses Javascript to make sense of this changing information, and to ensure any data entered by the user (you) makes sense. It also uses Javascript to sort tables of information into alphabetical order, create visual effects, and streamline the browsing experience (whatever that means).
		</p>
		<br /><br />
		<p>
			<input value="Are there any security risks associated with turning on Javascript ?" class="button blue" /><br />
			As with any programming language, yes, but Javascript cannot read, write or delete anything on your computer, and as such cannot plant a virus on your system, nor steal any data stored on your machine. In fact, most browsers are so confident they come with Javascript enabled by default.
		</p>
		<br /><br />
		<p>
			<input value="How do I turn Javascript on ?" class="button blue" /><br />
			Depends on your browser.<br /><br />
			<ul>
				<li>Internet Explorer: Click on "Tools" in the menu bar, then "Internet Options".  Click on the "Security" tab at the top of the new window, then on the "Custom level" button in the "Security level for this zone" box.  In the next window, scroll down the list of settings, and right near the bottom your will see a "Scripting" section.  Next to "Active scripting", click on the "Enable" radio button.  Also make sure that the "Scripting of Java applets" is enabled, because this site uses those as well.</li>
				<li>Mozilla Firefox: Click on "Tools" in the menu bar, then "Options".  Click on "Content" (or "Web features") on the tab at the top of the new window, and make sure a tick is in the "Enable Javascript" check box.  This site also requires Java, so you may as well put a tick in the "Enable Java" box as well.</li>
				<li>Opera: Click on "Tools" in the menu bar, then "Quick Preferences", and then make sure a tick is next to "Enable Javascript".  As this site also requires Java, it may be as well to also place a tick next to "Enable Java" whilst you’re at it.</li>
				<li>Safari: Select "Safari" from the menu, and choose "Preferences".  Now select "Security" on select the "Enable Javascript" check box.  This site also requires Java, so if you want to view any worksheets, you’ll need to tick the "Enable Java" tick box as well.</li>
				<li>Chrome: Click on this link: <a href="chrome://settings/search" target="_blank">chrome://settings/search</a>. Click on "Show advanced settings" and touch "Content settings". Then tick the box "Enable Javascript".</li>
			</ul>
		</p>
	</div>
</body>
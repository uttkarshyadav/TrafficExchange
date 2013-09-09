<?php
require('../config/config.php');
?>

<h2 class="title">Welcome on <?=$SITE_TITLE?></h2>

<div class="large center">
	<p>Our exchange system allows you to pick and choose who you want to follow, like, view and skip those who you are not interested in. The exchange system is very simple. Every time you like, follow, or view another members social media pages you will receive coins which then you can use to get more followers, likes, views or visitors to your website or social media pages.</p>

	<p><strong>A few common questions we want to answer to put your mind at ease:</strong></p>
	<p>
	1. We do not sell followers, likes, friends, views or website hits.<br />
	2. We abide by Twitter's Rules and Facebook's Policies.<br />
	3. We never post tweets or status updates from any of your accounts.<br />
	4. We will never ask you for your password to any of your social network accounts.
	</p>
	<br />
	<center>
		<h2>What can you exchange at our website?</h2>
		<p>We cater to most social networks, here are the ones we currently offer.</p><br/>
		
		<a href="javascript:;" onclick="loadPage('<?=$SITE_URL?>pages/register.php', 'Register - <?=$SITE_TITLE?>', 'register');">
			<img src="<?=$SITE_URL?>assets/images/icons/facebook.png" alt="Facebook"/>
			<img src="<?=$SITE_URL?>assets/images/icons/googleplus.png" alt="Google"/>
			<img src="<?=$SITE_URL?>assets/images/icons/digg.png" alt="Digg"/>
			<img src="<?=$SITE_URL?>assets/images/icons/twitter.png" alt="Twitter"/>
			<img src="<?=$SITE_URL?>assets/images/icons/youtube.png" alt="Youtube"/>
			<img src="<?=$SITE_URL?>assets/images/icons/traffic.png" alt="Traffic"/>
		</a><br/><br/>
		
		<input type="submit" value="What are you waiting for ? Signup now for free !" class="button blue" onclick="loadPage('<?=$SITE_URL?>pages/register.php', 'Register - <?=$SITE_TITLE?>', 'register');" />
	</center>
</div>
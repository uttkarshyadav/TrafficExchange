<?php
require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');
?>

<?php
if (isLoggedOn())
{
	// Get username
	$query = $BDD->prepare('SELECT username FROM exchange_users WHERE id=:id LIMIT 1;');
	$query->bindParam(':id', intval(htmlspecialchars($_SESSION['userid'])));
	$query->execute();
	
	$username = $query->fetchColumn();
	
	// Get membership
	$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
	$query->bindParam(':id', intval(htmlspecialchars($_SESSION['userid'])));
	$query->execute();
	$isPremium = $query->fetchColumn() == 1;

	if ($isPremium)
	{
		echo '<script type="text/javascript">removeAds();</script>';
	}
	?>
	
	<img src="<?=$SITE_URL?>assets/images/logo.png" alt="<?=$SITE_TITLE?>" title="<?=$SITE_TITLE?>" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/dashboard.php', 'Dashboard - <?=$SITE_TITLE?>', 'dashboard');">
	
	<ul>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/dashboard.php', 'Dashboard - <?=$SITE_TITLE?>', 'dashboard');" id="dashboard">Dashboard</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/logout.php', 'Logout - <?=$SITE_TITLE?>', 'logout');" id="logout">Logout [<?=$username?>]</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/stats.php', 'Stats - <?=$SITE_TITLE?>', 'stats');" id="stats">Stats</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/faq.php', 'FAQ - <?=$SITE_TITLE?>', 'faq');" id="faq">FAQ</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/contact_us.php', 'Contact us - <?=$SITE_TITLE?>', 'contact_us');" id="contact_us">Contact us</a></li>
	</ul>
	
	<?php
}
else
{
	?>
	
	<img src="<?=$SITE_URL?>assets/images/logo.png" alt="<?=$SITE_TITLE?>" title="<?=$SITE_TITLE?>" onClick="javascript:loadPage('<?=$SITE_URL?>pages/home.php', 'Home - <?=$SITE_TITLE?>', 'home');">
	
	<ul>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/home.php', 'Home - <?=$SITE_TITLE?>', 'home');" id="home" class="active">Home</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/register.php', 'Register - <?=$SITE_TITLE?>', 'register');" id="register">Register</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/login.php', 'Login - <?=$SITE_TITLE?>', 'login');" id="login">Login</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/stats.php', 'Stats - <?=$SITE_TITLE?>', 'stats');" id="stats">Stats</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/faq.php', 'FAQ - <?=$SITE_TITLE?>', 'faq');" id="faq">FAQ</a></li>
		<li><a onClick="javascript:loadPage('<?=$SITE_URL?>pages/contact_us.php', 'Contact us - <?=$SITE_TITLE?>', 'contact_us');" id="contact_us">Contact us</a></li>
	</ul>
	
	<?php
}
?>
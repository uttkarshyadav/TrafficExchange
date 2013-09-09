<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get the user infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));
$query = $BDD->prepare('SELECT username, points FROM exchange_users WHERE id=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch();

$username = $result['username'];
$user_points = $result['points'];

// Get membership
$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$isPremium = $query->fetchColumn() == 1;
$membership = $isPremium ? 'Premium' : 'Free';
$rates = $isPremium ? $PREMIUM_RATES : $NORMAL_RATES;
?>

<h2 class="title">Welcome <?=$username?></h2>

<div class="large center">
	<center>
		<div class="dashboard_row">
			<div class="dashboard_stats">
				<span>Your points:</span>
				<p id="points"><?php echo $user_points == 0 ? 'None' : number_format($user_points) ?></p>
			</div>
			<div class="dashboard_stats">
				<span>Your membership:</span>
				<p><?=$membership?></p>
			</div>
			<div class="dashboard_stats">
				<span>Current rates:</span>
				<p><?=$rates?> : 1</p>
			</div>
		</div>
		<br />
		<div class="dashboard_row">
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/account.php', 'Account - <?=$SITE_TITLE?>', 'account');">
				<img src="<?=$SITE_URL?>assets/images/account.png" alt="Your account" />
				<p>Manage your account</p>
			</div>
			
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/membership.php', 'Membership - <?=$SITE_TITLE?>', 'membership');">
				<img src="<?=$SITE_URL?>assets/images/membership.png" alt="Your membership" />
				<p>Upgrade your account</p>
			</div>

			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/logout.php', 'Logout - <?=$SITE_TITLE?>', 'logout');">
				<img src="<?=$SITE_URL?>assets/images/logout.png" alt="Logout" />
				<p>Terminate this session</p>
			</div>
		</div>

		<div class="dashboard_row">
			<div class="dashboard_item" onClick="javascript:startExchange();">
				<img src="<?=$SITE_URL?>assets/images/traffic_exchange.png" alt="Traffic exchange" />
				<p>Traffic player</p>
			</div>
			
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/earn_points.php', 'Earn points - <?=$SITE_TITLE?>', 'earn_points');">
				<img src="<?=$SITE_URL?>assets/images/earn_points.png" alt="Earn points" />
				<p>Earn points</p>
			</div>
			
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/leaderboard.php', 'Leaderboard - <?=$SITE_TITLE?>', 'leaderboard');">
				<img src="<?=$SITE_URL?>assets/images/leaderboard.png" alt="Leaderboard" />
				<p>Leaderboard</p>
			</div>
		</div>

		<div class="dashboard_row">
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/my_pages.php', 'Your links - <?=$SITE_TITLE?>', 'my_links');">
				<img src="<?=$SITE_URL?>assets/images/pages.png" alt="Your links" />
				<p>Manage your links</p>
			</div>
			
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/social_accounts.php', 'Social accounts - <?=$SITE_TITLE?>', 'social_accounts');">
				<img src="<?=$SITE_URL?>assets/images/social_accounts.png" alt="Social accounts" />
				<p>Manage your social accounts</p>
			</div>
			
			<div class="dashboard_item" onClick="javascript:loadPage('<?=$SITE_URL?>pages/user/affiliates.php', 'Affiliates - <?=$SITE_TITLE?>', 'affiliates');">
				<img src="<?=$SITE_URL?>assets/images/affiliates.png" alt="Affiliates" />
				<p>Affiliates</p>
			</div>
		</div>
	</center>
</div>

<script type="text/javascript">
setTimeout("refreshUserStats()", 10000);
</script>
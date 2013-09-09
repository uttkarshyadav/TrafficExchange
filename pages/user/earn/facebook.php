<?php

require('../../../config/config.php');
require('../../../config/mysql.php');
require('../../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get the user infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));

// Get membership
$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_upgrade WHERE userid=:id AND active=1 LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$isPremium = $query->fetchColumn() == 1;
$membership = $isPremium ? 'Premium' : 'Free';
$rates = $isPremium ? $PREMIUM_RATES : $NORMAL_RATES;

?>



<div class="large">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<div class="button blue" onclick="expandTab('#part_one');"><strong>Like</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block;">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_facebook_likes WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=1) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$fb_likes = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($fb_likes as $like)
			{
				$like_id = intval($like['id']);
				$like_url = $like['url'];
				$like_title = $like['title'];
				$like_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$like_id?>">
					<div class="title"><?=$like_title?></div>
					<div class="points">Points: <?=$like_points?></div>
					<div class="button gray" onClick=""><img src="<?=$SITE_URL?>assets/images/like.png" alt="Like" height="16px" width="16px" /> Like</div>
				</div>
				<?php
			}
			?>
		</div>
		<br />
	</div>

	<div class="button blue" onclick="expandTab('#part_two');"><strong>Share</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_facebook_share WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=2) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$fb_shares = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($fb_shares as $share)
			{
				$share_id = intval($share['id']);
				$share_url = $share['url'];
				$share_title = $share['title'];
				$share_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$share_id?>">
					<div class="title"><?=$share_title?></div>
					<div class="points">Points: <?=$share_points?></div>
					<div class="button gray" onClick="">Share</div>
				</div>
				<?php
			}
			?>
		</div>
		<br />
	</div>

	<div class="button blue" onclick="expandTab('#part_three');"><strong>Subscribe</strong> (Click to expand/collapse)</div>
	<div id="part_three" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_facebook_subs WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=3) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$fb_subs = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($fb_subs as $sub)
			{
				$sub_id = intval($sub['id']);
				$sub_url = $sub['url'];
				$sub_title = $sub['title'];
				$sub_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$sub_id?>">
					<div class="title"><?=$sub_title?></div>
					<div class="points">Points: <?=$sub_points?></div>
					<div class="button gray" onClick="">Subscribe</div>
				</div>
				<?php
			}
			?>
		</div>
		<br />
	</div>
	
	<div class="button blue" onclick="expandTab('#part_four');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_four" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
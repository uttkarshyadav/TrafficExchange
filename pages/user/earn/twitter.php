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
	
	<div class="button blue" onclick="expandTab('#part_one');"><strong>Follow</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_twitter_follow WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=6) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$follows = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($follows as $follow)
			{
				$follow_id = intval($follow['id']);
				$follow_url = $follow['url'];
				$follow_title = $follow['title'];
				$follow_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$follow_id?>">
					<div class="title"><?=$follow_title?></div>
					<div class="points">Points: <?=$follow_points?></div>
					<div class="button gray" onClick="">Follow</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>

	<div class="button blue" onclick="expandTab('#part_two');"><strong>Retweet</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_twitter_retweet WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=7) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$retweets = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($retweets as $retweet)
			{
				$retweet_id = intval($retweet['id']);
				$retweet_url = $retweet['url'];
				$retweet_title = $retweet['title'];
				$retweet_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$retweet_id?>">
					<div class="title"><?=$retweet_title?></div>
					<div class="points">Points: <?=$retweet_points?></div>
					<div class="button gray" onClick="">Retweet</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>
	
	<div class="button blue" onclick="expandTab('#part_three');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_three" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
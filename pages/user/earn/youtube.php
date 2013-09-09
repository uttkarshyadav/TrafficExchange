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
$rates = $isPremium ? $PREMIUM_RATES * 2 : $NORMAL_RATES * 2;

?>

<script>
	$(".timer").knob({
		"min":0,
		"max":30,
		"thickness":"0.2",
		"fgColor":"#08C",
		"skin":"tron",
		"angleOffset":"180",
		"readOnly":true
	});
</script>

<div class="large">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<div class="button blue" onclick="expandTab('#part_one');"><strong>Player</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
		You will receive <?=$rates?> points for each video you view.
		<div class="button green" onClick="player_start(true);">Start Youtube player</div>
		<div class="button red" onClick="player_stop();">Stop Youtube player</div>
		<br />
		<table>
			<tr>
				<td width="210px"></td>
				<td>
					<strong>Last 5 videos viewed</strong>
				</td>
			</tr>
			<tr>
				<td>
					<input class="timer" value="30" />
				</td>
				<td>
					<table>
						<tr style="display:none" id="player_history_h0" width="200px">
							<td>Now</td>
							<td id="player_history0"></td>
						</tr>
						<tr style="display:none" id="player_history_h1">
							<td>30 sec. ago</td>
							<td id="player_history1"></td>
						</tr>
						<tr style="display:none" id="player_history_h2">
							<td>1 min. ago</td>
							<td id="player_history2"></td>
						</tr>
						<tr style="display:none" id="player_history_h3">
							<td>90 sec. ago</td>
							<td id="player_history3"></td>
						</tr>
						<tr style="display:none" id="player_history_h4">
							<td>2 min. ago</td>
							<td id="player_history4"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br />
	</div>
	
	<div class="button blue" onclick="expandTab('#part_two');"><strong>Like</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_youtube_likes WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=8) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$likes = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($likes as $like)
			{
				$like_id = intval($like['id']);
				$like_url = $like['url'];
				$like_title = $like['title'];
				$like_points = 2 * $rates;
				parse_str(parse_url($like_url, PHP_URL_QUERY), $like_url_array);
				$video_id = $like_url_array['v'];
				
				?>
				<div class="elem_earn" id="like_<?=$like_id?>">
					<div class="title"><?=$like_title?></div>
					<div class="icon"><img src="http://i.ytimg.com/vi/<?=$video_id?>/default.jpg" height="40px" width="54px"/></div>
					<div class="points">Points: <?=$like_points?></div>
					<div class="button gray" onClick=""><img src="<?=$SITE_URL?>assets/images/like.png" alt="Like" height="16px" width="16px" /> Like</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>

	<div class="button blue" onclick="expandTab('#part_three');"><strong>Dislike</strong> (Click to expand/collapse)</div>
	<div id="part_three" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_youtube_dislikes WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=9) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$dislikes = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($dislikes as $dislike)
			{
				$dislike_id = intval($dislike['id']);
				$dislike_url = $dislike['url'];
				$dislike_title = $dislike['title'];
				$dislike_points = 2 * $rates;
				parse_str(parse_url($dislike_url, PHP_URL_QUERY), $dislike_url_array);
				$video_id = $dislike_url_array['v'];
				
				?>
				<div class="elem_earn" id="like_<?=$dislike_id?>">
					<div class="title"><?=$dislike_title?></div>
					<div class="icon"><img src="http://i.ytimg.com/vi/<?=$video_id?>/default.jpg" height="40px" width="54px"/></div>
					<div class="points">Points: <?=$dislike_points?></div>
					<div class="button gray" onClick=""><img src="<?=$SITE_URL?>assets/images/dislike.png" alt="Like" height="16px" width="16px" /> Dislike</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>

	<div class="button blue" onclick="expandTab('#part_four');"><strong>Subscribe</strong> (Click to expand/collapse)</div>
	<div id="part_four" style="display:none">
		<br />
		<div class="elem_container">
			<?php
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_youtube_subs WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=10) AND available>0 ORDER BY priority DESC LIMIT 15;');
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
				parse_str(parse_url($sub_url, PHP_URL_QUERY), $sub_url_array);
				$video_id = $sub_url_array['v'];
				
				?>
				<div class="elem_earn" id="like_<?=$sub_id?>">
					<div class="title"><?=$sub_title?></div>
					<div class="icon"><img src="http://i.ytimg.com/vi/<?=$video_id?>/default.jpg" height="40px" width="54px"/></div>
					<div class="points">Points: <?=$sub_points?></div>
					<div class="button gray" onClick="">Subscribe</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>
	
	<div class="button blue" onclick="expandTab('#part_five');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_five" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
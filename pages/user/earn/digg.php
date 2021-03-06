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
			$query = $BDD->prepare('SELECT id, url, title FROM exchange_digg WHERE id NOT IN (SELECT traffic_id FROM exchange_done WHERE user_id=:userid AND type=5) AND available>0 ORDER BY priority DESC LIMIT 15;');
			$query->bindParam(':userid', intval(htmlspecialchars($_SESSION['userid'])));
			$query->execute();
			$diggs = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if ($query->rowCount() == 0)
			{
				echo 'No entry available yet. Please come back later.';
			}
			
			foreach ($diggs as $digg)
			{
				$digg_id = intval($digg['id']);
				$digg_url = $digg['url'];
				$digg_title = $digg['title'];
				$digg_points = 2 * $rates;
				
				?>
				<div class="elem_earn" id="like_<?=$digg_id?>">
					<div class="title"><?=$digg_title?></div>
					<div class="points">Points: <?=$digg_points?></div>
					<div class="button gray" onClick="">Follow</div>
				</div>
				<?php
			}
			?>
		</div>
		<br /><br />
	</div>
	
	<div class="button blue" onclick="expandTab('#part_two');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
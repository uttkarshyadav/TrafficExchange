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

<script>
	$(".timer").knob({
		"min":0,
		"max":15,
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
		You will receive <?=$rates?> points for each site you visit.
		<div class="button green" onClick="player_start(false);">Start Traffic Exchange</div>
		<div class="button red" onClick="player_stop();">Stop Traffic Exchange</div>
		<br />
		<table>
			<tr>
				<td width="210px"></td>
				<td>
					<strong>Last 5 websites visited</strong>
				</td>
			</tr>
			<tr>
				<td>
					<input class="timer" value="15" />
				</td>
				<td>
					<table>
						<tr style="display:none" id="player_history_h0" width="200px">
							<td>Now</td>
							<td id="player_history0"></td>
						</tr>
						<tr style="display:none" id="player_history_h1">
							<td>15 sec. ago</td>
							<td id="player_history1"></td>
						</tr>
						<tr style="display:none" id="player_history_h2">
							<td>30 sec. ago</td>
							<td id="player_history2"></td>
						</tr>
						<tr style="display:none" id="player_history_h3">
							<td>45 sec. ago</td>
							<td id="player_history3"></td>
						</tr>
						<tr style="display:none" id="player_history_h4">
							<td>1 min. ago</td>
							<td id="player_history4"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br />
	</div>

	<div class="button blue" onclick="expandTab('#part_two');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
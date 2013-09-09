<?php
require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');

$type_array = array(
	'Traffic exchange' => 'exchange_traffic',
	'Facebook likes' => 'exchange_facebook_likes',
	'Facebook share' => 'exchange_facebook_share',
	'Facebook subscribers' => 'exchange_facebook_subs',
	'Google +1' => 'exchange_googleplus',
	'Digg' => 'exchange_digg',
	'Twitter follow' => 'exchange_twitter_follow',
	'Youtube likes' => 'exchange_youtube_likes',
	'Youtube dislikes' => 'exchange_youtube_dislikes',
	'Youtube views' => 'exchange_youtube_views',
	'Youtube subscribers' => 'exchange_youtube_subs',
	'Surveys' => 'exchange_survey'
);

?>

<h2>Stats</h2>
<div class="large center">
	<div class="button blue" onclick="$('#stats_one').slideToggle('fast');">Members stats (Click to expand/collapse)</div>
	<div id="stats_one" style="display:block;">
		<table class="table">
			<tr>
				<th width="33%">Active members</th>
				<th width="33%">Banned members</th>
				<th width="33%">Total members</th>
			</tr>
			<tr>
				<?php
				$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_users WHERE activate=0;');
				$query->execute();
				$active = $query->fetchColumn();
				
				$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_users WHERE banned=1;');
				$query->execute();
				$banned = $query->fetchColumn();
				
				$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_users;');
				$query->execute();
				$total = $query->fetchColumn();
				?>
				<td class="bordered"><?=number_format($active)?></td>
				<td class="bordered"><?=number_format($banned)?></td>
				<td class="bordered"><?=number_format($total)?></td>
			</tr>
		</table>
		<br /><br />
	</div>

	<div class="button blue" onclick="$('#stats_two').slideToggle('fast');">Exchange stats (Click to expand/collapse)</div>
	<div id="stats_two" style="display:block">
		<table class="table">
			<tr>
				<th width="33%">Type</th>
				<th width="33%">Available entries</th>
				<th width="33%">Points earned</th>
			</tr>
			<?php
				$total_available = 0;
				$total_done = 0;
				foreach($type_array as $key => $value)
				{
					if ($key == 'Surveys')
					{
						$query = $BDD->prepare('SELECT COALESCE(SUM(points), 0) as clicks FROM '.$value.';');
						$query->execute();
						$result = $query->fetch();
						
						$done = $result['clicks'];
						$total_done += $done;
						
						echo '<tr><td>'.$key.'</td><td></td><td>'.number_format($done).'</td>';
					}
					else
					{
						$query = $BDD->prepare('SELECT COUNT(id) as av, COALESCE(SUM(done), 0) as clicks FROM '.$value.';');
						$query->execute();
						$result = $query->fetch();
						
						$available = $result['av'];
						$done = $result['clicks'] or 0;
						
						$total_available += $available;
						$total_done += $done;
						echo '<tr><td>'.$key.'</td><td>'.number_format($available).'</td><td>'.number_format($done).'</td>';
					}
				}
				echo '<tr><th>TOTAL</th><th>'.number_format($total_available).'</th><th>'.number_format($total_done).'</th>';
			?>
		</table>
	</div>
</div>
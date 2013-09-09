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
	
	<div class="button blue" onclick="expandTab('#part_one');"><strong>Complete survey</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
		Clicking on the following link will open a new window. Please disable your adblocker and your popup blocker before.<br /><br />
		<center><strong><a href="<?=$SITE_URL?>survey/survey.php" target="_blank">Click here to launch the survey gateway</a></strong></center>
	<br /><br />
	</div>

	<div class="button blue" onclick="expandTab('#part_two');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
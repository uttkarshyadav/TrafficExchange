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

?>

<div class="large">
	<div class="button blue" onclick="$('#part_one').slideToggle('fast');"><strong>Like</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
	TODO
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_two').slideToggle('fast');"><strong>Dislike</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_three').slideToggle('fast');"><strong>Player</strong> (Click to expand/collapse)</div>
	<div id="part_three" style="display:none">
	TODO
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_four').slideToggle('fast');"><strong>Subscribe</strong> (Click to expand/collapse)</div>
	<div id="part_four" style="display:none">
	TODO
	<br /><br />
	</div>
	
	<div class="button blue" onclick="$('#part_five').slideToggle('fast');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_five" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
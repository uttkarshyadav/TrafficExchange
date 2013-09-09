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
	<div class="button blue" onclick="$('#part_one').slideToggle('fast');"><strong>+1</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
	TODO
	<br /><br />
	</div>
	
	<div class="button blue" onclick="$('#part_two').slideToggle('fast');"><strong>Guide</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>
</div>
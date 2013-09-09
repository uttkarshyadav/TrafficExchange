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
		<br />
		REPLACE WIH DIV INLINE-BLOCK
		<?php
		for ($i=1; $i<5; $i++)
		{
			?>
			<table style="border: 1px solid #000;">
				<tr>
					<td width="25%">SHORT TITLE</td>
					<td width="25%">SHORT TITLE</td>
					<td width="25%">SHORT TITLE</td>
					<td width="25%">SHORT TITLE</td>
				</tr>
				<tr>
					<td>Coins X</td>
					<td>Coins X</td>
					<td>Coins X</td>
					<td>Coins X</td>
				</tr>
				<tr>
					<td>Like</td>
					<td>Like</td>
					<td>Like</td>
					<td>Like</td>
				</tr>
			</table>
			<br />
			<?php
		}
		?>
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_two').slideToggle('fast');"><strong>Share</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
	TODO
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_three').slideToggle('fast');"><strong>Subscribe</strong> (Click to expand/collapse)</div>
	<div id="part_three" style="display:none">
	TODO
	<br /><br />
	</div>
	
	<div class="button blue" onclick="$('#part_four').slideToggle('fast');"><strong>Add link</strong> (Click to expand/collapse)</div>
	<div id="part_four" style="display:none">
		<form id="add-form" action="#" method="POST">
			<table class="left">
				<tr>
					<td width="40%"><label>Title*:</label></td>
					<td width="320px"><input class="big" type="text" name="title" /></td>
				</tr>
				<tr>
					<td width="40%"><label>Url*:</label></td>
					<td width="320px"><input class="big" type="text" name="url" /></td>
				</tr>
				<tr>
					<td><label>Type*:</label></td>
					<td>
						<select class="big" name="type">
							<option value="1" selected="selected">Like</option>
							<option value="2">Share</option>
							<option value="3">Subscriber</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label>Credits*:</label></td>
					<td><input class="big" type="text" name="credits" /></td>
				</tr>
				<tr>
					<td><label>Priority*:</label></td>
					<td>
						<select class="big" name="priority">
							<option value="1" selected="selected">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label>Security code*:</label></td>
					<td><img src="<?=$SITE_URL?>assets/captcha/captcha.php" alt="Captcha" title="Captcha" class="big" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input class="big" type="text" name="captcha" /></td>
				</tr>
				<tr>
					<td colspan="2"><center><i>Form fields with a `*` are required.</i></center></td>
				</tr>
			</table>
			<br /><input type="submit" value="Add link" class="button green" /><br />
		</form>
	</div>
</div>
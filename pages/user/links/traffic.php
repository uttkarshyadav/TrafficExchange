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
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<div class="button blue" onclick="$('#part_one').slideToggle('fast');"><strong>Your links</strong> (Click to expand/collapse)</div>
	<div id="part_one" style="display:block">
		<table class="table">
			<tr>
				<th>#</th>
				<th>Url</th>
				<th>Priority</th>
				<th>Available</th>
				<th>Done</th>
				<th>Actions</th>
			</tr>
			<tr>
				<td>1</td>
				<td>http://google.fr</td>
				<td>5</td>
				<td>90000</td>
				<td>45000</td>
				<td>
					<select name="action" onChange="alert('Do action');">
						<option value="" selected="selected">-</option>
						<option value="edit">Edit</option>
						<option value="delete">Delete</option>
					</select>
				</td>
			</tr>
		</table>
	<br /><br />
	</div>

	<div class="button blue" onclick="$('#part_two').slideToggle('fast');"><strong>Add link</strong> (Click to expand/collapse)</div>
	<div id="part_two" style="display:none">
		<form id="add-form" action="#" method="POST">
			<table class="left">
				<tr>
					<td width="40%"><label>Url*:</label></td>
					<td width="320px"><input class="big" type="text" name="url" /></td>
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
							<option value="6">6</option>
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
<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get current infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));

// Facebook
$query = $BDD->prepare('SELECT username FROM exchange_accounts WHERE type=0 AND userid=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$facebook = $query->fetchColumn();

// Twitter
$query = $BDD->prepare('SELECT username FROM exchange_accounts WHERE type=1 AND userid=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$twitter = $query->fetchColumn();

// Youtube
$query = $BDD->prepare('SELECT username FROM exchange_accounts WHERE type=2 AND userid=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$youtube = $query->fetchColumn();

// Digg
$query = $BDD->prepare('SELECT username FROM exchange_accounts WHERE type=3 AND userid=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$digg = $query->fetchColumn();

// Google
$query = $BDD->prepare('SELECT username FROM exchange_accounts WHERE type=4 AND userid=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$google = $query->fetchColumn();
?>

<h2 class="title">Your social accounts</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	If you don't add your real usernames, used on exchange, you can't earn points.<br /><br />
	<table class="left">
		<form id="facebook-form">
		<tr>
			<td colspan="2" class="table_separator">Facebook account:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Username*:</label></td>
			<td>
				<input class="big" type="text" name="name" value="<?=$facebook?>" />
				<input type="hidden" name="type" value="0" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<form id="twitter-form">
		<tr>
			<td colspan="2" class="table_separator">Twitter account:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Username*:</label></td>
			<td>
				<input class="big" type="text" name="name" value="<?=$twitter?>" />
				<input type="hidden" name="type" value="1" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<form id="youtube-form">
		<tr>
			<td colspan="2" class="table_separator">Youtube account:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Username*:</label></td>
			<td>
				<input class="big" type="text" name="name" value="<?=$youtube?>" />
				<input type="hidden" name="type" value="2" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<form id="digg-form">
		<tr>
			<td colspan="2" class="table_separator">Digg account:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Username*:</label></td>
			<td>
				<input class="big" type="text" name="name" value="<?=$digg?>" />
				<input type="hidden" name="type" value="3" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<form id="google-form">
		<tr>
			<td colspan="2" class="table_separator">Google account:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Username*:</label></td>
			<td>
				<input class="big" type="text" name="name" value="<?=$google?>" />
				<input type="hidden" name="type" value="4" />
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
	</table>
</div>

<script type="text/javascript">
	var validator = new FormValidator('facebook-form', [
			{
				name: 'name',
				display: 'Facebook name',
				rules: 'required'
			},
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i = 0, errorLength = errors.length; i < errorLength; i++)
				{
					SELECTOR_ERRORS.append(errors[i].message + '<br />');
				}
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.css({ display: 'none' });
				SELECTOR_ERRORS.fadeIn(200);
			}
			else
			{
				SELECTOR_ERRORS.css({ display: 'none' });
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.fadeIn(200);
				
				var form_action = '<?=$SITE_URL?>pages/user/process/social_accounts_process.php';
				var from_data = $('#facebook-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
					}
					
					toBeDisplayed.empty();
					for (var i=0; i<json.messages.length; i++)
					{
						toBeDisplayed.append(json.messages[i]+'<br />');
					}
					toBeHidden.css({ display: 'none' });
					SELECTOR_PROCESS.css({ display: 'none' });
					toBeDisplayed.fadeIn(200);
				});
			}
			
			if (event && event.preventDefault) event.preventDefault();
			else if (event) event.returnValue = false;
		}
	);
	
	var validator2 = new FormValidator('twitter-form', [
			{
				name: 'name',
				display: 'Twitter username',
				rules: 'required'
			},
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i = 0, errorLength = errors.length; i < errorLength; i++)
				{
					SELECTOR_ERRORS.append(errors[i].message + '<br />');
				}
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.css({ display: 'none' });
				SELECTOR_ERRORS.fadeIn(200);
			}
			else
			{
				SELECTOR_ERRORS.css({ display: 'none' });
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.fadeIn(200);
				
				var form_action = '<?=$SITE_URL?>pages/user/process/social_accounts_process.php';
				var from_data = $('#twitter-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
					}
					
					toBeDisplayed.empty();
					for (var i=0; i<json.messages.length; i++)
					{
						toBeDisplayed.append(json.messages[i]+'<br />');
					}
					toBeHidden.css({ display: 'none' });
					SELECTOR_PROCESS.css({ display: 'none' });
					toBeDisplayed.fadeIn(200);
				});
			}
			
			if (event && event.preventDefault) event.preventDefault();
			else if (event) event.returnValue = false;
		}
	);
	
	var validator3 = new FormValidator('youtube-form', [
			{
				name: 'name',
				display: 'Youtube username',
				rules: 'required'
			},
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i = 0, errorLength = errors.length; i < errorLength; i++)
				{
					SELECTOR_ERRORS.append(errors[i].message + '<br />');
				}
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.css({ display: 'none' });
				SELECTOR_ERRORS.fadeIn(200);
			}
			else
			{
				SELECTOR_ERRORS.css({ display: 'none' });
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.fadeIn(200);
				
				var form_action = '<?=$SITE_URL?>pages/user/process/social_accounts_process.php';
				var from_data = $('#youtube-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
					}
					
					toBeDisplayed.empty();
					for (var i=0; i<json.messages.length; i++)
					{
						toBeDisplayed.append(json.messages[i]+'<br />');
					}
					toBeHidden.css({ display: 'none' });
					SELECTOR_PROCESS.css({ display: 'none' });
					toBeDisplayed.fadeIn(200);
				});
			}
			
			if (event && event.preventDefault) event.preventDefault();
			else if (event) event.returnValue = false;
		}
	);
	
	var validator4 = new FormValidator('digg-form', [
			{
				name: 'name',
				display: 'Digg name',
				rules: 'required'
			},
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i = 0, errorLength = errors.length; i < errorLength; i++)
				{
					SELECTOR_ERRORS.append(errors[i].message + '<br />');
				}
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.css({ display: 'none' });
				SELECTOR_ERRORS.fadeIn(200);
			}
			else
			{
				SELECTOR_ERRORS.css({ display: 'none' });
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.fadeIn(200);
				
				var form_action = '<?=$SITE_URL?>pages/user/process/social_accounts_process.php';
				var from_data = $('#digg-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
					}
					
					toBeDisplayed.empty();
					for (var i=0; i<json.messages.length; i++)
					{
						toBeDisplayed.append(json.messages[i]+'<br />');
					}
					toBeHidden.css({ display: 'none' });
					SELECTOR_PROCESS.css({ display: 'none' });
					toBeDisplayed.fadeIn(200);
				});
			}
			
			if (event && event.preventDefault) event.preventDefault();
			else if (event) event.returnValue = false;
		}
	);
	
	var validator5 = new FormValidator('google-form', [
			{
				name: 'name',
				display: 'Google username',
				rules: 'required'
			},
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i = 0, errorLength = errors.length; i < errorLength; i++)
				{
					SELECTOR_ERRORS.append(errors[i].message + '<br />');
				}
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.css({ display: 'none' });
				SELECTOR_ERRORS.fadeIn(200);
			}
			else
			{
				SELECTOR_ERRORS.css({ display: 'none' });
				SELECTOR_SUCCESS.css({ display: 'none' });
				SELECTOR_PROCESS.fadeIn(200);
				
				var form_action = '<?=$SITE_URL?>pages/user/process/social_accounts_process.php';
				var from_data = $('#google-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
					}
					
					toBeDisplayed.empty();
					for (var i=0; i<json.messages.length; i++)
					{
						toBeDisplayed.append(json.messages[i]+'<br />');
					}
					toBeHidden.css({ display: 'none' });
					SELECTOR_PROCESS.css({ display: 'none' });
					toBeDisplayed.fadeIn(200);
				});
			}
			
			if (event && event.preventDefault) event.preventDefault();
			else if (event) event.returnValue = false;
		}
	);
</script>
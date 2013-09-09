<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

?>

<h2 class="title">Membership</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<div class="table_separator">Advantages of being Premium member</div>
	<table class="table">
		<tr>
			<th width="33%">Feature</th>
			<th width="33%">Free</th>
			<th width="33%">Premium</th>
		</tr>
		<tr>
			<td>Ratio</td>
			<td><?=$NORMAL_RATES?> : 1</td>
			<td><?=$PREMIUM_RATES?> : 1</td>
		</tr>
		<tr>
			<td>Amount of links</td>
			<td>5</td>
			<td>Unlimited</td>
		</tr>
		<tr>
			<td>Hidden traffic</td>
			<td>Yes</td>
			<td>Yes</td>
		</tr>
		<tr>
			<td>Advertisements</td>
			<td>Yes</td>
			<td>No</td>
		</tr>
		<tr>
			<th colspan="3"></th>
		</tr>
	</table>
	<br /><br />
	<div class="table_separator">Requirements</div>
	You can upgrade to Premium for free. You just have to meet these requirements:
	<ul>
		<li>o Be a member of this site for at least 2 months</li>
		<li>o Have refered at least 5 members</li>
	</ul>
	<br /><br />
	<div class="table_separator">Premium membership request</div>
	<form id="upgrade-form">
		<table class="left">
			<tr>
				<td><label>Password*:</label></td>
				<td><input class="big" type="password" name="password" /></td>
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
				<br />
				<td colspan="2"><input type="submit" value="Request this upgrade" class="button green" /></td>
			</tr>
		</table>
	</form>
</div>

<script type="text/javascript">
	var validator = new FormValidator('upgrade-form', [
			{
				name: 'password',
				rules: 'required|min_length[6]'
			},
			{
				name: 'captcha',
				display: 'security code',
				rules: 'required|exact_length[6]|callback_check_captcha'
			}
		], 
		function(errors, event) {
			var SELECTOR_ERRORS = $('.error_box');
			var SELECTOR_SUCCESS = $('.success_box');
			var SELECTOR_PROCESS = $('.process_box');
			
			if (errors.length > 0)
			{
				SELECTOR_ERRORS.empty();
				for (var i=0, errorLength=errors.length; i<errorLength; i++)
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

				var form_action = '<?=$SITE_URL?>pages/user/process/upgrade_process.php';
				var from_data = $('#upgrade-form').serializeArray();
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
	validator.registerCallback('check_captcha', function(value) {
		return isValid('captcha', value);
	}).setMessage('check_captcha', 'This security code you entered does not match the code we sent, or it has expired.');
</script>
<?php

require('../config/config.php');
require('../config/mysql.php');
require('../config/authentification.php');

if ( isLoggedOn() )
{
	displayAlreadyLoggedOn();
	exit();
}

?>

<h2 class="title">Login</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<form id="login-form" action="#" method="POST">
		<table class="left">
			<tr>
				<td width="40%"><label>Username*:</label></td>
				<td width="320px"><input class="big" type="text" name="username" /></td>
			</tr>
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
				<td colspan="2"><center><i>Form fields with a `*` are required.</i></center></td>
			</tr>
		</table>
		<br /><input type="submit" value="Login" class="button green" /><br />
	</form>
	<input type="submit" value="Forgotten password" class="button black" onclick="loadPage('<?=$SITE_URL?>pages/forgotten_password.php', 'Forgotten password - <?=$SITE_TITLE?>', 'forgotten_password');" />
</div>

<script type="text/javascript">
	var validator = new FormValidator('login-form', [
			{
				name: 'username',
				rules: 'required|alpha_numeric'
			},
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

				var form_action = '<?=$SITE_URL?>pages/process/login_process.php';
				var from_data = $('#login-form').serializeArray();
				postRequest(form_action, from_data, function(json) {
					var toBeDisplayed = SELECTOR_ERRORS;
					var toBeHidden = SELECTOR_SUCCESS;
					
					if (json.type == 'success')
					{
						toBeDisplayed = SELECTOR_SUCCESS;
						toBeHidden = SELECTOR_ERRORS;
						
						loadMenu();
						setTimeout("loadPage('<?=$SITE_URL?>pages/user/dashboard.php', 'Dashboard - <?=$SITE_TITLE?>', 'dashboard');", 2000);
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
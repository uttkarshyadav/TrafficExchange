<?php
require('../config/config.php');
?>

<h2 class="title">Contact Us</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<form id="contact-form">
		<table class="left">
			<tr>
				<td><label>Your name*:</label></td>
				<td><input class="big" type="text" name="name" /></td>
			</tr>
			<tr>
				<td><label>Your e-mail*:</label></td>
				<td><input class="big" type="email" name="email" /></td>
			</tr>
			<tr>
				<td><label>Your message*:</label></td>
				<td><textarea class="big" name="message" rows="8" cols="76"></textarea></td>
			</tr>
			<tr>
				<td><label>Security code*:</label></td>
				<td><img src="<?=$SITE_URL?>assets/captcha/captcha.php" alt="Captcha" title="Captcha" class="big" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="big" type="text" name="captcha" /></td>
			</tr>
		</table>
		<br />
		<center><i>Form fields with a `*` are required.</i></center>
		<br />
		<input type="submit" value="Send message" class="button green" /><br />
	</form>
</div>

<script type="text/javascript">
	var validator = new FormValidator('contact-form', [
			{
				name: 'name', 
				display: 'Name',
				rules: 'required|alpha'
			},
			{
				name: 'email',
				display: 'E-mail',
				rules: 'required|valid_email'
			},
			{
				name: 'message',
				rules: 'required|min_length[10]'
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
				
				var form_action = '<?=$SITE_URL?>pages/process/contact_us_process.php';
				var from_data = $('#contact-form').serializeArray();
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
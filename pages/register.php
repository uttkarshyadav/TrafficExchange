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

<h2 class="title">Register</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<form id="register-form">
		<table class="left">
			<tr>
				<td width="40%"><label>Username*:</label></td>
				<td width="320px"><input class="big" type="text" name="username" /></td>
			</tr>
			<tr>
				<td><label>Email*:</label></td>
				<td><input class="big" type="email" name="email" /></td>
			</tr>
			<tr>
				<td><label>Password*:</label></td>
				<td><input class="big" type="password" name="password" /></td>
			</tr>
			<tr>
				<td><label>Repeat Password*:</label></td>
				<td><input class="big" type="password" name="password2" /></td>
			</tr>
			<tr>
				<td><label>Gender*:</label></td>
				<td>
					<select name="gender" class="big">
						<option value="0">-</option>
						<option value="1">Man</option>
						<option value="2">Woman</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Country*:</label></td>
				<td>
					<select name="country" class="big">
						<option value="0">-</option>
						<option value="AF">Afghanistan</option>
						<option value="AL">Albania</option>
						<option value="DZ">Algeria</option>
						<option value="AS">American Samoa</option>
						<option value="AD">Andorra</option>
						<option value="AO">Angola</option>
						<option value="AI">Anguilla</option>
						<option value="AG">Antigua & Barbuda</option>
						<option value="AN">Antilles, Netherlands</option>
						<option value="AR">Argentina</option>
						<option value="AM">Armenia</option>
						<option value="AW">Aruba</option>
						<option value="AU">Australia</option>
						<option value="AT">Austria</option>
						<option value="AZ">Azerbaijan</option>
						<option value="BS">Bahamas, The</option>
						<option value="BH">Bahrain</option>
						<option value="BD">Bangladesh</option>
						<option value="BB">Barbados</option>
						<option value="BY">Belarus</option>
						<option value="BE">Belgium</option>
						<option value="BZ">Belize</option>
						<option value="BJ">Benin</option>
						<option value="BM">Bermuda</option>
						<option value="BT">Bhutan</option>
						<option value="BO">Bolivia</option>
						<option value="BA">Bosnia and Herzegovina</option>
						<option value="BW">Botswana</option>
						<option value="BR">Brazil</option>
						<option value="VG">British Virgin Islands</option>
						<option value="BN">Brunei Darussalam</option>
						<option value="BG">Bulgaria</option>
						<option value="BF">Burkina Faso</option>
						<option value="BI">Burundi</option>
						<option value="KH">Cambodia</option>
						<option value="CM">Cameroon</option>
						<option value="CA">Canada</option>
						<option value="CV">Cape Verde</option>
						<option value="KY">Cayman Islands</option>
						<option value="CF">Central African Republic</option>
						<option value="TD">Chad</option>
						<option value="CL">Chile</option>
						<option value="CN">China</option>
						<option value="CO">Colombia</option>
						<option value="KM">Comoros</option>
						<option value="CG">Congo</option>
						<option value="CD">Congo</option>
						<option value="CK">Cook Islands</option>
						<option value="CR">Costa Rica</option>
						<option value="CI">Cote D'Ivoire</option>
						<option value="HR">Croatia</option>
						<option value="CU">Cuba</option>
						<option value="CY">Cyprus</option>
						<option value="CZ">Czech Republic</option>
						<option value="DK">Denmark</option>
						<option value="DJ">Djibouti</option>
						<option value="DM">Dominica</option>
						<option value="DO">Dominican Republic</option>
						<option value="TP">East Timor (Timor-Leste)</option>
						<option value="EC">Ecuador</option>
						<option value="EG">Egypt</option>
						<option value="SV">El Salvador</option>
						<option value="GQ">Equatorial Guinea</option>
						<option value="ER">Eritrea</option>
						<option value="EE">Estonia</option>
						<option value="ET">Ethiopia</option>
						<option value="FK">Falkland Islands</option>
						<option value="FO">Faroe Islands</option>
						<option value="FJ">Fiji</option>
						<option value="FI">Finland</option>
						<option value="FR">France</option>
						<option value="GF">French Guiana</option>
						<option value="PF">French Polynesia</option>
						<option value="GA">Gabon</option>
						<option value="GM">Gambia, the</option>
						<option value="GE">Georgia</option>
						<option value="DE">Germany</option>
						<option value="GH">Ghana</option>
						<option value="GI">Gibraltar</option>
						<option value="GR">Greece</option>
						<option value="GL">Greenland</option>
						<option value="GD">Grenada</option>
						<option value="GP">Guadeloupe</option>
						<option value="GU">Guam</option>
						<option value="GT">Guatemala</option>
						<option value="GG">Guernsey and Alderney</option>
						<option value="GF">Guiana, French</option>
						<option value="GN">Guinea</option>
						<option value="GP">Guinea, Equatorial</option>
						<option value="GW">Guinea-Bissau</option>
						<option value="GY">Guyana</option>
						<option value="HT">Haiti</option>
						<option value="HN">Honduras</option>
						<option value="HK">Hong Kong, (China)</option>
						<option value="HU">Hungary</option>
						<option value="IS">Iceland</option>
						<option value="IN">India</option>
						<option value="ID">Indonesia</option>
						<option value="IR">Iran, Islamic Republic of</option>
						<option value="IQ">Iraq</option>
						<option value="IE">Ireland</option>
						<option value="IL">Israel</option>
						<option value="IT">Italy</option>
						<option value="CI">Ivory Coast (Cote d'Ivoire)</option>
						<option value="JM">Jamaica</option>
						<option value="JP">Japan</option>
						<option value="JE">Jersey</option>
						<option value="JO">Jordan</option>
						<option value="KZ">Kazakhstan</option>
						<option value="KE">Kenya</option>
						<option value="KI">Kiribati</option>
						<option value="KR">Korea, (South) Rep. of</option>
						<option value="KW">Kuwait</option>
						<option value="KG">Kyrgyzstan</option>
						<option value="LA">Lao People's Dem. Rep.</option>
						<option value="LV">Latvia</option>
						<option value="LB">Lebanon</option>
						<option value="LS">Lesotho</option>
						<option value="LY">Libyan Arab Jamahiriya</option>
						<option value="LI">Liechtenstein</option>
						<option value="LT">Lithuania</option>
						<option value="LU">Luxembourg</option>
						<option value="MO">Macao, (China)</option>
						<option value="MK">Macedonia, TFYR</option>
						<option value="MG">Madagascar</option>
						<option value="MW">Malawi</option>
						<option value="MY">Malaysia</option>
						<option value="MV">Maldives</option>
						<option value="ML">Mali</option>
						<option value="MT">Malta</option>
						<option value="MQ">Martinique</option>
						<option value="MR">Mauritania</option>
						<option value="MU">Mauritius</option>
						<option value="MX">Mexico</option>
						<option value="FM">Micronesia</option>
						<option value="MD">Moldova, Republic of</option>
						<option value="MC">Monaco</option>
						<option value="MN">Mongolia</option>
						<option value="CS">Montenegro</option>
						<option value="MA">Morocco</option>
						<option value="MZ">Mozambique</option>
						<option value="MM">Myanmar (ex-Burma)</option>
						<option value="NA">Namibia</option>
						<option value="NP">Nepal</option>
						<option value="NL">Netherlands</option>
						<option value="NC">New Caledonia</option>
						<option value="NZ">New Zealand</option>
						<option value="NI">Nicaragua</option>
						<option value="NE">Niger</option>
						<option value="NG">Nigeria</option>
						<option value="MP">Northern Mariana Islands</option>
						<option value="NO">Norway</option>
						<option value="OM">Oman</option>
						<option value="PK">Pakistan</option>
						<option value="PS">Palestinian Territory</option>
						<option value="PA">Panama</option>
						<option value="PG">Papua New Guinea</option>
						<option value="PY">Paraguay</option>
						<option value="PE">Peru</option>
						<option value="PH">Philippines</option>
						<option value="PL">Poland</option>
						<option value="PT">Portugal</option>
						<option value="QA">Qatar</option>
						<option value="RE">Reunion</option>
						<option value="RO">Romania</option>
						<option value="RU">Russian Federation</option>
						<option value="RW">Rwanda</option>
						<option value="KN">Saint Kitts and Nevis</option>
						<option value="LC">Saint Lucia</option>
						<option value="WS">Samoa</option>
						<option value="SM">San Marino</option>
						<option value="ST">Sao Tome and Principe</option>
						<option value="SA">Saudi Arabia</option>
						<option value="SN">Senegal</option>
						<option value="RS">Serbia</option>
						<option value="SC">Seychelles</option>
						<option value="SG">Singapore</option>
						<option value="SK">Slovakia</option>
						<option value="SI">Slovenia</option>
						<option value="SB">Solomon Islands</option>
						<option value="SO">Somalia</option>
						<option value="ES">Spain</option>
						<option value="LK">Sri Lanka (ex-Ceilan)</option>
						<option value="VC">St. Vincent & the Grenad.</option>
						<option value="SD">Sudan</option>
						<option value="SR">Suriname</option>
						<option value="SZ">Swaziland</option>
						<option value="SE">Sweden</option>
						<option value="CH">Switzerland</option>
						<option value="SY">Syrian Arab Republic</option>
						<option value="TW">Taiwan</option>
						<option value="TJ">Tajikistan</option>
						<option value="TZ">Tanzania, United Rep. of</option>
						<option value="TH">Thailand</option>
						<option value="TG">Togo</option>
						<option value="TO">Tonga</option>
						<option value="TT">Trinidad & Tobago</option>
						<option value="TN">Tunisia</option>
						<option value="TR">Turkey</option>
						<option value="TM">Turkmenistan</option>
						<option value="UG">Uganda</option>
						<option value="UA">Ukraine</option>
						<option value="AE">United Arab Emirates</option>
						<option value="UK">United Kingdom</option>
						<option value="US">United States</option>
						<option value="UY">Uruguay</option>
						<option value="UZ">Uzbekistan</option>
						<option value="VU">Vanuatu</option>
						<option value="VE">Venezuela</option>
						<option value="VN">Viet Nam</option>
						<option value="VI">Virgin Islands, U.S.</option>
						<option value="YE">Yemen</option>
						<option value="ZM">Zambia</option>
						<option value="ZW">Zimbabwe</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Gift coupon</label></td>
				<td><input class="big" type="text" name="coupon" /></td>
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
				<td><label>Subscribe to Newsletter*:</label></td>
				<td><input type="radio" name="subscribe" value="1" checked="checked"/> Yes <input type="radio" name="subscribe" value="0"/> No</td>
			</tr>
		</table>
		<br />
		<center><i>Form fields with a `*` are required.</i></center>
		<br />
		<input type="submit" value="Create my account" class="button green" />
	</form>
	<p>
		<input type="submit" value="Cancel" class="button red" onclick="loadPage('<?=$SITE_URL?>pages/register.php', 'Register - <?=$SITE_TITLE?>', 'register');" />
	</p>
</div>

<script type="text/javascript">
	var validator = new FormValidator('register-form', [
			{
				name: 'username',
				rules: 'required|alpha_numeric|callback_check_username'
			},
			{
				name: 'email',
				display: 'E-mail',
				rules: 'required|valid_email|callback_check_email'
			},
			{
				name: 'password',
				rules: 'required|min_length[6]'
			},
			{
				name: 'password2',
				display: 'password confirmation',
				rules: 'required|matches[password]'
			},
			{
				name: 'gender',
				rules: 'required|greater_than[0]|less_than[3]'
			},
			{
				name: 'country',
				rules: 'required|alpha|exact_length[2]'
			},
			{
				name: 'coupon',
				rules: 'alpha_numeric|exact_length[10]|callback_check_coupon'
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
				
				var form_action = '<?=$SITE_URL?>pages/process/register_process.php';
				var from_data = $('#register-form').serializeArray();
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
	validator.registerCallback('check_username', function(value) {
		return isValid('username', value);
	}).setMessage('check_username', 'That username is already taken. Please choose another.');
	validator.registerCallback('check_email', function(value) {
		return isValid('email', value);
	}).setMessage('check_email', 'That email is already taken. Please choose another.');
	validator.registerCallback('check_coupon', function(value) {
		return isValid('coupon', value);
	}).setMessage('check_coupon', 'That coupon is invalid.');
	validator.registerCallback('check_captcha', function(value) {
		return isValid('captcha', value);
	}).setMessage('check_captcha', 'This security code you entered does not match the code we sent, or it has expired.');
</script>
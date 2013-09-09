<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Get the user infos
$user_id = intval(htmlspecialchars($_SESSION['userid']));
$query = $BDD->prepare('SELECT email, newsletter, gender, country FROM exchange_users WHERE id=:id LIMIT 1;');
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch();

$email = $result['email'];
$subscribe = $result['newsletter'];
$gender = $result['gender'];
$country = $result['country'];

?>

<h2 class="title">Your account</h2>

<div class="large center">
	<div class="success_box"></div>
	<div class="error_box"></div>
	<div class="process_box">Processing ... Please wait.</div>
	
	<table class="left">
		<form id="email-form">
		<tr>
			<td colspan="2" class="table_separator">Change E-mail:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Email*:</label></td>
			<td><input class="big" type="email" name="email" value="<?=$email?>" /></td>
		</tr>
		<tr>
			<td><label>Subscribe to Newsletter*:</label></td>
			<td><input type="radio" name="subscribe" value="1" <?php echo $subscribe == 1 ? 'checked="checked"' : ''; ?>/> Yes <input type="radio" name="subscribe" value="0" <?php echo $subscribe == 0 ? 'checked="checked"' : ''; ?>/> No</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Submit" class="button green" /></td>
		</tr>
		</form>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<tr>
			<td colspan="2" class="table_separator">Personnal info:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Gender:</label></td>
			<td>
				<select name="gender" class="big" disabled="disabled">
					<option value="0">-</option>
					<option value="1" <?php echo $gender == 1 ? 'selected="selected"' : ''; ?>>Man</option>
					<option value="2" <?php echo $gender == 2 ? 'selected="selected"' : ''; ?>>Woman</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label>Country:</label></td>
			<td>
				<select name="country" class="big" disabled="disabled">
					<option value="0">-</option>
					<option value="AF" <?php echo $country == 'AF' ? 'selected="selected"' : ''; ?>>Afghanistan</option>
					<option value="AL" <?php echo $country == 'AL' ? 'selected="selected"' : ''; ?>>Albania</option>
					<option value="DZ" <?php echo $country == 'DZ' ? 'selected="selected"' : ''; ?>>Algeria</option>
					<option value="AS" <?php echo $country == 'AS' ? 'selected="selected"' : ''; ?>>American Samoa</option>
					<option value="AD" <?php echo $country == 'AD' ? 'selected="selected"' : ''; ?>>Andorra</option>
					<option value="AO" <?php echo $country == 'AO' ? 'selected="selected"' : ''; ?>>Angola</option>
					<option value="AI" <?php echo $country == 'AI' ? 'selected="selected"' : ''; ?>>Anguilla</option>
					<option value="AG" <?php echo $country == 'AG' ? 'selected="selected"' : ''; ?>>Antigua & Barbuda</option>
					<option value="AN" <?php echo $country == 'AN' ? 'selected="selected"' : ''; ?>>Antilles, Netherlands</option>
					<option value="AR" <?php echo $country == 'AR' ? 'selected="selected"' : ''; ?>>Argentina</option>
					<option value="AM" <?php echo $country == 'AM' ? 'selected="selected"' : ''; ?>>Armenia</option>
					<option value="AW" <?php echo $country == 'AW' ? 'selected="selected"' : ''; ?>>Aruba</option>
					<option value="AU" <?php echo $country == 'AU' ? 'selected="selected"' : ''; ?>>Australia</option>
					<option value="AT" <?php echo $country == 'AT' ? 'selected="selected"' : ''; ?>>Austria</option>
					<option value="AZ" <?php echo $country == 'AZ' ? 'selected="selected"' : ''; ?>>Azerbaijan</option>
					<option value="BS" <?php echo $country == 'BS' ? 'selected="selected"' : ''; ?>>Bahamas, The</option>
					<option value="BH" <?php echo $country == 'BH' ? 'selected="selected"' : ''; ?>>Bahrain</option>
					<option value="BD" <?php echo $country == 'BD' ? 'selected="selected"' : ''; ?>>Bangladesh</option>
					<option value="BB" <?php echo $country == 'BB' ? 'selected="selected"' : ''; ?>>Barbados</option>
					<option value="BY" <?php echo $country == 'BY' ? 'selected="selected"' : ''; ?>>Belarus</option>
					<option value="BE" <?php echo $country == 'BE' ? 'selected="selected"' : ''; ?>>Belgium</option>
					<option value="BZ" <?php echo $country == 'BZ' ? 'selected="selected"' : ''; ?>>Belize</option>
					<option value="BJ" <?php echo $country == 'BJ' ? 'selected="selected"' : ''; ?>>Benin</option>
					<option value="BM" <?php echo $country == 'BM' ? 'selected="selected"' : ''; ?>>Bermuda</option>
					<option value="BT" <?php echo $country == 'BT' ? 'selected="selected"' : ''; ?>>Bhutan</option>
					<option value="BO" <?php echo $country == 'BO' ? 'selected="selected"' : ''; ?>>Bolivia</option>
					<option value="BA" <?php echo $country == 'BA' ? 'selected="selected"' : ''; ?>>Bosnia and Herzegovina</option>
					<option value="BW" <?php echo $country == 'BW' ? 'selected="selected"' : ''; ?>>Botswana</option>
					<option value="BR" <?php echo $country == 'BR' ? 'selected="selected"' : ''; ?>>Brazil</option>
					<option value="VG" <?php echo $country == 'VG' ? 'selected="selected"' : ''; ?>>British Virgin Islands</option>
					<option value="BN" <?php echo $country == 'BN' ? 'selected="selected"' : ''; ?>>Brunei Darussalam</option>
					<option value="BG" <?php echo $country == 'BG' ? 'selected="selected"' : ''; ?>>Bulgaria</option>
					<option value="BF" <?php echo $country == 'BF' ? 'selected="selected"' : ''; ?>>Burkina Faso</option>
					<option value="BI" <?php echo $country == 'BI' ? 'selected="selected"' : ''; ?>>Burundi</option>
					<option value="KH" <?php echo $country == 'KH' ? 'selected="selected"' : ''; ?>>Cambodia</option>
					<option value="CM" <?php echo $country == 'CM' ? 'selected="selected"' : ''; ?>>Cameroon</option>
					<option value="CA" <?php echo $country == 'CA' ? 'selected="selected"' : ''; ?>>Canada</option>
					<option value="CV" <?php echo $country == 'CV' ? 'selected="selected"' : ''; ?>>Cape Verde</option>
					<option value="KY" <?php echo $country == 'KY' ? 'selected="selected"' : ''; ?>>Cayman Islands</option>
					<option value="CF" <?php echo $country == 'CF' ? 'selected="selected"' : ''; ?>>Central African Republic</option>
					<option value="TD" <?php echo $country == 'TD' ? 'selected="selected"' : ''; ?>>Chad</option>
					<option value="CL" <?php echo $country == 'CL' ? 'selected="selected"' : ''; ?>>Chile</option>
					<option value="CN" <?php echo $country == 'CN' ? 'selected="selected"' : ''; ?>>China</option>
					<option value="CO" <?php echo $country == 'CO' ? 'selected="selected"' : ''; ?>>Colombia</option>
					<option value="KM" <?php echo $country == 'KM' ? 'selected="selected"' : ''; ?>>Comoros</option>
					<option value="CG" <?php echo $country == 'CG' ? 'selected="selected"' : ''; ?>>Congo</option>
					<option value="CD" <?php echo $country == 'CD' ? 'selected="selected"' : ''; ?>>Congo</option>
					<option value="CK" <?php echo $country == 'CK' ? 'selected="selected"' : ''; ?>>Cook Islands</option>
					<option value="CR" <?php echo $country == 'CR' ? 'selected="selected"' : ''; ?>>Costa Rica</option>
					<option value="CI" <?php echo $country == 'CI' ? 'selected="selected"' : ''; ?>>Cote D'Ivoire</option>
					<option value="HR" <?php echo $country == 'HR' ? 'selected="selected"' : ''; ?>>Croatia</option>
					<option value="CU" <?php echo $country == 'CU' ? 'selected="selected"' : ''; ?>>Cuba</option>
					<option value="CY" <?php echo $country == 'CY' ? 'selected="selected"' : ''; ?>>Cyprus</option>
					<option value="CZ" <?php echo $country == 'CZ' ? 'selected="selected"' : ''; ?>>Czech Republic</option>
					<option value="DK" <?php echo $country == 'DK' ? 'selected="selected"' : ''; ?>>Denmark</option>
					<option value="DJ" <?php echo $country == 'DJ' ? 'selected="selected"' : ''; ?>>Djibouti</option>
					<option value="DM" <?php echo $country == 'DM' ? 'selected="selected"' : ''; ?>>Dominica</option>
					<option value="DO" <?php echo $country == 'DO' ? 'selected="selected"' : ''; ?>>Dominican Republic</option>
					<option value="TP" <?php echo $country == 'TP' ? 'selected="selected"' : ''; ?>>East Timor (Timor-Leste)</option>
					<option value="EC" <?php echo $country == 'EC' ? 'selected="selected"' : ''; ?>>Ecuador</option>
					<option value="EG" <?php echo $country == 'EG' ? 'selected="selected"' : ''; ?>>Egypt</option>
					<option value="SV" <?php echo $country == 'SV' ? 'selected="selected"' : ''; ?>>El Salvador</option>
					<option value="GQ" <?php echo $country == 'GQ' ? 'selected="selected"' : ''; ?>>Equatorial Guinea</option>
					<option value="ER" <?php echo $country == 'ER' ? 'selected="selected"' : ''; ?>>Eritrea</option>
					<option value="EE" <?php echo $country == 'EE' ? 'selected="selected"' : ''; ?>>Estonia</option>
					<option value="ET" <?php echo $country == 'ET' ? 'selected="selected"' : ''; ?>>Ethiopia</option>
					<option value="FK" <?php echo $country == 'FK' ? 'selected="selected"' : ''; ?>>Falkland Islands</option>
					<option value="FO" <?php echo $country == 'FO' ? 'selected="selected"' : ''; ?>>Faroe Islands</option>
					<option value="FJ" <?php echo $country == 'FJ' ? 'selected="selected"' : ''; ?>>Fiji</option>
					<option value="FI" <?php echo $country == 'FI' ? 'selected="selected"' : ''; ?>>Finland</option>
					<option value="FR" <?php echo $country == 'FR' ? 'selected="selected"' : ''; ?>>France</option>
					<option value="GF" <?php echo $country == 'GF' ? 'selected="selected"' : ''; ?>>French Guiana</option>
					<option value="PF" <?php echo $country == 'PF' ? 'selected="selected"' : ''; ?>>French Polynesia</option>
					<option value="GA" <?php echo $country == 'GA' ? 'selected="selected"' : ''; ?>>Gabon</option>
					<option value="GM" <?php echo $country == 'GM' ? 'selected="selected"' : ''; ?>>Gambia, the</option>
					<option value="GE" <?php echo $country == 'GE' ? 'selected="selected"' : ''; ?>>Georgia</option>
					<option value="DE" <?php echo $country == 'DE' ? 'selected="selected"' : ''; ?>>Germany</option>
					<option value="GH" <?php echo $country == 'HG' ? 'selected="selected"' : ''; ?>>Ghana</option>
					<option value="GI" <?php echo $country == 'GI' ? 'selected="selected"' : ''; ?>>Gibraltar</option>
					<option value="GR" <?php echo $country == 'GR' ? 'selected="selected"' : ''; ?>>Greece</option>
					<option value="GL" <?php echo $country == 'GL' ? 'selected="selected"' : ''; ?>>Greenland</option>
					<option value="GD" <?php echo $country == 'GD' ? 'selected="selected"' : ''; ?>>Grenada</option>
					<option value="GP" <?php echo $country == 'GP' ? 'selected="selected"' : ''; ?>>Guadeloupe</option>
					<option value="GU" <?php echo $country == 'GU' ? 'selected="selected"' : ''; ?>>Guam</option>
					<option value="GT" <?php echo $country == 'GT' ? 'selected="selected"' : ''; ?>>Guatemala</option>
					<option value="GG" <?php echo $country == 'GG' ? 'selected="selected"' : ''; ?>>Guernsey and Alderney</option>
					<option value="GF" <?php echo $country == 'GF' ? 'selected="selected"' : ''; ?>>Guiana, French</option>
					<option value="GN" <?php echo $country == 'GN' ? 'selected="selected"' : ''; ?>>Guinea</option>
					<option value="GP" <?php echo $country == 'GP' ? 'selected="selected"' : ''; ?>>Guinea, Equatorial</option>
					<option value="GW" <?php echo $country == 'GW' ? 'selected="selected"' : ''; ?>>Guinea-Bissau</option>
					<option value="GY" <?php echo $country == 'GY' ? 'selected="selected"' : ''; ?>>Guyana</option>
					<option value="HT" <?php echo $country == 'HT' ? 'selected="selected"' : ''; ?>>Haiti</option>
					<option value="HN" <?php echo $country == 'HN' ? 'selected="selected"' : ''; ?>>Honduras</option>
					<option value="HK" <?php echo $country == 'HK' ? 'selected="selected"' : ''; ?>>Hong Kong, (China)</option>
					<option value="HU" <?php echo $country == 'HU' ? 'selected="selected"' : ''; ?>>Hungary</option>
					<option value="IS" <?php echo $country == 'IS' ? 'selected="selected"' : ''; ?>>Iceland</option>
					<option value="IN" <?php echo $country == 'IN' ? 'selected="selected"' : ''; ?>>India</option>
					<option value="ID" <?php echo $country == 'ID' ? 'selected="selected"' : ''; ?>>Indonesia</option>
					<option value="IR" <?php echo $country == 'IR' ? 'selected="selected"' : ''; ?>>Iran, Islamic Republic of</option>
					<option value="IQ" <?php echo $country == 'IQ' ? 'selected="selected"' : ''; ?>>Iraq</option>
					<option value="IE" <?php echo $country == 'IE' ? 'selected="selected"' : ''; ?>>Ireland</option>
					<option value="IL" <?php echo $country == 'IL' ? 'selected="selected"' : ''; ?>>Israel</option>
					<option value="IT" <?php echo $country == 'IT' ? 'selected="selected"' : ''; ?>>Italy</option>
					<option value="CI" <?php echo $country == 'CI' ? 'selected="selected"' : ''; ?>>Ivory Coast (Cote d'Ivoire)</option>
					<option value="JM" <?php echo $country == 'JM' ? 'selected="selected"' : ''; ?>>Jamaica</option>
					<option value="JP" <?php echo $country == 'JP' ? 'selected="selected"' : ''; ?>>Japan</option>
					<option value="JE" <?php echo $country == 'JE' ? 'selected="selected"' : ''; ?>>Jersey</option>
					<option value="JO" <?php echo $country == 'JO' ? 'selected="selected"' : ''; ?>>Jordan</option>
					<option value="KZ" <?php echo $country == 'KZ' ? 'selected="selected"' : ''; ?>>Kazakhstan</option>
					<option value="KE" <?php echo $country == 'KE' ? 'selected="selected"' : ''; ?>>Kenya</option>
					<option value="KI" <?php echo $country == 'KI' ? 'selected="selected"' : ''; ?>>Kiribati</option>
					<option value="KR" <?php echo $country == 'KR' ? 'selected="selected"' : ''; ?>>Korea, (South) Rep. of</option>
					<option value="KW" <?php echo $country == 'KW' ? 'selected="selected"' : ''; ?>>Kuwait</option>
					<option value="KG" <?php echo $country == 'KG' ? 'selected="selected"' : ''; ?>>Kyrgyzstan</option>
					<option value="LA" <?php echo $country == 'LA' ? 'selected="selected"' : ''; ?>>Lao People's Dem. Rep.</option>
					<option value="LV" <?php echo $country == 'LV' ? 'selected="selected"' : ''; ?>>Latvia</option>
					<option value="LB" <?php echo $country == 'LB' ? 'selected="selected"' : ''; ?>>Lebanon</option>
					<option value="LS" <?php echo $country == 'LS' ? 'selected="selected"' : ''; ?>>Lesotho</option>
					<option value="LY" <?php echo $country == 'LY' ? 'selected="selected"' : ''; ?>>Libyan Arab Jamahiriya</option>
					<option value="LI" <?php echo $country == 'LI' ? 'selected="selected"' : ''; ?>>Liechtenstein</option>
					<option value="LT" <?php echo $country == 'LT' ? 'selected="selected"' : ''; ?>>Lithuania</option>
					<option value="LU" <?php echo $country == 'LU' ? 'selected="selected"' : ''; ?>>Luxembourg</option>
					<option value="MO" <?php echo $country == 'MO' ? 'selected="selected"' : ''; ?>>Macao, (China)</option>
					<option value="MK" <?php echo $country == 'MK' ? 'selected="selected"' : ''; ?>>Macedonia, TFYR</option>
					<option value="MG" <?php echo $country == 'MG' ? 'selected="selected"' : ''; ?>>Madagascar</option>
					<option value="MW" <?php echo $country == 'MW' ? 'selected="selected"' : ''; ?>>Malawi</option>
					<option value="MY" <?php echo $country == 'MY' ? 'selected="selected"' : ''; ?>>Malaysia</option>
					<option value="MV" <?php echo $country == 'MV' ? 'selected="selected"' : ''; ?>>Maldives</option>
					<option value="ML" <?php echo $country == 'ML' ? 'selected="selected"' : ''; ?>>Mali</option>
					<option value="MT" <?php echo $country == 'MT' ? 'selected="selected"' : ''; ?>>Malta</option>
					<option value="MQ" <?php echo $country == 'MQ' ? 'selected="selected"' : ''; ?>>Martinique</option>
					<option value="MR" <?php echo $country == 'MR' ? 'selected="selected"' : ''; ?>>Mauritania</option>
					<option value="MU" <?php echo $country == 'MU' ? 'selected="selected"' : ''; ?>>Mauritius</option>
					<option value="MX" <?php echo $country == 'MX' ? 'selected="selected"' : ''; ?>>Mexico</option>
					<option value="FM" <?php echo $country == 'FM' ? 'selected="selected"' : ''; ?>>Micronesia</option>
					<option value="MD" <?php echo $country == 'MD' ? 'selected="selected"' : ''; ?>>Moldova, Republic of</option>
					<option value="MC" <?php echo $country == 'MC' ? 'selected="selected"' : ''; ?>>Monaco</option>
					<option value="MN" <?php echo $country == 'MN' ? 'selected="selected"' : ''; ?>>Mongolia</option>
					<option value="CS" <?php echo $country == 'CS' ? 'selected="selected"' : ''; ?>>Montenegro</option>
					<option value="MA" <?php echo $country == 'MA' ? 'selected="selected"' : ''; ?>>Morocco</option>
					<option value="MZ" <?php echo $country == 'MZ' ? 'selected="selected"' : ''; ?>>Mozambique</option>
					<option value="MM" <?php echo $country == 'MM' ? 'selected="selected"' : ''; ?>>Myanmar (ex-Burma)</option>
					<option value="NA" <?php echo $country == 'NA' ? 'selected="selected"' : ''; ?>>Namibia</option>
					<option value="NP" <?php echo $country == 'NP' ? 'selected="selected"' : ''; ?>>Nepal</option>
					<option value="NL" <?php echo $country == 'NL' ? 'selected="selected"' : ''; ?>>Netherlands</option>
					<option value="NC" <?php echo $country == 'NC' ? 'selected="selected"' : ''; ?>>New Caledonia</option>
					<option value="NZ" <?php echo $country == 'NZ' ? 'selected="selected"' : ''; ?>>New Zealand</option>
					<option value="NI" <?php echo $country == 'NI' ? 'selected="selected"' : ''; ?>>Nicaragua</option>
					<option value="NE" <?php echo $country == 'NE' ? 'selected="selected"' : ''; ?>>Niger</option>
					<option value="NG" <?php echo $country == 'NG' ? 'selected="selected"' : ''; ?>>Nigeria</option>
					<option value="MP" <?php echo $country == 'MP' ? 'selected="selected"' : ''; ?>>Northern Mariana Islands</option>
					<option value="NO" <?php echo $country == 'NO' ? 'selected="selected"' : ''; ?>>Norway</option>
					<option value="OM" <?php echo $country == 'OM' ? 'selected="selected"' : ''; ?>>Oman</option>
					<option value="PK" <?php echo $country == 'PK' ? 'selected="selected"' : ''; ?>>Pakistan</option>
					<option value="PS" <?php echo $country == 'PS' ? 'selected="selected"' : ''; ?>>Palestinian Territory</option>
					<option value="PA" <?php echo $country == 'PA' ? 'selected="selected"' : ''; ?>>Panama</option>
					<option value="PG" <?php echo $country == 'PG' ? 'selected="selected"' : ''; ?>>Papua New Guinea</option>
					<option value="PY" <?php echo $country == 'PY' ? 'selected="selected"' : ''; ?>>Paraguay</option>
					<option value="PE" <?php echo $country == 'PE' ? 'selected="selected"' : ''; ?>>Peru</option>
					<option value="PH" <?php echo $country == 'PH' ? 'selected="selected"' : ''; ?>>Philippines</option>
					<option value="PL" <?php echo $country == 'PL' ? 'selected="selected"' : ''; ?>>Poland</option>
					<option value="PT" <?php echo $country == 'PT' ? 'selected="selected"' : ''; ?>>Portugal</option>
					<option value="QA" <?php echo $country == 'QA' ? 'selected="selected"' : ''; ?>>Qatar</option>
					<option value="RE" <?php echo $country == 'RE' ? 'selected="selected"' : ''; ?>>Reunion</option>
					<option value="RO" <?php echo $country == 'RO' ? 'selected="selected"' : ''; ?>>Romania</option>
					<option value="RU" <?php echo $country == 'RU' ? 'selected="selected"' : ''; ?>>Russian Federation</option>
					<option value="RW" <?php echo $country == 'RW' ? 'selected="selected"' : ''; ?>>Rwanda</option>
					<option value="KN" <?php echo $country == 'KN' ? 'selected="selected"' : ''; ?>>Saint Kitts and Nevis</option>
					<option value="LC" <?php echo $country == 'LC' ? 'selected="selected"' : ''; ?>>Saint Lucia</option>
					<option value="WS" <?php echo $country == 'WS' ? 'selected="selected"' : ''; ?>>Samoa</option>
					<option value="SM" <?php echo $country == 'SM' ? 'selected="selected"' : ''; ?>>San Marino</option>
					<option value="ST" <?php echo $country == 'ST' ? 'selected="selected"' : ''; ?>>Sao Tome and Principe</option>
					<option value="SA" <?php echo $country == 'SA' ? 'selected="selected"' : ''; ?>>Saudi Arabia</option>
					<option value="SN" <?php echo $country == 'SN' ? 'selected="selected"' : ''; ?>>Senegal</option>
					<option value="RS" <?php echo $country == 'RS' ? 'selected="selected"' : ''; ?>>Serbia</option>
					<option value="SC" <?php echo $country == 'SC' ? 'selected="selected"' : ''; ?>>Seychelles</option>
					<option value="SG" <?php echo $country == 'SG' ? 'selected="selected"' : ''; ?>>Singapore</option>
					<option value="SK" <?php echo $country == 'SK' ? 'selected="selected"' : ''; ?>>Slovakia</option>
					<option value="SI" <?php echo $country == 'SI' ? 'selected="selected"' : ''; ?>>Slovenia</option>
					<option value="SB" <?php echo $country == 'SB' ? 'selected="selected"' : ''; ?>>Solomon Islands</option>
					<option value="SO" <?php echo $country == 'SO' ? 'selected="selected"' : ''; ?>>Somalia</option>
					<option value="ES" <?php echo $country == 'ES' ? 'selected="selected"' : ''; ?>>Spain</option>
					<option value="LK" <?php echo $country == 'LK' ? 'selected="selected"' : ''; ?>>Sri Lanka (ex-Ceilan)</option>
					<option value="VC" <?php echo $country == 'VC' ? 'selected="selected"' : ''; ?>>St. Vincent & the Grenad.</option>
					<option value="SD" <?php echo $country == 'SD' ? 'selected="selected"' : ''; ?>>Sudan</option>
					<option value="SR" <?php echo $country == 'SR' ? 'selected="selected"' : ''; ?>>Suriname</option>
					<option value="SZ" <?php echo $country == 'SZ' ? 'selected="selected"' : ''; ?>>Swaziland</option>
					<option value="SE" <?php echo $country == 'SE' ? 'selected="selected"' : ''; ?>>Sweden</option>
					<option value="CH" <?php echo $country == 'CH' ? 'selected="selected"' : ''; ?>>Switzerland</option>
					<option value="SY" <?php echo $country == 'SY' ? 'selected="selected"' : ''; ?>>Syrian Arab Republic</option>
					<option value="TW" <?php echo $country == 'TW' ? 'selected="selected"' : ''; ?>>Taiwan</option>
					<option value="TJ" <?php echo $country == 'TJ' ? 'selected="selected"' : ''; ?>>Tajikistan</option>
					<option value="TZ" <?php echo $country == 'TZ' ? 'selected="selected"' : ''; ?>>Tanzania, United Rep. of</option>
					<option value="TH" <?php echo $country == 'TH' ? 'selected="selected"' : ''; ?>>Thailand</option>
					<option value="TG" <?php echo $country == 'TG' ? 'selected="selected"' : ''; ?>>Togo</option>
					<option value="TO" <?php echo $country == 'TO' ? 'selected="selected"' : ''; ?>>Tonga</option>
					<option value="TT" <?php echo $country == 'TT' ? 'selected="selected"' : ''; ?>>Trinidad & Tobago</option>
					<option value="TN" <?php echo $country == 'TN' ? 'selected="selected"' : ''; ?>>Tunisia</option>
					<option value="TR" <?php echo $country == 'TR' ? 'selected="selected"' : ''; ?>>Turkey</option>
					<option value="TM" <?php echo $country == 'TM' ? 'selected="selected"' : ''; ?>>Turkmenistan</option>
					<option value="UG" <?php echo $country == 'UG' ? 'selected="selected"' : ''; ?>>Uganda</option>
					<option value="UA" <?php echo $country == 'UA' ? 'selected="selected"' : ''; ?>>Ukraine</option>
					<option value="AE" <?php echo $country == 'AE' ? 'selected="selected"' : ''; ?>>United Arab Emirates</option>
					<option value="UK" <?php echo $country == 'UK' ? 'selected="selected"' : ''; ?>>United Kingdom</option>
					<option value="US" <?php echo $country == 'US' ? 'selected="selected"' : ''; ?>>United States</option>
					<option value="UY" <?php echo $country == 'UY' ? 'selected="selected"' : ''; ?>>Uruguay</option>
					<option value="UZ" <?php echo $country == 'UZ' ? 'selected="selected"' : ''; ?>>Uzbekistan</option>
					<option value="VU" <?php echo $country == 'VU' ? 'selected="selected"' : ''; ?>>Vanuatu</option>
					<option value="VE" <?php echo $country == 'VE' ? 'selected="selected"' : ''; ?>>Venezuela</option>
					<option value="VN" <?php echo $country == 'VN' ? 'selected="selected"' : ''; ?>>Viet Nam</option>
					<option value="VI" <?php echo $country == 'VI' ? 'selected="selected"' : ''; ?>>Virgin Islands, U.S.</option>
					<option value="YE" <?php echo $country == 'YE' ? 'selected="selected"' : ''; ?>>Yemen</option>
					<option value="ZM" <?php echo $country == 'ZM' ? 'selected="selected"' : ''; ?>>Zambia</option>
					<option value="ZW" <?php echo $country == 'ZW' ? 'selected="selected"' : ''; ?>>Zimbabwe</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br /><br /></td>
		</tr>
		<form id="password-form">
		<tr>
			<td colspan="2" class="table_separator">Change password:</td>
		</tr>
		<tr>
			<td colspan="2"><br /></td>
		</tr>
		<tr>
			<td><label>Current password*:</label></td>
			<td><input class="big" type="password" name="password" /></td>
		</tr>
		<tr>
			<td><label>New password*:</label></td>
			<td><input class="big" type="password" name="new_password" /></td>
		</tr>
		<tr>
			<td><label>Repeat Password*:</label></td>
			<td><input class="big" type="password" name="new_password2" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Change password" class="button green" /></td>
		</tr>
		</form>
	</table>
</div>

<script type="text/javascript">
	var validator = new FormValidator('email-form', [
			{
				name: 'email',
				display: 'E-mail',
				rules: 'required|valid_email'
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
				
				var form_action = '<?=$SITE_URL?>pages/user/process/account_process.php';
				var from_data = $('#email-form').serializeArray();
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
	var validator2 = new FormValidator('password-form', [
			{
				name: 'password',
				rules: 'required|min_length[6]'
			},
			{
				name: 'new_password',
				display: 'new password',
				rules: 'required|min_length[6]'
			},
			{
				name: 'new_password2',
				display: 'password confirmation',
				rules: 'required|matches[new_password]'
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
				
				var form_action = '<?=$SITE_URL?>pages/user/process/account_process.php';
				var from_data = $('#password-form').serializeArray();
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
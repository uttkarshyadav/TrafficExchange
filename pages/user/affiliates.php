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

// Get referal data
$query = $BDD->prepare('SELECT username, last_login FROM exchange_users WHERE ref=:userid;');
$query->bindParam(':userid', $user_id, PDO::PARAM_INT);
$query->execute();

$total_refs = $query->rowCount();
$users = $query->fetchAll();
?>

<h2 class="title">Affiliates</h2>

<div class="large center">
	<div class="table_separator">Benefits</div>
	You will earn <?=$REFERAL_POINTS?> points for each user that signs ip to our site using your referal link.<br /><br />
	
	<div class="table_separator">Referral link</div>
	Share this link with your friends.<br /><br />
	<input class="big" style="width:600px;" type="text" value="<?=$SITE_URL?>?ref=<?=$user_id?>" size="40" onclick="this.select()" readonly="true"/><br /><br />
	
	<div class="table_separator">Banner</div>
	You can also use this banner to advertise your link :<br /><br />
	
	<img src="<?=$SITE_URL?>banner.png" alt="<?=$SITE_TITLE?>" border="0" width="600px" height="70" /><br /><br />
	
	<b>Html code</b><br />
	<textarea class="big" style="width:600px;height:60px;" onclick="this.select()" readonly="true"><a href="<?=$SITE_URL?>?ref=<?=$user_id?>" target="_blank"><img src="<?=$SITE_URL?>banner.png" alt="<?=$SITE_TITLE?>" border="0"/></a></textarea>
	<br /><br />
	<b>BB Code</b><br />
	<textarea class="big" style="width:600px;height:60px;" onclick="this.select()" readonly="true">[url=<?=$SITE_URL?>?ref=<?=$user_id?>][img]<?=$SITE_URL?>banner.png[/img][/url]</textarea>
	<br /><br />
	
	<div class="table_separator">Referred members</div>
	<?php
	if ($total_refs > 0)
	{
		echo 'You have already refered '.$total_refs.' users.<br /><br />';
		echo '<table class="table"><tr><th>Username</th><th>Last login</th></tr>';
		foreach($users as $user)
		{
			echo '<tr><td>'. $user['username'] .'</td><td>'. $user['last_login'] .'</td></tr>';
		}
		echo '<tr><th colspan="2"></th></tr></table>';
	}
	else
	{
		echo 'You haven\'t refered anybody yet.';
	}
	?>
</div>
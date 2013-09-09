<?php

session_start();

function isLoggedOn()
{
	global $BDD;
	
	// Check session
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		if (isset($_SESSION['password']))
		{
			$query = $BDD->prepare('SELECT id FROM exchange_users WHERE id=:id AND password=:password LIMIT 1;');
			$query->bindParam(':id', intval(htmlspecialchars($_SESSION['userid'])));
			$query->bindParam(':password', htmlspecialchars($_SESSION['password']));
			$query->execute();
			
			return ($query->rowCount() == 1);
		}
		else
		{
			return false;
		}
	}
	
	return false;
}

function setSession($userid, $password)
{
	$_SESSION['loggedin'] = true;
	$_SESSION['userid'] = intval($userid);
	$_SESSION['password'] = $password;
}

function displayNotAllowed()
{
	echo 'You are not allowed to access this page.<br /><a onClick="javascript:loadMenu();loadPage(\''.$SITE_URL.'pages/home.php\', \'Home - '.$SITE_TITLE.'\', \'home\');">Go back to home</a>';
}

function displayAlreadyLoggedOn()
{
	echo 'You are already logged on.<br /><a onClick="javascript:loadMenu();loadPage(\''.$SITE_URL.'pages/home.php\', \'Home - '.$SITE_TITLE.'\', \'home\');">Go back to home</a>';
}

function hashPwd($input)
{
	return $SHA1_PRE.sha1(sha1($input).$SHA1_SALT).$SHA1_POST;
}

function getIp()
{
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}

function printResponse($success, $lines)
{
	$type = $success ? 'success' : 'error';
	echo "{'type':'$type', 'messages':[";
	foreach ($lines as $line)
	{
		echo "'$line', ";
	}
	echo ']}';
}

?>
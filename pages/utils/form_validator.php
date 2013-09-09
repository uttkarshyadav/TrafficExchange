<?php
require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if (isset($_GET['type']) && isset($_GET['value']))
{
	$type = htmlspecialchars($_GET['type']);
	$value = htmlspecialchars($_GET['value']);
	
	if ($type == 'email')
	{
		if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $value))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'check_email')
	{
		$query = $BDD->prepare('SELECT id FROM exchange_users WHERE email=:email LIMIT 1;');
		$query->bindParam(':email', $value);
		$query->execute();
		if ($query->rowCount() == 0)
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'username')
	{
		if (strlen($value) < 4 || strlen($value) > 20)
		{
			echo 'INVALID';
			exit();
		}
	
		// Request
		$query = $BDD->prepare('SELECT id FROM exchange_users WHERE username=:username LIMIT 1;');
		$query->bindParam(':username', $value);
		$query->execute();
		if ($query->rowCount() == 0)
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'password')
	{
		if (strlen($value) < 6)
		{
			echo 'INVALID';
			exit();
		}
		else
		{
			echo 'VALID';
			exit();
		}
	}
	else if ($type == 'gender')
	{
		if (intval($value) == 1 || intval($value) == 2)
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'country')
	{
		if (preg_match('/^([A-Z]{2})$/', $value))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'captcha')
	{
		if (strlen($value) != 6)
		{
			echo 'INVALID';
			exit();
		}		
		else if (isset($_SESSION['captcha']) && (strtoupper($value) == $_SESSION['captcha']))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'coupon')
	{
		if (strlen($value) != 10)
		{
			echo 'INVALID';
			exit();
		}
		
		// Query
		$query = $BDD->prepare('SELECT COUNT(id) FROM exchange_coupons WHERE coupon=:coupon LIMIT 1;');
		$query->bindParam(':coupon', $value);
		$query->execute();
		if ($query->fetchColumn() == 1)
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'text')
	{
		if (strlen($value) > 0)
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'url')
	{
		if (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $value))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'int')
	{
		if (preg_match('/^([0-9]{1,10})$/', $value))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
	else if ($type == 'name')
	{
		if (preg_match("/^[a-zA-Z -]+$/", $value))
		{
			echo 'VALID';
			exit();
		}
		else
		{
			echo 'INVALID';
			exit();
		}
	}
}

exit();

?>
<?php

try
{
	$BDD = new PDO('mysql:host='.$DB_HOSTNAME.';dbname='.$DB_BASENAME.';charset=utf8', $DB_USERNAME, $DB_PASSWORD);
	$BDD->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

?>
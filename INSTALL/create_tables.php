<?php

require('../config/config.php');
require('../config/mysql.php');

$result = '';

//
// Table 'exchange_users'
//
//id username password email gender country newsletter activate points banned last_ips last_login
$TABLE_USERS = "";

$query = $BDD->prepare($TABLE_USERS);
if ($query->execute())
	$result .= 'Table `exchange_users` has been created<br />';
else
	$result .= 'Failed to create table `exchange_users`<br />';

//
// Table 'exchange_traffic'
//
// id userid url timer left total
$TABLE_TRAFFIC = "";

$query = $BDD->prepare($TABLE_TRAFFIC);
if ($query->execute())
	$result .= 'Table `exchange_traffic` has been created<br />';
else
	$result .= 'Failed to create table `exchange_traffic`<br />';

//
// Table 'exchange_facebook'
//
// id userid url type left total
$TABLE_FACEBOOK = "";

$query = $BDD->prepare($TABLE_FACEBOOK);
if ($query->execute())
	$result .= 'Table `exchange_facebook` has been created<br />';
else
	$result .= 'Failed to create table `exchange_facebook`<br />';

//
// Table 'exchange_twitter'
//
// id userid url left total
$TABLE_TWITTER = "";

$query = $BDD->prepare($TABLE_TWITTER);
if ($query->execute())
	$result .= 'Table `exchange_twitter` has been created<br />';
else
	$result .= 'Failed to create table `exchange_twitter`<br />';

//
// Table 'exchange_digg'
//
// id userid url left total
$TABLE_DIGG = "";

$query = $BDD->prepare($TABLE_DIGG);
if ($query->execute())
	$result .= 'Table `exchange_digg` has been created<br />';
else
	$result .= 'Failed to create table `exchange_digg`<br />';

//
// Table 'exchange_youtube'
//
// id userid url timer left total
$TABLE_YOUTUBE = "";

$query = $BDD->prepare($TABLE_YOUTUBE);
if ($query->execute())
	$result .= 'Table `exchange_youtube` has been created<br />';
else
	$result .= 'Failed to create table `exchange_youtube`<br />';
	
echo $result;

?>
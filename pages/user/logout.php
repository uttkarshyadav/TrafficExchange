<?
session_start();
$_SESSION = array();
session_destroy();

?>

<script type="text/javascript">
	loadMenu();
	loadPage('<?=$SITE_URL?>pages/home.php', 'Home - SphereTraffic.com', 'home');
</script>
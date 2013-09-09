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

?>

<script type="text/javascript">
resizeContainer();

$.get('<?=$SITE_URL?>pages/user/earn/traffic.php', function(data) {
	$("#tab-container").html(data);
	$("#tab-container").slideDown();
});

$('.tab').click(function() {
	$(".selected").removeClass("selected");
	$(this).addClass("selected");
	
	var pageToLoad = $(this).attr('id');
	$("#tab-container").html("<center><img src='<?=$SITE_URL?>assets/images/loader.gif' /><br />Loading ...</center>"); 
	$.get(pageToLoad, function(data) {
		$("#tab-container").html(data);
		$("#tab-container").slideDown();
		// Load JS
		var scripts = document.getElementById('tab-container').getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++) eval(scripts[i].innerHTML);
	});    
});
</script>

<h2 class="title">Earn points</h2>

<div class="large center">
	<div class="tabs">
		<div class="tab selected" id='<?=$SITE_URL?>pages/user/earn/traffic.php'>Traffic exchange</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/facebook.php'>Facebook</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/twitter.php'>Twitter</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/youtube.php'>Youtube</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/googleplus.php'>Google +1</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/digg.php'>Digg</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/earn/survey.php'>Survey</div>
	</div>
	
	<div id="tab-container">
		<center><img src='assets/images/loader.gif' /><br />Loading ...</center>
	</div>
</div>
<?php

require('../../config/config.php');
require('../../config/mysql.php');
require('../../config/authentification.php');

if ( !isLoggedOn() )
{
	displayNotAllowed();
	exit();
}

// Content goes here
?>

<script type="text/javascript">
resizeContainer();

$.get('<?=$SITE_URL?>pages/user/links/traffic.php', function(data) {
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
	});    
});
</script>

<h2 class="title">Your links</h2>

<div class="large center">
	<div class="tabs">
		<div class="tab selected" id='<?=$SITE_URL?>pages/user/links/traffic.php'>Traffic exchange</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/links/facebook.php'>Facebook</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/links/twitter.php'>Twitter</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/links/youtube.php'>Youtube</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/links/googleplus.php'>Google +1</div>
		<div class="tab" id='<?=$SITE_URL?>pages/user/links/digg.php'>Digg</div>
	</div>
	
	<div id="tab-container">
		<center><img src='assets/images/loader.gif' /><br />Loading ...</center>
	</div>
</div>
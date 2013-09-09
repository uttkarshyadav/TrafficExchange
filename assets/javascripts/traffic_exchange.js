var SITE_URL = 'http://herorat.net/exchange/';
var windowHandler;

// Timer
var timer_value = 16;
var default_timer_value = 16;

var isYoutube = false;
var hasToStop = false;

// Url
var current_url;

// Timeout instance
var timeout;

// History
var arrayHistory = new Array('', '', '', '', '');

function player_start(is_youtube)
{
	// Set type
	isYoutube = is_youtube;

	// Kill previous running process
	player_stop();
	
	// Get the default timer value
	if (isYoutube)
	{
		timer_value = 31;
		default_timer_value = 31;
	}
	else
	{
		timer_value = 16;
		default_timer_value = 16;
	}
	
	hasToStop = false;
	
	// Get first url to reach
	if (isYoutube) current_url = youtube_getUrl();
	else current_url = traffic_getUrl();

	// Reset history
	for (var i=0; i<5; i++)
	{
		arrayHistory[i] = '';
		$('#player_history_h'+i).fadeOut(200);
		$('#player_history'+i).empty();
	}
	
	// Add to history
	if (current_url.indexOf("noentry.php") !== -1) arrayHistory[0] = 'No entry available.';
	else arrayHistory[0] = 'http://' + current_url + '';
	$('#player_history0').append(arrayHistory[0]);
	$('#player_history_h0').fadeIn(200);
	
	// Open url in new tab/window
	windowHandler = window.open(SITE_URL +'noreferrer.php?url=' + current_url, 'windowTraffic');
	
	// Start the timer countdown
	timeout = setTimeout('player_onTick();', 1000);
	
	// Reset the timer
	$('.timer').val(default_timer_value - 1).trigger('change');
}

function player_stop()
{
	// Delete existing timeout
	clearTimeout(timeout);

	// Force the tab/window to close
	if (windowHandler)
	{
		windowHandler.close();
		windowHandler = undefined;
		hasToStop = true;
	}
	
	// Clear error message
	$('.error_box').empty();
	$('.error_box').css({ display: 'none' });
}

function player_onTick()
{
	// Check if the user has asked to stop the player or the page has changed
	if ((hasToStop) || (!$('#player_history_h0').length))
	{
		return;
	}
	
	// Check if the window is still opened
	if (windowHandler && windowHandler.closed)
	{
		showMessage(1, 'Traffic Exchange Window is frozen or closed. Please click on the button to re-start.');
		return;
	}
	
	// Decrease the timer and display it
	timer_value = timer_value - 1;
	$('.timer').val(timer_value).trigger('change');
	
	// Check the timer value
	if (timer_value == 0) player_onTimerEnds();
	else timeout = setTimeout('player_onTick();', 1000);
}

function player_onTimerEnds()
{	
	// Try to validate the visit
	if (isYoutube)
	{
		if (youtube_validateUrl()) showMessage(0, 'Your points have been updated.');
		else showMessage(1, 'The timer is invalid or there is no more video available.');
	}
	else
	{
		if (traffic_validateUrl()) showMessage(0, 'Your points have been updated.');
		else showMessage(1, 'The timer is invalid or there is no more link available.');
	}

	// The user has stopped the player
	if (hasToStop) return;
	
	// Reset timer value
	timer_value = default_timer_value;
	
	// Get the next url to reach
	current_url = traffic_getUrl();
	
	// Move history
	arrayHistory[4] = arrayHistory[3];
	arrayHistory[3] = arrayHistory[2];
	arrayHistory[2] = arrayHistory[1];
	arrayHistory[1] = arrayHistory[0];
	
	// Add to history
	if (current_url.indexOf("noentry.php") !== -1) arrayHistory[0] = 'No entry available.<br />';
	else arrayHistory[0] = 'http://' + current_url + '<br />';
	
	// Show history
	for (var i=0; i<5; i++)
	{
		if (arrayHistory[i] != '')
		{
			$('#player_history'+i).empty();
			$('#player_history'+i).append(arrayHistory[i]);
			$('#player_history_h'+i).fadeIn(200);
		}
		else
		{
			$('#player_history_h'+i).fadeOut(200);
		}
	}
	
	// Reset timer
	$('.timer').val(default_timer_value - 1).trigger('change');
	
	// Go to the next tick
	if (windowHandler && !windowHandler.closed)
	{
		windowHandler.location.href = SITE_URL +'noreferrer.php?url=' + current_url;
		timeout = setTimeout('player_onTick();', 1000);
	}
	else
	{
		showMessage(1, 'The window has been closed.<br />Please restart the player to continue surfing.');
	}
}

/*****************************************************/
/* Traffic */
/*****************************************************/

function traffic_getUrl()
{
	var response = $.ajax({
			type: 'GET',
			url: 'pages/user/utils/getTrafficUrl.php',
			async: false
	}).responseText;

	return response;
}

function traffic_validateUrl()
{
	var response = $.ajax({
			type: 'GET',
			url: 'pages/user/utils/validateTrafficUrl.php',
			async: false
	}).responseText;

	return (response == 'VALID') ? true : false;
}

/*****************************************************/
/* Youtube */
/*****************************************************/

function youtube_getUrl()
{
	var response = $.ajax({
			type: 'GET',
			url: 'pages/user/utils/getYoutubeUrl.php',
			async: false
	}).responseText;

	return response;
}

function youtube_validateUrl()
{
	var response = $.ajax({
			type: 'GET',
			url: 'pages/user/utils/validateYoutubeUrl.php',
			async: false
	}).responseText;

	return (response == 'VALID') ? true : false;
}

/*****************************************************/
/* Errors / Success */
/*****************************************************/

function showMessage(type, msg)
{
	var SELECTOR_ERRORS = $('.error_box');
	var SELECTOR_SUCCESS = $('.success_box');
	
	if (type == 0)
	{
		SELECTOR_SUCCESS.empty();
		SELECTOR_SUCCESS.append(msg);
		SELECTOR_ERRORS.css({ display: 'none' });
		SELECTOR_SUCCESS.fadeIn(200);
	}
	else if (type == 1)
	{
		SELECTOR_ERRORS.empty();
		SELECTOR_ERRORS.append(msg);
		SELECTOR_SUCCESS.css({ display: 'none' });
		SELECTOR_ERRORS.fadeIn(200);
	}
}
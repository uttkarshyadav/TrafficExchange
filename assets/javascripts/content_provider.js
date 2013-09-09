var isPremium = false;

// Resize function
function resizeContainer()
{
	var footerHeight = $("#footer").height();
	var containerHeight = $("#page").height();

	if (isPremium)
	{
		$("#pageContents").height(containerHeight - (footerHeight + 60));
	}
	else
	{
		var alertHeight = $("#alert").height();
		$("#pageContents").height(containerHeight - (alertHeight + footerHeight + 90));
	}
	
	var tabs = document.getElementById('tab-container');
	if (tabs)
	{
		$("#tab-container").height( $("#pageContents").height() - 100 );
	}
}

$(window).resize(function() {
	resizeContainer();
});

// Ad rotation
function setAdsense()
{
	var div = document.getElementById('alert');
	if (div)
	{
		var inner = div.innerHTML;
		div.innerHTML = inner;
		setTimeout("setAdsense();", 60000);
	}
}

//Premium only
function removeAds()
{
	isPremium = true;
	$('#alert').hide();
	resizeContainer();
	
}

// Tabs
function expandTab(tabId)
{
	var tabs = new Array('#part_one', '#part_two', '#part_three', '#part_four', '#part_five');
	for (var i=0; i<tabs.length; i++)
	{
		if (tabId == tabs[i]) continue;
		if ($(tabs[i]).is(":visible")) $(tabs[i]).slideToggle('slow');
	}
	
	$(tabId).slideToggle('fast');
}

// First launch
function firstLaunch()
{
	var menuAck = false;
	var containerAck = false;
	
	// Load menu
	$.get('pages/menu.php', function(data) {
		document.getElementById('sidebar').innerHTML = data;
		// Load JS
		var scripts = document.getElementById('sidebar').getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++) eval(scripts[i].innerHTML);
		menuAck = true;
		if (containerAck) $('#loading').hide();
	});
	
	// Load content
	$.get('pages/home.php', function(data) {
		document.getElementById('pageContents').innerHTML = data;
		// Load JS
		var scripts = document.getElementById('pageContents').getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++) eval(scripts[i].innerHTML);
		containerAck = true;
		if (menuAck) $('#loading').hide();
	});
	
	resizeContainer();
	setTimeout("setAdsense();", 60000);
	if (containerAck && menuAck) $('#loading').hide();
}

// Load a page into the container
function loadPage(page, title, menu_item)
{
	document.getElementById('pageContents').innerHTML = "<div id='loader'><img src='assets/images/loader.gif' /></div>";
	document.title = title;
	var actives = document.getElementsByClassName('active');
	if (actives.length > 0) actives[0].className = '';
	var active = document.getElementById(menu_item);
	if (active) active.className = "active";
	$.get(page, function(data) {
		$('#pageContents').fadeOut(0);
		document.getElementById('pageContents').innerHTML = data;
		$('#pageContents').fadeIn(400);
		$('#loading').hide();
		// Load JS
		var scripts = document.getElementById('pageContents').getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++) eval(scripts[i].innerHTML);
	});
}

// Load the appropriate menu
function loadMenu()
{
	$.get('pages/menu.php', function(data) {
		$('#sidebar').fadeOut(0);
		document.getElementById('sidebar').innerHTML = data;
		$('#sidebar').fadeIn(400);
		// Load JS
		var scripts = document.getElementById('sidebar').getElementsByTagName('script');
		for (var i=0; i<scripts.length; i++) eval(scripts[i].innerHTML);
	});
}

// Refresh the user's stats
function refreshUserStats()
{
	$.get('pages/user/utils/stats.php', function(data) {
		var div = document.getElementById('points');
		if (div)
		{
			div.innerHTML = data;
			setTimeout("refreshUserStats()", 10000);
		}
	});
}

// Send a post request
function postRequest(urlToReach, dataToSend, callback)
{
	$.post(urlToReach, dataToSend, function(msg) {
			var json = eval('(' + msg + ')');
			callback(json);
	});
}

// Form validator
function isValid(type, value)
{
	if(value == '') return;
	
	var response = $.ajax({
			type: 'GET',
			url: 'pages/utils/form_validator.php',
			data: 'type='+type+'&value='+value,
			async: false
		}).responseText;

	return (response == 'VALID') ? true : false;
}
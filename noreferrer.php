<?php

require('./config/config.php');

if (isset($_GET['url'])) $url = 'http://'.htmlspecialchars($_GET['url']);
else $url = $SITE_URL;

function getArgs()
{
	global $url;
	$first_done = false;
	foreach ($_GET as $key => $value)
	{
		if (!$first_done)
		{
			$first_done = true;
			if ( strpos($url, '?') && strlen($url)>strpos($url, '?')+1 )
			{
				$args = substr($url, strpos($url, '?') + 1);
				$arr = explode('=', $args);
				if (sizeof($arr) == 2)
				{
					echo '<input type="hidden" name="'. htmlspecialchars($arr[0]) .'" value="'. htmlspecialchars($arr[1]) .'" />';
				}
			}
			continue;
		}
	echo '<input type="hidden" name="'. htmlspecialchars($key) .'" value="'. htmlspecialchars($value) .'" />';
	}
}

?>

<html>
	<head>
		<title>Loading</title>
	</head>
	<body>
		<script type="text/javascript">
			function go()
			{
				window.frames[0].document.body.innerHTML = '<form target="_parent" action="<?=$url?>" method="GET"><?=getArgs()?></form>';
				window.frames[0].document.forms[0].submit();
			}
		</script>

		<iframe onload="window.setTimeout('go()', 99)" src="about:blank" style="visibility:hidden"></iframe>
	</body>
</html>
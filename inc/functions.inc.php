<?php

function escape($text) {
     return htmlspecialchars($text);
}

function browserhack($browser, $printthis) {
	
	//Detect Browser (order is important!)
	$a = (isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

	if (stristr($a, "opera")) {
		$b = 'opera';
	}
	elseif (stristr($a, "msie")) {
		$b = 'ie';
	}
	elseif (stristr($a, "chrome")) {
		$b = 'chrome';
	}
	elseif (stristr($a, "safari")) {
		$b = 'safari';
	}
	elseif (stristr($a, "firefox")) {
		$b = 'firefox';
	}	
	else {
		$b = '';
	}		
	
	//Print specific text
	if ($b == $browser) {
		return $printthis;
	}
}

?>
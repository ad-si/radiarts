<?php

function error_handler($errno, $errstr, $errfile, $errline) {
    // Temporäre Debugging-Ausgabe
    echo '<pre>';
    echo new ErrorException($errstr, 0, $errno, $errfile, $errline);
    echo '</pre>';
    //Produktiv-Funktion
    mail('adriansieber@web.de', 'Fehler!', new ErrorException($errstr, 0, $errno, $errfile, $errline));
    // TODO: Zu Fehlerseite weiterleiten
    if ($errno != E_WARNING && $errno != E_NOTICE)
        exit;
}

set_error_handler('error_handler');

include ('mysql.inc.php');
include ('functions.inc.php');

//Random table row
$sq = "SELECT * FROM radiartworks ORDER BY RAND() LIMIT 1;";
$reso = mysql_query($sq);
$random = mysql_fetch_assoc($reso);


//test if you have already voted for a radiartwork
if(isset($_GET["id_img"]))
{ 
	if(!isset($_COOKIE[$_GET["id_img"]])){
		if(isset($_POST["plus"]))	
			{
				$update = 'UPDATE radiartworks SET up = up+1 WHERE id = '.$_GET["id_img"].';';
				mysql_query($update);				
				setcookie($_GET["id_img"], "1", time() + 86400);
				$rating = '1';
			}
			
		if(isset($_POST["minus"]))	
			{		
				$update = 'UPDATE radiartworks SET down = down+1 WHERE id = '.$_GET["id_img"].';';
				mysql_query($update);			
				setcookie($_GET["id_img"], "1", time() + 86400);
				$rating = '1';
			}	
	}
	else {
		$rating = '0';
	}
}


$header = '
<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="You can use radiobuttons for much more than just a formular!" />
	<meta name="keywords" content="radiarts, radiobutton, radiobuttons, radiart, radiobutton art, radiartwork, radiartworks" />
	<meta name="author" content="Adrian Sieber" />
	
		<title>Radiarts</title>
	
	<script type="text/javascript" src="js/functions.js" ></script>
	 
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link href="css/radiart.css" rel="stylesheet" type="text/css" />
	<link href="css/slider.css" rel="stylesheet" type="text/css" />
	
	<style type="text/css">'.
	browserhack('opera', 'div.size input[type="radio"] {margin: -5px -1px 0px 0px;}').
	browserhack('msie', 'div.size input[type="radio"] {margin: -5px -1px 0px 0px;}').
	browserhack('chrome', 'div.size input[type="radio"] {margin: -5px 0px 0px 0px;}').
	browserhack('safari', 'div.size input[type="radio"] {margin: -5px 0px 0px 0px;}').
	browserhack('firefox', 'div.size input[type="radio"] {margin: -5px -1px 0px 0px;}').
	'</style>
	
</head>
<body>';

$slider = '
<div id="opener" onclick="show_slider();">	
	<svg width="20" height="90" style="cursor: pointer;">
			<text style="font: 500 18px/18px Arial;"
				fill="white" x="0" y="0" transform="rotate(90, -10, 15)" >
				menu
			</text>	
	</svg>
</div>
	
<div id="content" onclick="hide_slider();" >
	<a href="index.php"><img src="img/home.png"  title="Home" alt="Home" />
	<br />Home</a>
	<br />
	<a href="paint.php"><img src="img/arrow.png"  title="Create" alt="Create your own radiartwork" />
	<br />Create your own radiartwork</a>
	<br />
	<a href="database.php"><img src="img/glass.png"  title="Browse through all of the radiartworks" alt="Browse through all of the radiartworks" />
	<br />Browse through all of the radiartworks</a>
	<br />

	<br />
</div>
<div id="wrap_content" onclick="hide_slider()">
';


$footer = '
<div id="footer">
	an <a href="http://www.adriansieber.com/" >Adrian Sieber</a> production	
</div>
</div>';

echo $header;
echo $slider;
?>
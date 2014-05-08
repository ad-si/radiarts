<html>
<head>
<title>radiarts</title>

<link rel="icon" type="image/png" href="img/favicon.png"/>
<link href="css/radiart.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="scripts/functions.js"></script>

</head>
<body>
<?php

srand((double)microtime()*1000000);

for($y=0; $y<1000; $y++)
{
	for($x=0; $x<80; $x++)
	{
	    $write = rand(0,1);
		
		if ($write == 1 ) { $check = "checked='checked'";} else {$check = "";}
		
	    $number = ($y * 10) + $x;
		
		$radiartwork[$number] = "<input ".$check." type='radio' name='y".$y."x".$x."'/>";
		
		echo $radiartwork[$number];
	}
	echo "<br />";
}

?>
</body>
</html>
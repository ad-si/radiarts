<?php
include ('inc/common.inc.php');

$sql_home_logo = "select * from radiartworks where id = 1"; //radiartwork mit entsprechender id auswählen

$res = mysql_query($sql_home_logo); //Datenbankabfrage

while ($data = mysql_fetch_assoc($res)) //Daten Ausgeben
{
	$erg = unserialize ($data["array"]); //Array unserialisieren
	
	echo '<div class="size" ';
	echo 'style="width: '. round($data["x"] * 12) .'px;">'; //Breite des umfassenden divs

			for($i=0; $i<=($data["y"]-1); $i++) //Mit Schleife Array ausgeben
			{
				for($j=1; $j<=$data["x"]; $j++)
				{
					$value = ($i * $data["x"]) + $j;
					
					if (isset($erg[$value]))
						{				
							echo '<input type="radio" name="a'.$value.'" checked="checked" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
						}
					else
						{				
							echo '<input type="radio" name="a'.$value.'" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
						}
				}
			}
	echo '</div> ';
}

	

$sql_home_content = "SELECT * FROM radiartworks where x = 90 and id != 1 ORDER BY RAND() LIMIT 1"; //radiartwork mit entsprechender id auswählen
$res = mysql_query($sql_home_content); //Datenbankabfrage

while ($data = mysql_fetch_assoc($res)) //Daten Ausgeben
{
	$erg = unserialize ($data["array"]); //Array unserialisieren
	
	echo '<div class="size" ';
	echo 'style="width: '. round($data["x"] * 12) .'px;">'; //Breite des umfassenden divs

			for($i=0; $i<=($data["y"]-1); $i++) //Mit Schleife Array ausgeben
			{
				for($j=1; $j<=$data["x"]; $j++)
				{
					$value = ($i * $data["x"]) + $j;
					
					if (isset($erg[$value]))
						{				
							echo '<input type="radio" name="'.$value.'" checked="checked" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
						}
					else
						{				
							echo '<input type="radio" name="'.$value.'" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
						}
				}
			}
	
	echo '</div> ';
}

echo $footer;
?>

</body>
</html>
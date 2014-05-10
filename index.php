<?php
include('inc/common.inc.php');

//radiartwork mit entsprechender id auswählen
$sql_home_logo = "select * from radiartworks where id = 1";

//Datenbankabfrage
$res = mysql_query($sql_home_logo);

//Daten Ausgeben
while ($data = mysql_fetch_assoc($res)) {

    //Array unserialisieren
    $erg = unserialize($data["array"]);

    echo '<div class="size" ';
    //Breite des umfassenden divs
    echo 'style="width: ' . round($data["x"] * 12) . 'px;">';

    //Mit Schleife multidimensionales Array ausgeben
    for ($i = 0; $i <= ($data["y"] - 1); $i++) {
        for ($j = 1; $j <= $data["x"]; $j++) {

            $value = ($i * $data["x"]) + $j;

            if (isset($erg[$value])) {
                echo '<input type="radio" name="a' . $value .
                    '" checked="checked" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
            } else {
                echo '<input type="radio" name="a' . $value .
                    '" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
            }
        }
    }
    echo '</div> ';
}

//radiartwork mit entsprechender id auswählen
$sql_home_content = "SELECT * FROM radiartworks where x = 90 and id != 1 ORDER BY RAND() LIMIT 1";

//Datenbankabfrage
$res = mysql_query($sql_home_content);

//Daten Ausgeben
while ($data = mysql_fetch_assoc($res)) {

    //Array unserialisieren
    $erg = unserialize($data["array"]);

    echo '<div class="size" ';
    //Breite des umfassenden divs
    echo 'style="width: ' . round($data["x"] * 12) . 'px;">';

    //Mit Schleife Array ausgeben
    for ($i = 0; $i <= ($data["y"] - 1); $i++) {
        for ($j = 1; $j <= $data["x"]; $j++) {

            $value = ($i * $data["x"]) + $j;

            if (isset($erg[$value])) {
                echo '<input type="radio" name="' . $value .
                    '" checked="checked" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
            } else {
                echo '<input type="radio" name="' . $value .
                    '" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
            }
        }
    }

    echo '</div> ';
}

echo $footer;
?>

</body>
</html>

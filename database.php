<?php
include('inc/common.inc.php');


echo '<div id="database">';

$img = array();

if (isset($_POST["send"])) {

    //Die Werte des Formulars einem Array zuweisen
    for ($i = 0; $i <= ($_POST["ysize"] - 1); $i++) {
        for ($j = 1; $j <= $_POST["xsize"]; $j++) {

            $value = ($i * $_POST["xsize"]) + $j;

            //wenn $_POST[$value] existiert ist es angeklickt --> wert = 1
            if (isset($_POST[$value])) $img[$value] = 1;
        }
    }

    //Zum Speichern serialisieren
    $array_save = serialize($img);

    $sql_insert = "insert radiartworks (id, user, title, array, x, y, time, up, down) values " .
        "(NULL, '" . $_POST["user"] . "', '" . $_POST["title"] . "', '" . $array_save . "', '" . $_POST["xsize"] .
        "', '" . $_POST["ysize"] . "', NOW(), 0, 0);";

    //test if entry already exists
    $sql = "SELECT * FROM radiartworks WHERE user = '" . $_POST['user'] .
        "' and title = '" . $_POST['title'] . "' and array = '" . $array_save . "';";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);

    if ($num > 0)
        echo '<p style="color: red;">Your radiartwork already exists!</p>';

    else {

        $sqlo = mysql_query($sql_insert); //Speichern
        $num = mysql_affected_rows(); //überprüfung ob Speichern erfolgreich war

        if ($num > 0) {
            echo "<p><font color='#00aa00'>";
            echo "Your radiartwork was saved in our Database!";
            echo "</font></p>";
        }
        else {
            echo "<p><font color='#ff0000'>";
            echo "An error occured. Please try again later!";
            echo "</font></p>";
        }

    }
}

$sql = ("SELECT id FROM radiartworks");

$number = mysql_num_rows(mysql_query($sql));

$maximum_entrys = 20;

$sites = $number / $maximum_entrys; //Anzahl der Seiten errechnen

if (!isset($_GET['sort'])) {
    $identifier = "rand";
    $sort = "RAND()";
} else { //Sortiermöglichkeiten
    if ($_GET['sort'] == "up") {
        $identifier = "up";
        $sort = "up DESC, down DESC";
    }
    if ($_GET['sort'] == "x") {
        $identifier = "x";
        $sort = "x DESC, y DESC";
    }
    if ($_GET['sort'] == "time") {
        $identifier = "time";
        $sort = "time DESC";
    }
}

//Normalabfrage, wenn keine Seite gegeben ist.
if (!isset($_GET['page'])) {
    $sql = "SELECT id, user, title, array, x, y, ".
        "DATE_FORMAT(time,' %d.%m.%Y at %H.%i h') as time, up, down ".
        "FROM radiartworks ORDER BY " . $sort .
        " LIMIT 0," . $maximum_entrys . ";";
} else {
    //Abfrage, wenn eine Seitenzahl gegeben ist.
    $datas = ($_GET['page'] * $maximum_entrys) - $maximum_entrys;
    $sql = "SELECT * FROM radiartworks ORDER BY " . $sort . " LIMIT " .
        $datas . "," . $maximum_entrys * $_GET['page'] . ";";
}


//Sortierfunktionen
echo '<a class="sort" href="display.php?id_img=' . $random['id'] .
    '">Random radiartwork</a>
	<b> | </b>
	<a class="sort" href="database.php?sort=x">Sort by Size</a>
	<a class="sort" href="database.php?sort=time">Sort by Date</a>
	<a class="sort" href="database.php?sort=up">Sort by Rating</a>';


//Tabelle ausgeben
echo "<table>";
echo "<tr>
	<th>Number</th>
	<th>Artist</th>
	<th>Title</th>
	<th>Size</th>
	<th>Date of Publication</th>
	<th>Rating</th>
</tr>";


$res = mysql_query($sql);

while ($data = mysql_fetch_assoc($res)) {

    $width_up = 0.3 * $data["up"];
    $width_down = 0.3 * $data["down"];


    echo '
	<tr>
		<td>' . $data["id"] . '</td>
		<td>' . escape($data["user"]) . '</td>
		<td><a href="display.php?id_img=' . $data["id"] . '">' .
        escape($data["title"]) . '</a></td>
		<td>' . $data["x"] . ' x ' . $data["y"] . '</td>
		<td>' . $data["time"] . '</td>
		<td>
			<div class="up" style="width: ' . $width_up . 'px"></div>
			<span style="color:green">' . $data["up"] . '</span><br />
			<div class="down" style="width: ' . $width_down . 'px"></div>
			<span style="color:red">' . $data["down"] . '</span>
		</td>
	</tr>';
}

echo '</table>';

//Ausgabe der Linkliste
for ($i = 2; $i - 1 < $sites; $i++) {
    echo '<a class="num" href="database.php?page=' . $i . '&sort=' .
        $identifier . '">' . $i . '</a>';
}

echo '</div>';

echo $footer;
?>
</body>
</html>

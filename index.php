<?php
include('inc/common.inc.php');

// select radiartwork with corresponding id
$sql_home_logo = "select * from radiartworks where id = 1";

// database query
$res = db_query($sql_home_logo);

// output data
while ($data = db_fetch_assoc($res)) {

    // unserialize array
    $erg = unserialize($data["array"]);

    echo '<div class="size">';

    // output multidimensional array with loop
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
        echo '<br />';
    }
    echo '</div> ';
}

// select radiartwork with corresponding id
$sql_home_content = "SELECT * FROM radiartworks where x = 90 and id != 1 ORDER BY RANDOM() LIMIT 1";

// database query
$res = db_query($sql_home_content);

// output data
while ($data = db_fetch_assoc($res)) {

    // unserialize array
    $erg = unserialize($data["array"]);

    echo '<div class="size">';

    // output array with loop
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
        echo '<br />';
    }

    echo '</div> ';
}

echo $footer;
?>

</body>
</html>

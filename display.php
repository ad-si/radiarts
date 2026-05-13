<?php
include('inc/common.inc.php');

echo '<div id="display">';

// if a radiartwork is selected
if (isset($_GET["id_img"])) {

    // select radiartwork with corresponding id
    $sql_display = "SELECT * FROM radiartworks WHERE id = " . intval($_GET["id_img"]) . ";";
}

// database query
$res = db_query($sql_display);

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
                    '" checked="checked" onfocus="a=this.checked"
                    onclick="this.checked=!a;this.blur()" />';
            } else {
                echo '<input type="radio" name="' . $value .
                    '" onfocus="a=this.checked"
                    onclick="this.checked=!a;this.blur()" />';
            }
        }
        echo '<br />';
    }


    if ($data["up"] == 0 && $data["up"] == 0) {
        $width_up = 0;
        $width_down = 0;
    } else {
        $width_up = (200 / ($data["up"] + $data["down"])) * $data["up"];
        $width_down = (200 / ($data["up"] + $data["down"])) * $data["down"];
    }

    echo '</div>
        <div class="rate">
    <form action="display.php?id_img=' . $data["id"] . '" method="post">
      <input type="submit" class="up_button" name="plus" value="" />
      <input type="submit" class="down_button" name="minus" value="" />
    </form>';


    echo '<div class="wrap_bar">
        <div class="up" style="width: ' . $width_up . 'px"></div> ' .
        $data["up"] .
        ' <br />
      <div class="down" style="width: ' . $width_down . 'px"></div> ' .
        $data["down"] .
        ' </div>
    </div>';

    if (isset($rating)) {
        if ($rating == 1) {
            echo '<br /><em>Yeah! Thanks for your rating!</em>';
        } else {
            echo '<br /><em>Just one rating per day!</em>';
        }
    }
}


echo '<br /><a class="sort" href="display.php?id_img=' . $random['id'] .
    '">Random radiartwork</a>';
echo '</div>';

echo $footer;

?>

</body>
</html>

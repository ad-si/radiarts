<?php
include('inc/common.inc.php');


echo '<div id="paint">';

echo '<form action="database.php" method="post">';
echo '<div class="size" ';

if (!isset($_POST["send"])) {
    $valuex = 100; //default-size
    $valuey = 50;
} else {
    $valuex = $_POST["xsize"];
    $valuey = $_POST["ysize"];
}


echo 'style="width: ' . ($valuex * 12) . 'px;">';

for ($i = 0; $i <= ($valuey - 1); $i++) {
    for ($j = 1; $j <= $valuex; $j++) {
        $value = ($i * $valuex) + $j;

        echo '<input type="radio" name="' . $value .
            '" onfocus="a=this.checked" onclick="this.checked=!a;this.blur()" />';
    }
}


echo '</div>

<br />
<br />
	<div id="form_div">
		<span>My name is</span>
		<input class="info" type="text" name="user" />
		<span>and my masterpiece is called</span>
		<input class="info" type="text" name="title" />
		<input type="hidden" value="' . $valuex . '" name="xsize" />
		<input type="hidden" value="' . $valuey . '" name="ysize" />
		<input type="submit" value="Save" name="send" />
	</div>
</form>

<br />

<form id="form_size" action="paint.php" method="post">
	Change the resolution of my radiartwork:
	<input class="size" type="number" min="1" max="100" value="' .
    $valuex . '" name="xsize" />
	x
	<input class="size" type="number" min="1" max="100" value="' .
    $valuey . '" name="ysize" />
	<input id="submit_size" type="submit" value="Change" name="send" />
</form> ';

echo '</div>';


echo $footer;
?>

</body>
</html>

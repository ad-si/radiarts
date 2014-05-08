<?php
/*
$mysqlHost = "217.11.53.158";
$mysqlUser = "radiarts";
$mysqlPassword = "gonuga28";
$mysqlName = "radiarts";
*/

$mysqlHost = "localhost";
$mysqlUser = "root";
$mysqlPassword = "admin";
$mysqlName = "radiarts";

$connect = @mysql_connect($mysqlHost, $mysqlUser, $mysqlPassword) or die("Can not connect to the database!");
$selectDB = @mysql_select_db($mysqlName, $connect) or die("The databse <b>$mysqlName</b> can not be selected!");

?>
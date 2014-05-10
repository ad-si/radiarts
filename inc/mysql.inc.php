<?php

$mysqlHost = "127.0.0.1";
$mysqlUser = "root";
$mysqlPassword = "gorula34";
$mysqlName = "radiarts";

$connect = @mysql_connect($mysqlHost, $mysqlUser, $mysqlPassword)
    or die("Can not connect to the database!");
$selectDB = @mysql_select_db($mysqlName, $connect)
    or die("The databse <b>$mysqlName</b> can not be selected!");

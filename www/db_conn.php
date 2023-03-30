<?php

$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "hcs";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed!");
}

<?php
$hostName = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_register";
$conn = mysqli_connect($hostName, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Cannot connect to the database");
}
?>
<?php

define("BASEURL", "/minimarket"); // For localhost
// define('BASEURL', '/'); // For virtual host

$app_name = "minimarket";
$host = "localhost";
$user = "root";
$password = "";
$db = "school_minimarket";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed");
}

<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "minimarket";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed");
}
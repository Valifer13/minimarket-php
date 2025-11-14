<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT * FROM categories WHERE LOWER(name) LIKE LOWER('%$keyword%')";
$result = mysqli_query($conn, $query);

$categories = [];
while ($row = $result->fetch_assoc()) {
    array_push($categories, $row);
}

echo json_encode($categories);
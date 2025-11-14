<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT * FROM suppliers WHERE LOWER(name) LIKE LOWER('%$keyword%') ORDER BY status < 1";
$result = mysqli_query($conn, $query);

$suppliers = [];
while ($row = $result->fetch_assoc()) {
    array_push($suppliers, $row);
}

echo json_encode($suppliers);
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT * FROM vouchers WHERE LOWER(name) LIKE LOWER('%$keyword%') OR LOWER(code) LIKE LOWER('%$keyword%')";
$result = mysqli_query($conn, $query);

$vouchers = [];
while ($row = $result->fetch_assoc()) {
    array_push($vouchers, $row);
}

echo json_encode($vouchers);
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret');
require_once ROOTPATH . "/config/config.php";

$query = "SELECT * FROM cashiers WHERE id=" . $_POST['id'];
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode($data);
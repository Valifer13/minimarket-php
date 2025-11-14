<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$id = $_POST['id'];
$query = "SELECT * FROM categories WHERE id=$id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode($data);
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/pos-minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT p.*, c.name AS category_name, s.name AS supplier_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
    JOIN suppliers s on P.supplier_id = s.id
    WHERE p.name LIKE '%$keyword%'
";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = $result->fetch_assoc()) {
    array_push($products, $row);
}

echo json_encode($products);
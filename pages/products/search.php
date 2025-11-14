<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT p.*, c.name AS category_name, s.name AS supplier_name, v.code AS voucher_code
    FROM products p
    JOIN categories c ON p.category_id = c.id
    JOIN suppliers s ON p.supplier_id = s.id
    LEFT JOIN vouchers v on p.voucher_id = v.id
    WHERE LOWER(p.name) LIKE LOWER('%$keyword%')
";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = $result->fetch_assoc()) {
    array_push($products, $row);
}

echo json_encode($products);
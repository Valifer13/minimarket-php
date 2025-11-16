<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT
    p.*,
    c.name AS category_name,
    s.name AS supplier_name,
    v.name AS voucher_name,
    v.code AS voucher_code,
    v.discount AS voucher_discount,
    v.max_discount AS voucher_max_discount
FROM products p
    JOIN categories c ON p.category_id = c.id
    JOIN suppliers s on p.supplier_id = s.id
    LEFT JOIN vouchers v on p.voucher_id = v.id;
";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = $result->fetch_assoc()) {
    array_push($products, $row);
}

echo json_encode($products);
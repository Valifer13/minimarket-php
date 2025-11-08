<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/pos-minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $desc = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $barcode = substr(hash("sha256", $name), 0, 17);
    $brand_id = $_POST['brand'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category'];
    $sell_price = floatval($_POST['sell_price']);
    $buy_price = floatval($_POST['buy_price']);

    if ($action == 'add') {
        $query = "INSERT INTO products (barcode, name, category_id, supplier_id, buy_price, sell_price, stock) VALUES ('$barcode', '$name', $category_id, $brand_id, $buy_price, $sell_price, $stock)";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM products WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE products SET name='$name', price=$price, stock=$stock, status=$status WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'delete-multiple' && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $idList = implode(",", array_map('intval', $ids));

        $query = "DELETE FROM products WHERE id IN ($idList)";
        mysqli_query($conn, $query);
    } 

    header("Location: ../pages/products/index.php");
    exit;
}
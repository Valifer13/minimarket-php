<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/pos-minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'] ?? null;
    $name = filter_var($_POST['name'] ?? null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'] ?? null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $barcode = substr(hash("sha256", $name), 0, 17);
    $supplier_id = $_POST['supplier'] ?? null;
    $stock = $_POST['stock'] ?? null;
    $category_id = $_POST['category'] ?? null;
    $sell_price = floatval($_POST['sell_price'] ?? null);
    $buy_price = floatval($_POST['buy_price'] ?? null);

    if ($action == 'add') {
        $query = "INSERT INTO products (barcode, name, description, category_id, supplier_id, buy_price, sell_price, stock) VALUES ('$barcode', '$name', '$description', $category_id, $supplier_id, $buy_price, $sell_price, $stock)";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM products WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE products SET name='$name', description='$description', supplier_id=$supplier_id, category_id=$category_id, stock=$stock, sell_price=$sell_price, buy_price=$buy_price WHERE id=$id";
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
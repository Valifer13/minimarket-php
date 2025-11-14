<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/minimarket");
include ROOTPATH . "/config/config.php";
include_once ROOTPATH . "/includes/getData.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'] ?? null;
    $name = filter_var($_POST['name'] ?? null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'] ?? null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $barcode = substr(hash("sha256", $name), 0, 17);
    $supplier_name = $_POST['supplier'] ?? null;
    $stock = $_POST['stock'] ?? null;
    $category_name = $_POST['category'] ?? null;
    $sell_price = floatval($_POST['sell_price'] ?? null);
    $buy_price = floatval($_POST['buy_price'] ?? null);
    $supplier = null;
    $category = null;

    if (!is_null($supplier_name)) {
        $query = "SELECT * FROM suppliers WHERE LOWER(name) = LOWER('$supplier_name')";
        $supplier = getData($query);
    }

    if (!is_null($category_name)) {
        $query = "SELECT * FROM categories WHERE LOWER(name) = LOWER('$category_name')";
        $category = getData($query);
    }

    if ($action == 'add') {
        $query = "INSERT INTO products (barcode, name, description, category_id, supplier_id, buy_price, sell_price, stock) VALUES ('$barcode', '$name', '$description', " . $category['id'] . ", " . $supplier['id'] . ", $buy_price, $sell_price, $stock)";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM products WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE products SET name='$name', description='$description', supplier_id=" . $supplier['id'] . ", category_id=" . $category['id'] . ", stock=$stock, sell_price=$sell_price, buy_price=$buy_price WHERE id=$id";
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
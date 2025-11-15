<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'];
    $name = filter_var($_POST['name'] ?? null, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $code = $_POST['code'] ?? null;
    $discount = filter_var($_POST['discount'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $max_discount = filter_var($_POST['max_discount'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = $_POST['status'];
    $expired_date = $_POST['expired_date'];

    if ($action == 'add') {
        $query = "INSERT INTO vouchers (name, code, discount, max_discount, status, expired_date) VALUES ('$name', '$code', $discount, $max_discount, '$status', '$expired_date')";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM vouchers WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE vouchers SET name='$name', status='$status', discount=$discount, max_discount=$max_discount, expired_date='$expired_date' WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'delete-multiple' && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $idList = implode(",", array_map('intval', $ids));

        $query = "DELETE FROM vouchers WHERE id IN ($idList)";
        mysqli_query($conn, $query);
    } 

    header("Location: ../pages/vouchers/index.php");
    exit;
}
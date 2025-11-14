<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $action = $_POST['action'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = intval($_POST['status']);

    if ($action == 'add') {
        $query = "INSERT INTO suppliers (name, contact, address, status) VALUES ('$name', '$contact', '$address', $status)";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM suppliers WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE suppliers SET name='$name', status=$status, contact='$contact', address='$address' WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'delete-multiple' && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $idList = implode(",", array_map('intval', $ids));

        $query = "DELETE FROM cashiers WHERE id IN ($idList)";
        mysqli_query($conn, $query);
    } 

    header("Location: ../pages/suppliers/index.php");
    exit;
}
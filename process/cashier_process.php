<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/pos-minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['cashier-id'];
    $action = $_POST['action'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = intval($_POST['status']);

    if ($action == 'add') {
        $query = "INSERT INTO cashiers (name, status) VALUES ('$name', $status)";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM cashiers WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE cashiers SET name='$name', status=$status WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'delete-multiple' && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $idList = implode(",", array_map('intval', $ids));

        $query = "DELETE FROM cashiers WHERE id IN ($idList)";
        mysqli_query($conn, $query);
    } 

    header("Location: ../pages/cashiers/index.php");
    exit;
}
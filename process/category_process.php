<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . "/minimarket");
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['category_id'];
    $action = $_POST['action'];
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    echo $name;
    echo $id;

    if ($action == 'add') {
        $query = "INSERT INTO categories (name) VALUES ('$name')";
        mysqli_query($conn, $query);
    } else if ($action == 'delete') {
        $query = "DELETE FROM categories WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'update') {
        $query = "UPDATE categories SET name='$name' WHERE id=$id";
        mysqli_query($conn, $query);
    } else if ($action == 'delete-multiple' && !empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $idList = implode(",", array_map('intval', $ids));

        $query = "DELETE FROM categories WHERE id IN ($idList)";
        mysqli_query($conn, $query);
    } 

    header("Location: ../pages/categories/index.php");
    exit;
}
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret');
require_once ROOTPATH . "/config/config.php";

$keyword = $_POST['search'];
$query = "SELECT * FROM cashiers WHERE name LIKE '%$keyword%'";
$result = mysqli_query($conn, $query);

// if (isset($_POST['ajax'])) {
//     $keyword = isset($_POST['search']) ? $_POST['search'] : "";

//     if ($keyword != "") {
//         $stmt = $conn->prepare("SELECT * FROM cashiers WHERE name LIKE ?");
//         $search = "%" . $keyword . "%";
//         $stmt->bind_param("s", $search);
//     } else {
//         $stmt = $conn->prepare("SELECT * FROM cashiers");
//     }

//     $stmt->execute();
//     $result = $stmt->get_result();
// }

$cashiers = [];
while ($row = $result->fetch_assoc()) {
    array_push($cashiers, $row);
}

echo json_encode($cashiers);
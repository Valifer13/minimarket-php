<?php 
function getData($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    return $result->fetch_assoc();
}
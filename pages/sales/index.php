<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);

?>

<div>this is sale page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
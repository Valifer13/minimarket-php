<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);

?>

<div id="name-page" data-page="sales" class="hidden"></div>
<div>this is sale page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
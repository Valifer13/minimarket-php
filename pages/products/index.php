<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/pos-minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

?>

<div id="name-page" data-page="products" class="hidden"></div>
<div>this is product page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
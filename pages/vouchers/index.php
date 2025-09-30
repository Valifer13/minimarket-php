<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/pos-minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);

?>

<div id="name-page" data-page="vouchers" class="hidden"></div>
<div>this is voucher page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
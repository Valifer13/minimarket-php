<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

?>

<div id="name-page" data-page="customers" class="hidden"></div>
<div>this is customers page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
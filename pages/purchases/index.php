<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/pos-minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

?>

<div id="name-page" data-page="purchases" class="hidden"></div>
<div>this is purchase page</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
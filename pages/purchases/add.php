<?php
ob_start();
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

if (isset($_POST['next'])) {
    $query = "SELECT id, code FROM purchases ORDER BY id DESC LIMIT 1";
    $data  = mysqli_query($conn, $query)->fetch_assoc(); // PTRX0001

    if ($data) {
        $last_code = $data['code'];
        $number    = (int) substr($last_code, 4, 8);
        $number++;

        $transaction_code = "PTRX" . str_pad($number, 4, "0", STR_PAD_LEFT);
    } else {
        $transaction_code = "PTRX0001";
    }

    $supplier_name = $_POST['supplier_name'];
    $admin_name    = $_POST['admin_name'];

    $query       = "SELECT id FROM suppliers WHERE name='$supplier_name'";
    $result      = mysqli_query($conn, $query)->fetch_assoc();
    $supplier_id = $result['id'];

    $query    = "SELECT id FROM admins WHERE name='$admin_name'";
    $result   = mysqli_query($conn, $query)->fetch_assoc();
    $admin_id = $result['id'];

    date_default_timezone_set('Asia/Makassar');
    $transaction_date = date("Y-m-d H:i:s");

    $query = "INSERT INTO purchases (code, supplier_id, admin_id, transaction_date)
              VALUES ('$transaction_code', $supplier_id, $admin_id, '$transaction_date')";

    if ($new_transaction = mysqli_query($conn, $query)) {
        $last_transaction_id = mysqli_insert_id($conn);
    }

    $_SESSION['transaction_id'] = $last_transaction_id;

    if (!$new_transaction) {
        echo "<p>Failed to save transaction: " . mysqli_error($conn) . "</p>";
    } else {
        header('Location: ./transaction_details.php');
        exit;
    }
}

$query = "SELECT name FROM suppliers";
$suppliers_result = mysqli_query($conn, $query);

$query = "SELECT name FROM admins";
$admins_result = mysqli_query($conn, $query);
?>

<div id="name-page" data-page="add-purchase" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='/minimarket/pages/purchases/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to transaction list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Add New Purchase Transaction</h1>
    </div>
</div>

<form action="" method="post">
    <input type="hidden" name="next" value="Next">
    <div class="flex flex-col gap-8">
        <div class="w-full max-w-lg flex flex-col">
            <label for="admin" class="text-sm text-zinc-500 font-medium">Admin</label>
            <input list="admins" name="admin_name" id="admin_name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select admin" required autocomplete="off">
            <datalist id="admins">
                <?php while ($row = mysqli_fetch_assoc($admins_result)) : ?>
                    <option value="<?= $row['name'] ?>"></option>
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="w-full max-w-lg flex flex-col">
            <label for="supplier" class="text-sm text-zinc-500 font-medium">Brand</label>
            <input list="suppliers" name="supplier_name" id="supplier_name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select brand" required autocomplete="off">
            <datalist id="suppliers">
                <?php while ($row = mysqli_fetch_assoc($suppliers_result)) : ?>
                    <option value="<?= $row['name'] ?>"></option>
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="flex w-full max-w-lg gap-4 justify-end items-center">
            <button type="button" class="py-2 px-4 rounded-md bg-zinc-100 hover:bg-zinc-300 text-blue-500 border border-blue-500 text-md transition-all duration-300" onclick="window.location='/minimarket/pages/purchases/index.php'">Discard</button>
            <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-md transition-all duration-300">Next</button>
        </div>
    </div>
</form>

<?php require_once ROOTPATH . "/includes/footer.php" ?>

<?php
ob_start();
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

if (isset($_POST['next'])) {
    $query = "SELECT id, code FROM sales ORDER BY id DESC LIMIT 1";
    $data  = mysqli_query($conn, $query)->fetch_assoc(); // STRX0001

    if ($data) {
        $last_code = $data['code'];
        $number    = (int) substr($last_code, 4, 8);
        $number++;

        $transaction_code = "STRX" . str_pad($number, 4, "0", STR_PAD_LEFT);
    } else {
        $transaction_code = "STRX0001";
    }

    $cashier_name  = $_POST['cashier_name'];
    $customer_name = $_POST['customer_name'];
    $customer_id   = "NULL";

    $query      = "SELECT id FROM cashiers WHERE name='$cashier_name'";
    $result     = mysqli_query($conn, $query)->fetch_assoc();
    $cashier_id = $result['id'];

    if (isset($customer_name) && $customer_name != "") {
        $query       = "SELECT id FROM customers WHERE name='$customer_name'";
        $result      = mysqli_query($conn, $query)->fetch_assoc();
        $customer_id = $result['id'];
    }

    date_default_timezone_set('Asia/Makassar');
    $transaction_date = date("Y-m-d H:i:s");

    $query = "INSERT INTO sales (code, customer_id, cashier_id, transaction_date)
              VALUES ('$transaction_code', $customer_id, $cashier_id, '$transaction_date')";

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

$query = "SELECT name FROM customers";
$customers_result = mysqli_query($conn, $query);

$query = "SELECT name FROM cashiers WHERE status = 1";
$cashiers_result = mysqli_query($conn, $query);
?>

<div id="name-page" data-page="add-sales" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='/minimarket/pages/sales/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to transaction list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Add New Sale Transaction</h1>
    </div>
</div>

<form action="" method="post">
    <input type="hidden" name="next" value="Next">
    <div class="flex flex-col gap-8">
        <div class="w-full max-w-lg flex flex-col">
            <label for="cashier_name" class="text-sm text-zinc-500 font-medium">Cashier</label>
            <input list="cashiers" name="cashier_name" id="cashier_name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select cashier" required autocomplete="off">
            <datalist id="cashiers">
                <?php while ($row = mysqli_fetch_assoc($cashiers_result)) : ?>
                    <option value="<?= $row['name'] ?>"></option>
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="w-full max-w-lg flex flex-col">
            <label for="customer" class="text-sm text-zinc-500 font-medium">Customer</label>
            <input list="customers" name="customer_name" id="customer_name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select customer" autocomplete="off">
            <datalist id="customers">
                <?php while ($row = mysqli_fetch_assoc($customers_result)) : ?>
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

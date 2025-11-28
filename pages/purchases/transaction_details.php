<?php
define("ROOTPATH", $_SERVER["DOCUMENT_ROOT"] . "/minimarket");

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    $id = $_SESSION["transaction_id"];
}

$header_query = mysqli_query(
    $conn,
    "SELECT p.*, a.name AS admin_name, s.name AS supplier_name, s.id AS supplier_id
FROM purchases p
JOIN admins a ON p.admin_id = a.id
JOIN suppliers s on p.supplier_id = s.id
WHERE p.id = $id;
",
);

$detail = $header_query->fetch_assoc();

$query = mysqli_query(
    $conn,
    "SELECT purchase_items.*, products.name AS product_name, voucher_id
FROM purchase_items
JOIN products ON purchase_items.product_id = products.id
JOIN purchases ON purchase_items.purchase_id = purchases.id
LEFT JOIN vouchers ON products.voucher_id = vouchers.id
WHERE purchase_items.purchase_id = $id
",
);

$status = mysqli_query(
    $conn,
    "SELECT status FROM purchases WHERE id = $id",
)->fetch_assoc()["status"];

$product_query =
    "SELECT * FROM products LEFT JOIN purchase_items ON products.id = purchase_items.product_id AND purchase_items.purchase_id = $id WHERE purchase_items.product_id IS NULL AND products.supplier_id = " .
    $detail["supplier_id"];
$products = mysqli_query($conn, $product_query);
?>

<div id="name-page" data-page="purchase-details" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='/minimarket/pages/purchases/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to transaction list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Transaction <?= $detail['code'] ?></h1>
    </div>
</div>

<?php if (isset($_POST["payment"])): ?>
    <form action="<?= BASEURL ?>/process/purchase_process.php" method="post" class="border border-zinc-300 rounded-lg p-5 w-fit max-w-xl mb-10">
        <input type="hidden" name="action" value="payment">
        <input type="hidden" name="transaction_id" value="<?= $id ?>">
        <div class="flex flex-col gap-1">
            <label for="payment_amount" class="text-sm text-zinc-500 font-medium">Payment Amount</label>
            <div class="flex gap-4">
                <div class="flex">
                    <div class="p-2 bg-zinc-100 rounded-s-md border border-r-0 border-zinc-300">
                        <span class="text-sm text-zinc-400 font-medium">Rp</span>
                    </div>
                    <input type="number" name="payment_amount" id="payment_amount" class="w-full border border-l-0 border-zinc-300 rounded-e-md p-2 focus:outline-none text-sm" placeholder="0" required>
                </div>
                <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-sm transition-all duration-300 w-fit">Pay</button>
            </div>
        </div>
    </form>
<?php elseif ($status == "PAID"): ?>
    <form action="<?= BASEURL ?>/process/purchase_process.php" method="post" class="border border-zinc-300 rounded-lg p-5 max-w-xl mb-10">
        <input type="hidden" name="transaction_id" value="<?= $id ?>">
        <input type="hidden" name="action" value="delete">
        <h2 class="text-lg md:text-xl font-medium tracking-tighter mb-4 text-zinc-600">This Transaction has been Paid</h2>
        <button type="submit" class="py-2 px-4 rounded-md bg-red-500 hover:bg-red-700 cursor-pointer text-white text-sm transition-all duration-300 w-fit">Delete Transaction</button>
    </form>
<?php else: ?>
    <!-- Hidden form to continue to the payment -->
    <form action="" method="post" id="startPayment" class="hidden">
        <input type="hidden" name="payment" value="Payment">
    </form>

    <form action="<?= BASEURL ?>/process/purchase_process.php" method="post" class="border border-zinc-300 rounded-lg p-5 max-w-xl mb-10">
        <input type="hidden" name="transaction_id" value="<?= $id ?>">
        <input type="hidden" name="action" value="add-item">
        <h2 class="text-lg md:text-xl font-medium tracking-tighter mb-4 text-zinc-600">Add Product</h2>
        <div class="w-full flex flex-col gap-4">
            <div class="flex flex-col">
                <label for="product_name" class="text-sm text-zinc-500 font-medium">Product</label>
                <input list="products" name="product_name" id="product_name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select product" required autocomplete="off">
                <datalist id="products">
                    <?php while ($row = mysqli_fetch_assoc($products)): ?>
                        <option value="<?= $row["name"] ?>">
                            <?= $row["stock"] ?>
                        </option>
                    <?php endwhile; ?>
                </datalist>
            </div>
            <div class="flex flex-col">
                <label for="qty" class="text-sm text-zinc-500 font-medium">Quantity</label>
                <input type="number" min="1" name="qty" id="qty" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Quantity" required autocomplete="off">
            </div>
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5">
                <p class="text-sm text-zinc-400">New product? <a href="<?= BASEURL ?>/pages/products/add.php" class="text-blue-400 cursor-pointer hover:text-blue-500 font-medium">add new product</a></p>
                <div class="flex gap-4 justify-end">
                    <button type="submit" form="startPayment" class="py-2 px-4 rounded-md bg-zinc-500 hover:bg-zinc-600 text-white text-sm transition-all duration-300 w-fit">Payment</button>
                    <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-sm transition-all duration-300 w-fit">Add</button>
                </div>
            </div>
        </div>
    </form>
<?php endif; ?>

<?php if (isset($_SESSION['payment_message'])): ?>
<h2 id="flash_message" class="bg-red-500 mb-10 text-white font-semibold w-fit px-4 py-3 fixed right-5 top-5">!INFO <?= $_SESSION['payment_message'] ?></h2>
<?php
unset($_SESSION['payment_message']);
unset($_SESSION['payment_message_type']);
endif;
?>


<div class="border border-zinc-300 rounded-lg w-full mb-20">
    <div class="flex w-full justify-between items-center p-5">
        <h2 class="text-md md:text-xl font-medium tracking-tighter text-zinc-600">Items Detail</h2>
        <p class="text-xs md:text-md text-zinc-500"><?= $detail['transaction_date'] ?>, <?= $detail['admin_name'] ?> / <?= $detail['admin_id'] < 10 ? "0" : "" ?><?= $detail['admin_id'] ?></p>
    </div>
    <div class="overflow-x-auto overflow-y-hidden">
        <table class="table-auto w-full min:w-max">
            <thead>
                <tr class="text-zinc-400 *:text-sm *:text-start *:px-5 *:py-2 bg-zinc-100">
                    <th class="border-b border-b-zinc-300 w-10">No</th>
                    <th class="border-b border-b-zinc-300">Name</th>
                    <th class="border-b border-b-zinc-300">Qty</th>
                    <th class="border-b border-b-zinc-300">Price</th>
                    <th class="border-b border-b-zinc-300">Subtotal</th>
                    <th class="border-b border-b-zinc-300 w-0 whitespace-nowrap"></th>
                </tr>
            </thead>
            <tbody id="items-table-body">
                <?php
                $no = 1;
                while ($detail_product = mysqli_fetch_assoc($query)): ?>
                    <tr class="*:text-sm **:text-nowrap *:border-b *:border-b-zinc-300 *:px-5 *:py-2">
                        <td><?= $no++ ?></td>
                        <td><?= $detail_product["product_name"] ?></td>
                        <td><?= $detail_product["quantity"] ?></td>
                        <td>Rp <?= number_format($detail_product['price'], 2, ',', '.') ?></td>
                        <td>Rp <?= number_format(($detail_product['price'] * $detail_product['quantity']), 2, ',', '.') ?></td>
                        <?php if ($status != "PAID"): ?>
                        <td class="w-0 whitespace-nowrap relative">
                            <form action="<?= BASEURL ?>/process/purchase_process.php" method="post">
                                <input type="hidden" name="action" value="delete-item">
                                <input type="hidden" name="product_id" value="<?= $detail_product['product_id']; ?>">
                                <input type="hidden" name="transaction_id" value="<?= $id ?>">
                                <button class="text-zinc-500 absolute top-2 left-2 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
                <tr class="**:text-nowrap *:px-5 *:py-2">
                    <td colspan="4" class="text-lg font-medium text-end border-b border-r border-zinc-300">Total</td>
                    <td colspan="2" class="text-md font-medium border-b border-zinc-300">Rp <?= number_format($detail['total'], 2, ',', '.') ?></td>
                </tr>
                <tr class="**:text-nowrap *:px-5 *:py-2">
                    <td colspan="4" class="text-lg font-medium text-end border-b border-r border-zinc-300">Pay</td>
                    <td colspan="2" class="text-md font-medium border-b border-zinc-300">Rp <?= number_format($detail['cash'], 2, ',', '.') ?></td>
                </tr>
                <tr class="**:text-nowrap *:px-5 *:py-2">
                    <td colspan="4" class="text-lg font-medium text-end border-b border-r border-zinc-300">Change</td>
                    <td colspan="2" class="text-md font-medium border-b border-zinc-300">Rp <?= number_format($detail['cash_change'], 2, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require_once ROOTPATH . "/includes/footer.php"; ?>

<script>
setTimeout(() => {
  const flashMessage = document.getElementById('flash_message');

  setTimeout(() => {
    flashMessage.remove();
  }, 3000);
})
</script>

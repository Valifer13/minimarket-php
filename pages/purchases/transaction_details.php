<?php
session_start();
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
// } else {
//     $id = $_GET['transaction_id'];
// }

// $header_query = mysqli_query($conn, "SELECT p.*, a.name AS admin_name, s.name AS supplier_name
// FROM purchases p
// JOIN admins a ON p.admin_id = a.id
// JOIN suppliers s on p.supplier_id = s.id
// WHERE p.id = $id;
// ");

// $detail = $header_query->fetch_assoc();

// $query = mysqli_query($conn, "SELECT purchase_items.*, products.name AS product_name, voucher_id
// FROM purchase_items
// JOIN products ON purchase_items.product_id = products.id
// JOIN purchases ON purchase_items.purchase_id = purchases.id
// LEFT JOIN vouchers ON products.voucher_id = vouchers.id
// WHERE purchase_items.purchase_id = $id
// ");

$product_query = "SELECT * FROM products WHERE products.stock > 0";
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
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Transaction Details</h1>
    </div>
</div>

<form action="<?= BASEURL ?>/process/purchase_process.php" method="post" class="border border-zinc-400 rounded-lg p-5 max-w-xl mb-10">
    <input type="hidden" name="transaction_id" value="<?= "1" ?>">
    <input type="hidden" name="action" value="add">
    <h2 class="text-lg md:text-xl font-medium tracking-tighter mb-4 text-zinc-600">Add Product</h2>
    <div class="w-full flex flex-col gap-4">
        <div class="flex flex-col">
            <label for="product" class="text-sm text-zinc-500 font-medium">Product</label>
            <input list="products" name="product" id="product" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select product" required autocomplete="off">
            <datalist id="products">
                <?php while ($row = mysqli_fetch_assoc($products)) : ?>
                    <option value="<?= $row['name'] ?>"><?= $row['stock'] ?></option>
                <?php endwhile; ?>
            </datalist>
        </div>
        <div class="flex flex-col">
            <label for="qty" class="text-sm text-zinc-500 font-medium">Quantity</label>
            <input type="number" min="1" name="qty" id="qty" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Quantity" required autocomplete="off">
        </div>
        <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-sm transition-all duration-300 w-fit">Add</input>
    </div>
</form>

<div class="border border-zinc-400 rounded-lg w-full">
    <h2 class="text-lg md:text-xl font-medium tracking-tighter text-zinc-600 p-5">Items Detail</h2>
    <table class="table-fixed w-full">
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
            <tr class="*:text-sm **:text-nowrap *:border-b *:border-b-zinc-300 *:px-5 *:py-2">
                <td>1</td>
                <td>Hape Samsung</td>
                <td>3</td>
                <td>Rp 2.000.000</td>
                <td>Rp 6.000.000</td>
                <td class="w-0 whitespace-nowrap"> 
                    <button>X</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
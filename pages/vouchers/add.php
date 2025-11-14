<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM vouchers ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query)->fetch_assoc();
$newVoucherCode = intval(substr($result, 2, 5));
$newVoucherCode += 1;

?>

<div id="name-page" data-page="add-voucher" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='/minimarket/pages/vouchers/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to vouchers list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Add New Voucher</h1>
    </div>
</div>

<form action="<?= BASEURL ?>/process/voucher_process.php" method="post">
    <input type="hidden" name="action" value="add">
    <div class="flex flex-col gap-8">
        <div class="w-full max-w-lg">
            <label for="name" class="text-sm text-zinc-500 font-medium">Voucher Name</label>
            <input type="text" name="name" id="name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Voucher Name" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="code" class="text-sm text-zinc-500 font-medium">Code</label>
            <input type="text" name="code" id="code" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="VCRXXX" value="<?= (!is_null($result)) ? "VCR$newVoucherCode" : "VCR001" ?>" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="discount" class="text-sm text-zinc-500 font-medium">Discount (%)</label>
            <input type="number" min="1" max="100" name="discount" id="discount" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="1 - 100" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="max_discount" class="text-sm text-zinc-500 font-medium">Discount (Rp)</label>
            <input type="number" name="max_discount" id="max_discount" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Rp. XXX.XXX.XXX" required>
        </div>
        <div class="w-full max-w-lg flex flex-col">
            <label for="status" class="text-sm text-zinc-500 font-medium">Status</label>
            <select name="status" id="status" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm">
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option>
                <option value="EXPIRED">Expired</option>
            </select>
        </div>
        <div class="flex w-full max-w-lg gap-4 justify-end items-center">
            <button type="button" class="py-2 px-4 rounded-md bg-zinc-100 hover:bg-zinc-300 text-blue-500 border border-blue-500 text-md transition-all duration-300" onclick="window.location='/minimarket/pages/suppliers/index.php'">Discard</button>
            <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-md transition-all duration-300">Add Product</button>
        </div>
    </div>
</form>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
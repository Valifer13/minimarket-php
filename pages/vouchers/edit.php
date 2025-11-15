<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$id = $_GET['id'];
$query = "SELECT * FROM vouchers WHERE id=$id";
$result = mysqli_query($conn, $query)->fetch_assoc();

?>

<div id="name-page" data-page="edit-voucher" class="hidden"></div>

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

<form class="mb-20" action="<?= BASEURL ?>/process/voucher_process.php" method="post">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="flex flex-col gap-8">
        <div class="w-full max-w-lg">
            <label for="name" class="text-sm text-zinc-500 font-medium">Voucher Name</label>
            <input type="text" name="name" id="name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Voucher Name" value="<?= $result['name'] ?>" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="code" class="text-sm text-zinc-500 font-medium">Code</label>
            <input disabled type="text" name="code" id="code" class="w-full border bg-zinc-100 text-zinc-400 border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="VCRXXX" value="<?= $result['code'] ?>" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="discount" class="text-sm text-zinc-500 font-medium">Discount (%)</label>
            <input type="number" min="1" max="100" name="discount" id="discount" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="1 - 100" value="<?= $result['discount'] ?>" required>
        </div>
        <div class="w-full max-w-lg">
            <label for="max_discount" class="text-sm text-zinc-500 font-medium">Max Discount (Rp)</label>
            <input type="number" name="max_discount" id="max_discount" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Rp. XXX.XXX.XXX" value="<?= $result['max_discount'] ?>" required>
        </div>
        <div class="w-full flex max-w-lg gap-4">
            <div class="w-full flex flex-col">
                <label for="status" class="text-sm text-zinc-500 font-medium">Status</label>
                <div class="w-full border border-zinc-300 rounded-md p-2 mt-1 text-sm">
                    <select name="status" id="status" class="w-full focus:outline-none">
                        <option <?= $result['status'] == "ACTIVE" ? "selected" : "" ?> value="ACTIVE">Active</option>
                        <option <?= $result['status'] == "INACTIVE" ? "selected" : "" ?> value="INACTIVE">Inactive</option>
                        <option <?= $result['status'] == "EXPIRED" ? "selected" : "" ?> value="EXPIRED">Expired</option>
                    </select>
                </div>
            </div>
            <div class="w-full flex flex-col">
                <label for="expired_date" class="text-sm text-zinc-500 font-medium">Expired Date</label>
                <input type="date" name="expired_date" id="expired_date" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" value="<?= $result['expired_date'] ?>" required>
            </div>
        </div>
        <div class="flex w-full max-w-lg gap-4 justify-end items-center">
            <button type="button" class="py-2 px-4 rounded-md bg-zinc-100 hover:bg-zinc-300 text-blue-500 border border-blue-500 text-md transition-all duration-300" onclick="window.location='/minimarket/pages/vouchers/index.php'">Discard</button>
            <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-md transition-all duration-300">Add Product</button>
        </div>
    </div>
</form>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
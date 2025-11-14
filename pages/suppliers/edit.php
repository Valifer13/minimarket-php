<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$id = $_GET['id'];
$query = "SELECT * FROM suppliers WHERE id=$id";
$result = mysqli_query($conn, $query)->fetch_assoc();

?>

<div id="name-page" data-page="edit-supplier" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='/minimarket/pages/suppliers/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to supplier list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Edit Supplier</h1>
    </div>
</div>

<form action="<?= BASEURL ?>/process/supplier_process.php" method="post">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">
    <div class="flex flex-col gap-8">
        <div class="w-full max-w-lg">
            <label for="name" class="text-sm text-zinc-500 font-medium">Supplier Name</label>
            <input type="text" name="name" id="name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Supplier Name" required value="<?= $result['name'] ?>">
        </div>
        <div class="w-full max-w-lg">
            <label for="contact" class="text-sm text-zinc-500 font-medium">Contact</label>
            <input type="text" name="contact" id="contact" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="XXXX-XXXX-XXXX" required value="<?= $result['contact'] ?>">
        </div>
        <div class="w-full max-w-lg">
            <label for="address" class="text-sm text-zinc-500 font-medium">Address</label>
            <input type="text" name="address" id="address" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Supplier Address" required value="<?= $result['address'] ?>">
        </div>
        <div class="w-full max-w-lg flex flex-col">
            <label for="status" class="text-sm text-zinc-500 font-medium">Status</label>
            <select name="status" id="status" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm">
                <option value="1" <?= ($result['status']) == 1 ? "selected" : "" ?>>Connected</option>
                <option value="0" <?= ($result['status']) == 0 ? "selected" : "" ?>>Not Connected</option>
            </select>
        </div>
        <div class="flex w-full max-w-lg gap-4 justify-end items-center">
            <button type="button" class="py-2 px-4 rounded-md bg-zinc-100 hover:bg-zinc-300 text-blue-500 border border-blue-500 text-md transition-all duration-300" onclick="window.location='/minimarket/pages/suppliers/index.php'">Discard</button>
            <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-md transition-all duration-300">Add Product</button>
        </div>
    </div>
</form>
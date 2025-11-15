<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$suppliers_query = "SELECT * FROM suppliers";
$suppliers_result = mysqli_query($conn, $suppliers_query);

$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

$vouchers_query = "SELECT * FROM vouchers";
$vouchers_result = mysqli_query($conn, $vouchers_query);

?>

<div id="name-page" data-page="add-product" class="hidden"></div>

<div class="flex items-center gap-4 mb-8">
    <div class="p-3 border-[1px] border-zinc-300 rounded-md cursor-pointer hover:bg-zinc-100 transition-all duration-300" onclick="window.location='<?= BASEURL ?>/pages/products/index.php'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-sm text-zinc-400">Back to product list</p>
        <h1 class="text-xl md:text-2xl lg:text-3xl font-medium tracking-tighter">Add New Product</h1>
    </div>
</div>

<form action="<?= BASEURL ?>/process/product_process.php" method="post" class="flex flex-col min-[1100px]:flex-row gap-5 mb-8 w-full">
    <input type="hidden" name="action" value="add">
    <div class="flex flex-col gap-6 w-full min-[1100px]:max-w-lg">
        <div class="flex flex-col gap-2 w-full">
            <h2 class="text-lg font-medium text-zinc-600">Description</h2>
            <div class="flex flex-col border-[1px] border-zinc-300 rounded-md p-4 gap-4">
                <div>
                    <label for="name" class="text-sm text-zinc-500 font-medium">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Product Name" required>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="description" class="text-sm text-zinc-500 font-medium">Product Description</label>
                    <textarea name="description" id="description" rows="5" cols="30" class="border-[1px] border-zinc-300 rounded-md text-sm focus:outline-none p-2"></textarea>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 w-full">
            <h2 class="text-lg font-medium text-zinc-600">Supplier</h2>
            <div class="flex flex-col border-[1px] border-zinc-300 rounded-md p-4 gap-4">
                <div>
                    <label for="supplier" class="text-sm text-zinc-500 font-medium">Brand</label>
                    <input list="suppliers" name="supplier" id="supplier" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select brand" required autocomplete="off">
                    <datalist class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" id="suppliers">
                        <?php while ($row = mysqli_fetch_assoc($suppliers_result)) : ?>
                            <option value="<?= $row['name'] ?>"></option>
                        <?php endwhile; ?>
                    </datalist>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="stock" class="text-sm text-zinc-500 font-medium">Stock</label>
                        <input type="number" name="stock" id="stock" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="0" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="category" class="text-sm text-zinc-500 font-medium">Category</label>
                        <input list="categories" name="category" id="category" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Category" required autocomplete="off">
                        <datalist id="categories">
                            <?php while ($cat_row = mysqli_fetch_assoc($categories_result)) : ?>
                                <option value="<?= $cat_row['name'] ?>"></option>
                            <?php endwhile; ?>
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-6 w-full min-[1100px]:max-w-fit">
        <div class="flex flex-col gap-2">
            <h2 class="text-lg font-medium text-zinc-600">Images</h2>
            <div class="flex border-[1px] border-zinc-300 rounded-md p-4 gap-4 w-full min-[1100px]:max-w-lg overflow-y-auto [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <div class="min-h-32 min-w-32 bg-zinc-100 border border-zinc-300 rounded-md"></div>
                <div class="min-h-32 min-w-32 bg-zinc-100 border border-zinc-300 rounded-md"></div>
                <div class="min-h-32 min-w-32 bg-zinc-100 border border-zinc-300 rounded-md"></div>
                <div class="min-h-32 min-w-32 bg-zinc-100 border border-zinc-300 rounded-md"></div>
                <div class="min-h-32 min-w-32 bg-zinc-100 border border-zinc-300 rounded-md"></div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h2 class="text-lg font-medium text-zinc-600">Pricing</h2>
            <div class="flex flex-col border-[1px] border-zinc-300 rounded-md p-4 gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1">
                        <label for="sell_price" class="text-sm text-zinc-500 font-medium">Sell Price</label>
                        <div class="flex">
                            <div class="p-2 bg-zinc-100 rounded-s-md border border-r-0 border-zinc-300">
                                <span class="text-sm text-zinc-400 font-medium">Rp</span>
                            </div>
                            <input type="text" name="sell_price" id="sell_price" class="w-full border border-l-0 border-zinc-300 rounded-e-md p-2 focus:outline-none text-sm" placeholder="0" required>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="buy_price" class="text-sm text-zinc-500 font-medium">Buy Price</label>
                        <div class="flex">
                            <div class="p-2 bg-zinc-100 rounded-s-md border border-r-0 border-zinc-300">
                                <span class="text-sm text-zinc-400 font-medium">Rp</span>
                            </div>
                            <input type="text" name="buy_price" id="buy_price" class="w-full border border-l-0 border-zinc-300 rounded-e-md p-2 focus:outline-none text-sm" placeholder="0" required>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="voucher" class="text-sm text-zinc-500 font-medium">Voucher</label>
                    <input list="vouchers" name="voucher" id="voucher" class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" placeholder="Select voucher" required autocomplete="off">
                    <datalist class="w-full border border-zinc-300 rounded-md p-2 mt-1 focus:outline-none text-sm" id="vouchers">
                        <?php while ($row = mysqli_fetch_assoc($vouchers_result)) : ?>
                            <option value="<?= $row['name'] ?>"></option>
                        <?php endwhile; ?>
                    </datalist>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-4">
            <button class="py-2 px-4 rounded-md bg-zinc-100 hover:bg-zinc-300 text-blue-500 border border-blue-500 text-md transition-all duration-300" onclick="window.location='<?= BASEURL ?>/pages/products/index.php'">Discard</button>
            <button type="submit" class="py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 text-white text-md transition-all duration-300">Add Product</button>
        </div>
    </div>
</form>

<?php require_once ROOTPATH . "/includes/footer.php" ?>
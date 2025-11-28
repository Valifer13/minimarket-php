<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/minimarket');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT
    p.*,
    s.name AS supplier_name,
    a.name as admin_name
FROM purchases p
    JOIN suppliers s on p.supplier_id = s.id
    JOIN admins a on p.admin_id = a.id;
";
$result = mysqli_query($conn, $query);

?>

<div id="name-page" data-page="purchases" class="hidden"></div>

<!-- Page title -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-3xl font-medium tracking-tighter">Purchases List</h1>
    <div class="flex gap-2 md:gap-4">
        <a href="<?= BASEURL ?>/pages/purchases/add.php" class="flex gap-2 px-3 py-2 bg-blue-500 rounded-md items-center text-white text-sm tracking-tight cursor-pointer hover:bg-blue-600 transition-all duration-300 font-medium border-b-5 border-b-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span class="hidden md:block">ADD TRANSACTION</span>
        </a>
    </div>
</div>

<!-- Search form -->
<div class="flex flex-col-reverse md:flex-row justify-end md:justify-between gap-4 md:gap-0 items-end p-1 mb-4">
    <form action="" method="post" class="flex items-center p-1 w-full md:w-xs">
        <div class="p-2 border border-zinc-400 bg-zinc-100 rounded-s-md text-sm w-2xs flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input class="w-full focus:outline-none" type="text" name="search" id="search-keyword" placeholder="Search purchase...">
        </div>
        <button id="search-btn" type="submit" class="px-3 py-2 bg-zinc-100 hover:bg-zinc-200 border-y border-e border-zinc-400 rounded-e-md text-sm transition-all duration-300">Search</button>
    </form>
</div>

<!-- Main content -->
<div class="max-w-2xl overflow-x-auto overflow-y-hidden mb-20 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
    <table class="table-auto w-full min:w-max">
        <thead>
            <tr class="text-zinc-400 *:text-sm *:text-start">
                <th class="border-b border-b-zinc-300 p-2 w-10">No</th>
                <th class="border-b border-b-zinc-300 p-2">Date</th>
                <th class="border-b border-b-zinc-300 p-2">Code</th>
                <th class="border-b border-b-zinc-300 p-2">Admin</th>
                <th class="border-b border-b-zinc-300 p-2">Brand</th>
                <th class="border-b border-b-zinc-300 p-2">Total</th>
                <th class="border-b border-b-zinc-300 p-2 w-fit" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody id="purchases-table-body">
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()):
            ?>
                <tr class="**:text-sm **:text-nowrap">
                    <td class="border-y border-y-zinc-300 p-2 text-zinc-400"><?= $no++ ?></td>
                    <td class="border-y border-y-zinc-300 p-2"><?= $row['transaction_date'] ?></td>
                    <td class="border-y border-y-zinc-300 p-2"><?= $row['code'] ?></td>
                    <td class="border-y border-y-zinc-300 p-2"><?= $row['admin_name'] ?></td>
                    <td class="border-y border-y-zinc-300 p-2"><?= $row['supplier_name'] ?></td>
                    <td class="border-y border-y-zinc-300 p-2">Rp <?= number_format($row['total'], 2, ',', '.') ?></td>
                    <td class="items-center border-y border-y-zinc-300 p-2 w-18 whitespace-nowrap text-center">
                        <div class="flex gap-3">
                            <a href="<?= BASEURL ?>/pages/purchases/transaction_details.php?id=<?= $row['id'] ?>" class="transition-all duration-300 hover:bg-yellow-600 cursor-pointer bg-yellow-500 px-2 py-1 rounded-sm text-sm btn-update-purchase" data-id="<?= $row['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                            </a>
                            <form action="<?= BASEURL ?>/process/purchase_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="transition-all duration-300 hover:bg-red-800 cursor-pointer bg-red-500 px-2 py-1 rounded-sm text-white text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once ROOTPATH . "/includes/footer.php" ?>

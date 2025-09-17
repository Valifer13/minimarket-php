<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/indomaret');

require_once ROOTPATH . "/config/config.php";
require_once ROOTPATH . "/includes/formatDate.php";
require_once ROOTPATH . "/includes/header.php";

$query = "SELECT * FROM cashiers";
$result = mysqli_query($conn, $query);
?>

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl tracking-tighter font-medium">Cashiers List</h1>
    <button id="btn-add-cashier" class="flex gap-2 px-3 py-2 bg-blue-500 rounded-md items-center text-white text-sm tracking-tight cursor-pointer hover:bg-blue-600 transition-all duration-300 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        ADD CASHIER
    </button>
</div>
<div class="flex justify-between items-center">
    <div class="mb-4 p-2 border border-zinc-400 bg-zinc-100 rounded-md text-sm w-2xs flex gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input class="w-full focus:outline-none" type="text" name="search" placeholder="Search Cashier...">
    </div>
    <button id="delete-all" class="flex gap-2 px-3 py-2 bg-red-500 rounded-md items-center text-white text-sm tracking-tight cursor-pointer hover:bg-red-600 transition-all duration-300 font-medium border-b-5 border-b-red-800 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
        </svg>
        DELETE ALL
    </button>
</div>
<div>

</div>
<table class="table-auto w-full mb-5">
    <thead>
        <tr class="text-zinc-400 *:text-sm *:text-start">
            <th class="border-b border-b-zinc-300 p-2 w-10"><input type="checkbox" name="select_all" id="select-all"></th>
            <th class="border-b border-b-zinc-300 p-2 w-10">No</th>
            <th class="border-b border-b-zinc-300 p-2">Name</th>
            <th class="border-b border-b-zinc-300 p-2">Status</th>
            <th class="border-b border-b-zinc-300 p-2">Join At</th>
            <th class="border-b border-b-zinc-300 p-2 w-fit" colspan="2">Action</th>
        </tr>
    </thead>
    <tbody id="cashiers-table-body">
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr class="**:text-sm">
                <td class="border-b border-b-zinc-300 p-2 w-10"><input type="checkbox" name="id" id="checkbox-cashier-id" value="<?= $row['id'] ?>"></td>
                <td class="border-y border-y-zinc-300 p-2 text-zinc-400"><?= $no++ ?></td>
                <td class="border-y border-y-zinc-300 p-2"><?= $row['name'] ?></td>
                <td class="border-b border-b-zinc-300 p-2">
                    <div class="flex gap-2 items-center">
                        <?php if ($row['status'] == 1): ?>
                            <div class="rounded-full w-2 h-2 bg-green-500 outline-2 outline-green-200"></div>
                            Active
                        <?php else: ?>
                            <div class="rounded-full w-2 h-2 bg-red-500 outline-2 outline-red-200"></div>
                            Inactive
                        <?php endif ?>
                    </div>
                </td>
                <td class="border-y border-y-zinc-300 p-2"><?= timeAgo($row['created_at']) ?></td>
                <td class="border-y border-y-zinc-300 p-2 w-18 whitespace-nowrap text-center">
                    <button class="transition-all duration-300 hover:bg-yellow-600 cursor-pointer bg-yellow-500 px-2 py-1 rounded-sm text-sm btn-update-cashier" data-id="<?= $row['id'] ?>">Edit</a>
                </td>
                <td class="border-y border-y-zinc-300 p-2 w-20 whitespace-nowrap text-center">
                    <form action="/indomaret/process/cashier_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="cashier-id" value="<?= $row['id'] ?>">
                        <button type="submit" class="transition-all duration-300 hover:bg-red-800 cursor-pointer bg-red-500 px-2 py-1 rounded-sm text-white text-sm">Delete</a>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div id="modal" class="bg-[rgba(0,0,0,0.5)] fixed top-0 left-0 w-full h-full grid place-content-center hidden">
    <form action="/indomaret/process/cashier_process.php" method="post" class="bg-white flex flex-col w-fit p-4 rounded-md">
        <h1 id="modal-label" class="font-medium text-2xl mb-[16px]">Add Cashier</h1>
        <input id="action" type="hidden" name="action" value="add">
        <input id="cashier-id" type="hidden" name="cashier-id" value="">
        <label for="name" class="font-medium mb-[8px]">Name</label>
        <input class="md:w-md w-xs p-2 border border-zinc-400 rounded-sm" type="text" name="name" id="cashier-name" value="" placeholder="Cashier Name">
        <label for="status" class="font-medium mb-[8px]">Name</label>
        <select name="status" id="cashier-status" class="border border-zinc-400 p-2 rounded-sm">
            <option value="1">
                Active
            </option>
            <option value="0">
                Inactive
            </option>
        </select>
        <div class="flex justify-end gap-2 mt-[16px]">
            <button class="px-3 py-2 bg-zinc-300 rounded-md items-center text-black text-sm tracking-tight cursor-pointer hover:bg-zinc-400 transition-all duration-300" id="btn-close-modal" type="button">Cancel</button>
            <button class="px-3 py-2 bg-blue-500 rounded-md items-center text-white text-sm tracking-tight cursor-pointer hover:bg-blue-600 transition-all duration-300" id="modal-btn" type="submit">Add</button>
        </div>
    </form>
</div>

<?php require_once ROOTPATH . "/includes/footer.php"; ?>
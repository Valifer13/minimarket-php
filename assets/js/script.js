import { timeAgo } from "./utils.js";

let App = {
    common: {
        init: function () {
            console.log("Common script is running on all pages");
            const $btnSidebar = $('#btn-sidebar');
            const $sidebar = $('#sidebar');

            // Sidebar toggle
            if ($btnSidebar.length) {
                const $btnSidebarChilds = $btnSidebar.children();

                $btnSidebar.on("click", function () {
                    $sidebar.toggleClass("-translate-x-full");
                    $btnSidebar.toggleClass("active");

                    if ($btnSidebar.hasClass("active")) {
                        $btnSidebarChilds.eq(0).addClass("rotate-45 translate-y-1");
                        $btnSidebarChilds.eq(1).addClass("hidden");
                        $btnSidebarChilds.eq(2).addClass("-rotate-45 -translate-y-0.5");
                        $('#sidebar-mobile').removeClass('-translate-x-full');
                    } else {
                        $btnSidebarChilds.eq(0).removeClass("rotate-45 translate-y-1");
                        $btnSidebarChilds.eq(1).removeClass("hidden");
                        $btnSidebarChilds.eq(2).removeClass("-rotate-45 -translate-y-0.5");
                        $('#sidebar-mobile').addClass('-translate-x-full');
                    }
                });
            }
        }
    },
    cashiers: {
        init: function () {
            console.log("Cashiers script currently running")
            $(document).on('click', '.btn-update-cashier', function () {
                $('#modal-label').html('Edit Cashier');
                $('#modal-btn').html('Update');
                $('#action').val('update');
                $('#modal').removeClass("hidden");
                $('#modal').addClass("grid");
                $('body').addClass("overflow-hidden");

                const id = $(this).data('id');

                $.ajax({
                    url: 'http://localhost/pos-minimarket/pages/cashiers/edit.php',
                    data: { id: id },
                    method: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        $('#cashier-id').val(data.id);
                        $('#cashier-name').val(data.name);
                        $('#cashier-status').val(data.status);
                    }
                })
            })


            const $btnCloseModal = $("#btn-close-modal");
            const $btnAddCashier = $("#btn-add-cashier");
            const $Modal = $("#modal");

            // Cashier Feature
            const $btnDeleteAll = $("#delete-all");
            const $checkboxSelectAll = $("#select-all");
            const $cashiersTableBody = $("#cashiers-table-body");

            // Checkbox select all
            $checkboxSelectAll.on("change", function () {
                const checked = $(this).prop("checked");
                $cashiersTableBody.find('input[name="id"]').prop('checked', checked);
                toggleBtnDeleteAll();
            });

            // Checkbox every row
            $cashiersTableBody.on('change', 'input[name="id"]', function () {
                const total = $cashiersTableBody.find('input[name="id"]').length;
                const checked = $cashiersTableBody.find('input[name="id"]:checked').length;
                $checkboxSelectAll.prop('checked', total === checked);
                toggleBtnDeleteAll();
            })

            // Show / hide delete all button
            function toggleBtnDeleteAll() {
                const anyChecked = $cashiersTableBody.find('input[name="id"]:checked').length > 0;
                $btnDeleteAll.toggleClass('hidden', !anyChecked);
            }

            // Reindex the table number
            function reindexTable() {
                $('#cashiers-table-body tr').each(function (index) {
                    $(this).find('td:eq(1)').text(index + 1);
                })
            }

            function loadData(keyword = "") {
                $.ajax({
                    url: "/pos-minimarket/pages/cashiers/search.php",
                    method: "POST",
                    dataType: "json",
                    data: { ajax: 1, search: keyword },
                    success: function (datas) {
                        let html = ``;

                        if (datas.length == 0) {
                            html += `
                        <tr class="**:text-md font-medium">
                            <td colspan="6" class="border-y border-y-zinc-300 p-2 text-center">No cashiers found</td>
                        </tr>
                    `;
                        }

                        datas.forEach((data, i) => {
                            html += `
                        <tr class="**:text-sm">
                            <td class="border-b border-b-zinc-300 p-2 w-10"><input type="checkbox" name="id" id="checkbox-cashier-id" value="${data.id}"></td>
                            <td class="border-y border-y-zinc-300 p-2 text-zinc-400">${i + 1}</td>
                            <td class="border-y border-y-zinc-300 p-2">${data.name}</td>
                            <td class="border-b border-b-zinc-300 p-2">
                                <div class="flex gap-2 items-center">
                                    ${data.status == 1 ? '<div class="rounded-full w-2 h-2 bg-green-500 outline-2 outline-green-200"></div> Working' : '<div class="rounded-full w-2 h-2 bg-red-500 outline-2 outline-red-200"></div> Fired'}
                                </div>
                            </td>
                            <td class="border-y border-y-zinc-300 p-2">${timeAgo(data.created_at)}</td>
                            <td class="border-y border-y-zinc-300 p-2 w-18 whitespace-nowrap text-center">
                                <button class="transition-all duration-300 hover:bg-yellow-600 cursor-pointer bg-yellow-500 px-2 py-1 rounded-sm text-sm btn-update-cashier" data-id="${data.id}">Edit</a>
                            </td>
                            <td class="border-y border-y-zinc-300 p-2 w-20 whitespace-nowrap text-center">
                                <form action="/pos-minimarket/process/cashier_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="cashier-id" value="${data.id}">
                                    <button type="submit" class="transition-all duration-300 hover:bg-red-800 cursor-pointer bg-red-500 px-2 py-1 rounded-sm text-white text-sm">Delete</a>
                                </form>
                            </td>
                        </tr>
                    `;
                        });
                        $cashiersTableBody.html(html);
                    }
                })
            }

            loadData();

            $('#search-keyword').on('keyup', function () {
                let keyword = $(this).val();
                loadData(keyword);
            })

            // Click delete all button
            $btnDeleteAll.on('click', function () {
                const ids = $cashiersTableBody.find('input[name="id"]:checked').map(function () {
                    return $(this).val();
                }).get();

                if (ids.length === 0) return;

                console.log(ids);

                if (confirm("Are you sure you want delete selected cashiers?")) {
                    $.ajax({
                        url: "/pos-minimarket/process/cashier_process.php",
                        method: "POST",
                        data: {
                            action: "delete-multiple",
                            ids: ids
                        },
                        success: function (response) {
                            $cashiersTableBody.find('input[name="id"]:checked').closest("tr").remove();

                            reindexTable();

                            $btnDeleteAll.addClass('hidden');
                            $checkboxSelectAll.prop('checked', false);

                            alert("Selected cashiers deleted successfully!");
                        },
                        error: function (xhr, status, error) {
                            location.reload();
                            console.log(error);
                            alert("Error deleting cashiers: " + error);
                        }
                    })
                }
            })

            // Open modal
            $btnAddCashier.on("click", function () {
                console.log('btn add ok');
                $('#modal-label').html('Add Cashier');
                $('#modal-btn').html('Add')
                $('#action').val('add');
                $('#cashier-id').val('');
                $Modal.removeClass("hidden");
                $Modal.addClass("grid");
                $('body').addClass("overflow-hidden");
            });

            // Close modal
            $btnCloseModal.on("click", function () {
                $Modal.addClass("hidden");
                $Modal.removeClass("grid");
                $('body').removeClass("overflow-hidden");
            });

            $('#delete-all').on('mousedown', function () {
                $(this).removeClass('border-b-5');
                setTimeout(() => {
                    $(this).addClass('border-b-5');
                }, 100)
            })
        }
    },
    products: {
        init: function () {
            console.log("Script for products page is running");
        }
    },
    customers: {
        init: function() {
            console.log("Customers script currently running")
        }
    },
    purchases: {
        init: function() {
            console.log("Purchases script currently running")
        }
    },
    sales: {
        init: function() {
            console.log("sales script currently running")
        }
    },
    suppliers: {
        init: function() {
            console.log("Suppliers script currently running")
        }
    },
    vouchers: {
        init: function() {
            console.log("Vouchers script currently running")
        }
    },
}

$(function () {
    App.common.init();

    let page = $("#name-page").data("page");
    if (App[page] && typeof App[page].init() === "function") {
        App[page].init();
    }
})
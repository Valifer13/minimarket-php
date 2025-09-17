$(document).ready(function () {
    const $btnSidebar = $("#btn-sidebar");
    const $sidebar = $("#sidebar");
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
    $cashiersTableBody.on('change', 'input[name="id"]', function() {
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

    // Click delete all button
    $btnDeleteAll.on('click', function() {
        const ids = $cashiersTableBody.find('input[name="id"]:checked').map(function() {
            return $(this).val();
        }).get();

        if (ids.length === 0) return;

        if (confirm("Are you sure you want delete selected cashiers?")) {
            $.ajax({
                url: "/indomaret/process/cashier_process.php",
                method: "post",
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
                    alert("Error deleting cashiers: " + error);
                }
            })
        }
    })

    // Sidebar toggle
    if ($btnSidebar.length) {
        const $btnSidebarChilds = $btnSidebar.children();

        $btnSidebar.on("click", function () {
            $sidebar.toggleClass("translate-x-full");
            $btnSidebar.toggleClass("active");

            if ($btnSidebar.hasClass("active")) {
                $btnSidebarChilds.eq(0).addClass("rotate-45 translate-y-1");
                $btnSidebarChilds.eq(1).addClass("hidden");
                $btnSidebarChilds.eq(2).addClass("-rotate-45 -translate-y-0.5");
            } else {
                $btnSidebarChilds.eq(0).removeClass("rotate-45 translate-y-1");
                $btnSidebarChilds.eq(1).removeClass("hidden");
                $btnSidebarChilds.eq(2).removeClass("-rotate-45 -translate-y-0.5");
            }
        });
    }

    // Open modal
    $btnAddCashier.on("click", function () {
        $('#modal-label').html('Add Cashier');
        $('#modal-btn').html('Add')
        $('#action').val('add');
        $('#cashier-id').val('');
        $Modal.removeClass("hidden");
        $('body').addClass("overflow-hidden");
    });

    // Close modal
    $btnCloseModal.on("click", function () {
        $Modal.addClass("hidden");
        $('body').removeClass("overflow-hidden");
    });

    $('.btn-update-cashier').on("click", function () {
        $('#modal-label').html('Edit Cashier');
        $('#modal-btn').html('Update');
        $('#action').val('update');
        $Modal.removeClass("hidden");

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/indomaret/pages/cashiers/edit.php',
            data: {id: id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#cashier-id').val(data.id);
                $('#cashier-name').val(data.name);
                $('#cashier-status').val(data.status);
            }
        })
    })

    $('#delete-all').on('mousedown', function() {
        $(this).removeClass('border-b-5');
        setTimeout(() => {
            $(this).addClass('border-b-5');
        }, 100)
    })
});

export function initCashiers() {
    const $checkboxSelectAll = $("#select-all");
    const $cashiersTableBody = $("#cashiers-table-body");

    console.log("Cashier page ready")

    // Open modal cashiers
    $(document).on('click', '.btn-update-cashier', function () {
        $('#modal-label').html('Edit Cashier');
        $('#modal-btn').html('Update');
        $('#action').val('update');
        $('#modal').removeClass("hidden");
        $('#modal').addClass("grid");
        $('body').addClass("overflow-hidden");

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/indomaret/pages/cashiers/edit.php',
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

    // Checkbox select all
    $checkboxSelectAll.on("change", function () {
        const checked = $(this).prop("checked");
        $cashiersTableBody.find('input[name="id"]').prop('checked', checked);
        toggleBtnDeleteAll();
    });
}
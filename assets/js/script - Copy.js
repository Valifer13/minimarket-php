const btnSidebar = document.querySelector("#btn-sidebar");
const sidebar = document.querySelector("#sidebar");
const btnCloseModal = document.querySelector("#btn-close-modal");
const btnAddCashier = document.querySelector("#btn-add-cashier");
const insertModal = document.querySelector("#insert-modal");
const checkboxSelectAll = document.getElementById("select-all");
const cashiersTableBody = document.getElementById("cashiers-table-body");

checkboxSelectAll?.addEventListener('change', () => {
    const checkboxes = cashiersTableBody.querySelectorAll('input[type="checkbox"][name="id"]');
    checkboxes.forEach(cb => cb.checked = checkboxSelectAll.checked);
})

if (btnSidebar) {
    const btnSidebarChilds = btnSidebar.children;
    btnSidebar.onclick = () => {
        sidebar.classList.toggle('translate-x-full');
        btnSidebar.classList.toggle('active');

        if (btnSidebar.classList.contains('active')) {
            btnSidebarChilds[0].classList.add('rotate-45')
            btnSidebarChilds[0].classList.add('translate-y-1')
            btnSidebarChilds[1].classList.add('hidden')
            btnSidebarChilds[2].classList.add('-rotate-45')
            btnSidebarChilds[2].classList.add('-translate-y-0.5')
        } else {
            btnSidebarChilds[0].classList.remove('rotate-45')
            btnSidebarChilds[0].classList.remove('translate-y-1')
            btnSidebarChilds[1].classList.remove('hidden')
            btnSidebarChilds[2].classList.remove('-rotate-45')
            btnSidebarChilds[2].classList.remove('-translate-y-0.5')
        }
    }
}

btnAddCashier?.addEventListener('click', () => {
    insertModal.classList.remove("hidden");
})

btnCloseModal?.addEventListener('click', () => {
    insertModal.classList.add("hidden");
})
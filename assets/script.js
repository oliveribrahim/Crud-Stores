// Add New Store Modal
const modal = document.getElementById("formModal");
const btn = document.getElementById("openFormBtn");
const closeBtn = document.querySelector(".close-btn");

btn.onclick = function () {
    modal.style.display = "block";
}

if (closeBtn) {
    closeBtn.onclick = function () {
        modal.style.display = "none";
    }
}

// Edit Store Modal
const editModal = document.getElementById("editModal");
const closeBtnEdit = document.querySelector(".close-btn-edit");

function openEditModal(id, name, category, market_value) {
    // Pre-fill the form fields with existing data
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_category").value = category;
    document.getElementById("edit_market_value").value = market_value;
    // Show the edit modal
    editModal.style.display = "block";
}

if (closeBtnEdit) {
    closeBtnEdit.onclick = function () {
        editModal.style.display = "none";
    }
}

// Close modals when clicking outside of them
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
    if (event.target === editModal) {
        editModal.style.display = "none";
    }
}


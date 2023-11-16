import Swal from "sweetalert2";

const button = document.getElementById("createUserBtn");
const form = document.getElementById("createUserForm");

button.addEventListener("click", () => {
    form.classList.remove("d-none");
    Swal.fire({
        title: "<strong>Create User</strong>",
        html: form,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
    });
});

import Swal from "sweetalert2";

const button = document.getElementById("changePasswordBtn");
const form = document.getElementById("changePasswordForm");

button.addEventListener("click", () => {
    form.classList.remove("d-none");
    Swal.fire({
        title: "<strong>Change Password</strong>",
        html: form,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
    });
});

import Swal from "sweetalert2";

const passwordButton = document.getElementById("changePasswordBtn");
const passwordForm = document.getElementById("changePasswordForm");

const emailButton = document.getElementById("changeEmailBtn");
const emailForm = document.getElementById("changeEmailForm");

passwordButton.addEventListener("click", () => {
    passwordForm.classList.remove("d-none");
    Swal.fire({
        title: "<strong>Change Password</strong>",
        html: passwordForm,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
    });
});

emailButton.addEventListener("click", () => {
    emailForm.classList.remove("d-none");
    Swal.fire({
        title: "<strong>Change Email</strong>",
        html: emailForm,
        showCloseButton: true,
        showConfirmButton: false,
        showCancelButton: false,
    });
});

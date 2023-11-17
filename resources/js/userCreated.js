import Swal from "sweetalert2";

const html = document.getElementById('creation');
const newPasswordInput = document.getElementById('newPasswordInput');
const newPasswordToggler = document.getElementById('newPasswordToggler');
const copyPasswordBtn = document.getElementById('copyPasswordBtn');

html.classList.remove("d-none");
html.classList.add("d-flex", "text-start", "p-4")

newPasswordToggler.style.cursor = "pointer";
copyPasswordBtn.style.cursor = "pointer";

copyPasswordBtn.addEventListener('click', () => {

    copyPasswordBtn.innerHTML = "Copied <i class='fa-solid fa-check'></i>";
    navigator.clipboard.writeText(newPasswordInput.value);

});

newPasswordToggler.addEventListener('click', () => {

    let currentType = newPasswordInput.type;

    if(currentType == "password") {
        newPasswordInput.type = "text";
        newPasswordToggler.classList.remove("fa-eye");
        newPasswordToggler.classList.add("fa-eye-slash");
    } else {
        newPasswordInput.type = "password";
        newPasswordToggler.classList.remove("fa-eye-slash");
        newPasswordToggler.classList.add("fa-eye");
    }

});

Swal.fire({
    title: "User created",
    icon: "success",
    html: html,
    showCloseButton: false,
    showConfirmButton: true,
    showCancelButton: false,
    confirmButtonColor: "#D83787",
    confirmButtonText: "Close"
});
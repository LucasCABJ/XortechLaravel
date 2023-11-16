import Swal from "sweetalert2";

const html = document.getElementById('creation');

html.classList.remove("d-none");

Swal.fire({
    title: "User created",
    icon: "success",
    html: html,
    showCloseButton: false,
    showConfirmButton: true,
    showCancelButton: false,
});

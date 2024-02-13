import Swal from "sweetalert2";

const button = document.getElementById("profilepic-container");
const form = document.getElementById("profilepic-upload-form");

button.addEventListener("click", () => {
    form.classList.remove("d-none");
    Swal.fire({
        title: "<strong>Update Profile Picture</strong>",
        html: form,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
    });
});

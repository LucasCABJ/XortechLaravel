import Swal from "sweetalert2";

document.addEventListener('DOMContentLoaded', function() {
    const errorMessageDiv = document.getElementById('errorMessage');

    // Verifica si se encontró el elemento con el ID 'errorMessage' en el DOM
    if (errorMessageDiv) {
        const errorMessage = errorMessageDiv.dataset.error;

        // Verifica si hay un mensaje de error para mostrar
        if (errorMessage) {
            // Muestra el mensaje de error en SweetAlert2
            Swal.fire({
                icon: 'error',
                title: errorMessage,
            });
        }
    }
});

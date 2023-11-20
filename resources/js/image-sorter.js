import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', function () {
    var dropIndex;

    // Encuentra el contenedor HTML que deseas hacer sortable
    const sortableList = document.getElementById('image-list-product');

    // Inicializa sortablejs en el contenedor
    new Sortable(sortableList, {
        onUpdate: function (evt) {
            // Se ejecuta cuando se actualiza el orden de la lista
            dropIndex = evt.newIndex;
        },
    });

    // Encuentra el botón de envío
    const submitButton = document.getElementById('submit-product-images');

    // Asigna un evento click al botón de envío
    submitButton.addEventListener('click', function (e) {
        // Se ejecuta cuando se hace clic en el botón de envío

        var imageIdsArray = [];

        // Itera sobre cada elemento de la lista de imágenes
        sortableList.querySelectorAll('li').forEach(function (element, index) {
            var id = element.getAttribute('id');
            var split_id = id.split('_');
            imageIdsArray.push(split_id[1]);
        });

        // Envía una solicitud AJAX al servidor
        fetch('/product/image/reorder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Asegúrate de incluir el token CSRF adecuadamente
            },
            body: JSON.stringify({
                data: imageIdsArray,
                id: window.location.pathname.substring(21, window.location.pathname.length),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                // Se ejecuta si la solicitud AJAX tiene éxito
                console.log({ data });

                if (data.redirect) {
                    // Redirige a la nueva página especificada en la respuesta
                    window.location = data.redirect;
                }
            })
            .catch((error) => {
                // Se ejecuta si la solicitud AJAX falla
                console.error('Error:', error);
            });

        e.preventDefault();
        // Previene el comportamiento predeterminado del botón (por ejemplo, enviar un formulario)
    });
});

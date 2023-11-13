// script.js
$(document).ready(function () {
    // Obtener el elemento de input y los botones
    var quantity = $('#quantity');
    var incrementButton = $('#increment');
    var decrementButton = $('#decrement');

    // Aumentar la cantidad al hacer clic en el botón de incremento
    incrementButton.click(function () {
        quantity.val(parseInt(quantity.val()) + 1);
    });

    // Disminuir la cantidad al hacer clic en el botón de decremento
    decrementButton.click(function () {
        var currentValue = parseInt(quantity.val());
        if (currentValue > 1) {
            quantity.val(currentValue - 1);
        }
    });
});

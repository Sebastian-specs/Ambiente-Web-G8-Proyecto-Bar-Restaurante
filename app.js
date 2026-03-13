$(document).ready(function () {
    $('#formReserva').on('submit', function () {
        const personas = parseInt($('input[name="personas"]').val(), 10);
        if (personas <= 0 || isNaN(personas)) {
            alert('La cantidad de personas debe ser mayor a 0.');
            return false;
        }
    });
});
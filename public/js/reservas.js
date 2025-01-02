function toggleFechaVuelta() {
    const checkbox = document.getElementById('soloIda');
    const fechaVuelta = document.getElementById('fecha_vuelta');

    if (checkbox.checked) {
        fechaVuelta.style.display = 'none'; // Ocultar
    } else {
        fechaVuelta.style.display = ''; // Mostrar
    }
}

function toggleNumAsiento() {
    const checkbox = document.getElementById('asientoAleatorio');
    const inputAsiento = document.getElementById('asiento');

    if (checkbox.checked) {
        // asiento.style.visibility = 'hidden'; // Ocultar
        inputAsiento.disabled = true;
    } else {
        // asiento.style.visibility = ''; // Mostrar
        inputAsiento.disabled = false;
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('soloIda');
    checkbox.addEventListener('change', toggleFechaVuelta);
    toggleFechaVuelta();

    const checkbox2 = document.getElementById('asientoAleatorio');
    checkbox2.addEventListener('change', toggleNumAsiento);
    toggleNumAsiento();
});
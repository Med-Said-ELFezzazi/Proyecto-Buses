function toggleFechaVuelta() {
    const checkbox = document.getElementById('soloIda');
    const fechaVuelta = document.getElementById('fecha_vuelta');

    if (checkbox.checked) {
        fechaVuelta.style.display = 'none'; // Ocultar
    } else {
        fechaVuelta.style.display = ''; // Mostrar
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('soloIda');
    checkbox.addEventListener('change', toggleFechaVuelta);
    toggleFechaVuelta();
});
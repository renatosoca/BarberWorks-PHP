document.addEventListener('DOMContentLoaded', function() {
    iniciarAPP();
});

function iniciarAPP() {
    buscarXfecha();
}

function buscarXfecha() {
    const fecha = document.querySelector('#fecha');
    fecha.addEventListener('input', (e) => {
        const fechaSeleccionada = e.target.value;

        window.location = `?date=${fechaSeleccionada}`;
    })
}
let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); //llamamos la 1ra sección con el "paso = 1"
    tabs(); //Cambiar de sección
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();
}

function mostrarSeccion() {
    //Para ocultar una de las secciones anteriores
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    //Mostrar una de las secciones
    const seccion = document.querySelector( `#paso-${paso}` );
    seccion.classList.add('mostrar');

    //Despintar la Navegación anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    //Pintar la Navegación segun la seccion
    const tab = document.querySelector(`[data-paso='${paso}']`);
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton => {
        boton.addEventListener('click', (e) => {
            paso = parseInt( e.target.dataset.paso );

            mostrarSeccion();

            botonesPaginador();
        })
    });
}

function botonesPaginador() {
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaSiguiente.classList.add('ocultar');
        paginaAnterior.classList.remove('ocultar')
    }else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar')
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        if (paso <= pasoInicial) return;
        paso--;

        botonesPaginador();
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        if (paso >= pasoFinal) return;
        paso++;

        botonesPaginador();
    })
}

async function consultarAPI() {
    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios( servicios )
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios( servicios ) {
    servicios.forEach( servicio => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('p');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('p');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = precio;

        const servicioDiv = document.createElement('div');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionarServicio(servicio)
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    const {servicios} = cita;

    //copio el arreglo y le agrego el nuevo objeto
    cita.servicios = [...servicios, servicio];

    console.log(cita);
}
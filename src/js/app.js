let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
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

    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();

    mostrarResumenCita();
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
        paginaAnterior.classList.remove('ocultar');

        mostrarResumenCita();
    }else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
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
    const { id } = servicio;
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //comprobar si un servicio ya fue agregado
    if (servicios.some( agregado => agregado.id === id )) {
        //eliminar un servicio
        cita.servicios = servicios.filter( agregado => agregado.id !== id );
        divServicio.classList.remove('seleccionado');
    } else {
        //copio el arreglo y le agrego un nuevo servicio
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }
}

function idCliente() {
    cita.id = document.querySelector('#id').value;    
}

function nombreCliente() {
    const nombre = document.querySelector('#nombre').value;

    cita.nombre = nombre;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', (e) => { 
        const dia = new Date(e.target.value).getUTCDay();

        if ([6, 0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('fines de semana no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, elemento, ocultar = true) {

    //Prevenir que se muestre más de una alerta
    const alertaPrevia = document.querySelector('.alertas')
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    //Creando la alerta
    const alerta = document.createElement('div');
    alerta.textContent = mensaje;
    alerta.classList.add('alertas');
    alerta.classList.add(tipo);

    const divFormulacio = document.querySelector(elemento);
    divFormulacio.appendChild(alerta);

    if (ocultar) {
        //elimando la alerta
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', (e) => { 
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];

        if (hora < 10 || hora > 18 ) {
            e.target.value = '';
            mostrarAlerta('Hora no disponible', 'error', '.formulario')
        } else {
            cita.hora = e.target.value;
        }
    });
}

function mostrarResumenCita() {
    const resumen = document.querySelector('.contenido-resumen');

    //limpiar el contenido de resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan Datos de Servicio, Fecha u Hora', 'error', '.contenido-resumen', false);
        
        return;
    }

    //Mostrando los elementos en Resumen
    const {nombre, fecha, hora, servicios} = cita;
    //Cabecera para los Servicios
    const headServicios = document.createElement('H3')
    headServicios.textContent = 'Resumen de los Servicios';
    resumen.appendChild(headServicios);

    servicios.forEach( servicio => {
        const {id, nombre, precio} = servicio;

        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> ${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    //Cabecera para las Citas
    const headCitas = document.createElement('H3')
    headCitas.textContent = 'Resumen de los Citas';
    resumen.appendChild(headCitas);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;

    //Formatear Fecha a Español
    const FechaObj = new Date(fecha);
    const mes = FechaObj.getMonth();
    const dia = FechaObj.getDate() + 2;
    const año = FechaObj.getFullYear();

    const FechaUTC = new Date( Date.UTC(año, mes, dia));

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    const FechaFormateada = FechaUTC.toLocaleDateString('es-ES', opciones)

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha: </span> ${FechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora: </span> ${hora}`;

    //Boton para crear un cita
    const botonReservar = document.createElement('button');
    botonReservar.classList.add('btn');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;
    
    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    resumen.appendChild(botonReservar);
}

async function reservarCita() {
    const datos = new FormData();
    const {id, nombre, fecha, hora, servicios} = cita;

    const idServicio = servicios.map(servicio => servicio.id);

    datos.append('usuarioId', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicio);
    
    try {
        //consultando API
        const url = 'http://localhost:3000/api/citas';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();

        if (resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu Cita fue Creada correctamente!',
                button: 'Ok'
            }).then( () => {
                window.location.reload();
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita',
            button: 'Ok'
          })
    }
    /* console.log([...datos]); Para ver los datos del FormData() */
}
let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
  id: "",
  nombre: "",
  fecha: "",
  hora: "",
  servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
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
  const seccionAnterior = document.querySelector(".mostrar");
  if (seccionAnterior) {
    seccionAnterior.classList.remove("block", "mostrar");
    seccionAnterior.classList.add("hidden");
  }

  //Mostrar una de las secciones
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add("block", "mostrar");
  seccion.classList.remove("hidden");

  //Despintar la Navegación anterior
  const tabAnterior = document.querySelector(".actual");
  if (tabAnterior) {
    tabAnterior.classList.remove("bg-blue-500", "text-white", "actual");
    tabAnterior.classList.add("bg-blue-300", "text-black");
  }

  //Pintar la Navegación segun la seccion, este es el Siguiente
  const tab = document.querySelector(`[data-paso='${paso}']`);
  tab.classList.remove("bg-blue-300", "text-black");
  tab.classList.add("bg-blue-500", "text-white", "actual");
}

function tabs() {
  const botones = document.querySelectorAll("#containers-taps button");
  botones.forEach((boton) => {
    boton.addEventListener("click", (e) => {
      paso = parseInt(e.target.dataset.paso);

      mostrarSeccion();

      botonesPaginador();
    });
  });
}

function botonesPaginador() {
  const paginaSiguiente = document.querySelector("#toContinue");
  const paginaAnterior = document.querySelector("#toGoBack");

  if (paso === 1) {
    paginaAnterior.classList.add("opacity-0", "cursor-not-allowed");
    paginaSiguiente.classList.remove("opacity-0", "cursor-not-allowed");
  } else if (paso === 3) {
    paginaSiguiente.classList.add("opacity-0", "cursor-not-allowed");
    paginaAnterior.classList.remove("opacity-0", "cursor-not-allowed");

    mostrarResumenCita();
  } else {
    paginaAnterior.classList.remove("opacity-0", "cursor-not-allowed");
    paginaSiguiente.classList.remove("opacity-0", "cursor-not-allowed");
  }

  mostrarSeccion();
}

function paginaAnterior() {
  const paginaAnterior = document.querySelector("#toGoBack");
  paginaAnterior.addEventListener("click", () => {
    if (paso <= pasoInicial) return;
    paso--;

    botonesPaginador();
  });
}

function paginaSiguiente() {
  const paginaSiguiente = document.querySelector("#toContinue");
  paginaSiguiente.addEventListener("click", () => {
    if (paso >= pasoFinal) return;
    paso++;

    botonesPaginador();
  });
}

async function consultarAPI() {
  try {
    const url = "http://localhost:3000/api/v1/services";
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);
  } catch (error) {
    console.log(error);
  }
}

function mostrarServicios(services) {
  const containerServices = document.querySelector("#services");

  services.forEach((service) => {
    const { id, title, price } = service;

    const buttonService = document.createElement("button");
    buttonService.classList =
      "bg-[#001E3C] col-span-6 w-full overflow-hidden rounded";
    buttonService.dataset.idServicio = id;
    buttonService.onclick = function () {
      seleccionarServicio(service);
    };

    const containerService = document.createElement("div");
    containerService.classList =
      "w-full py-8 px-4 text-center hover:scale-110 transition-transform duration-200";

    const titleService = document.createElement("h3");
    titleService.classList = "font-medium text-xl text-white";
    titleService.textContent = title;

    const priceService = document.createElement("p");
    priceService.classList = "text-3xl font-bold text-[#64B5F6]";
    priceService.textContent = `S/ ${price}`;

    containerService.appendChild(titleService);
    containerService.appendChild(priceService);
    buttonService.appendChild(containerService);

    containerServices.appendChild(buttonService);
  });
}

function seleccionarServicio(servicio) {
  const { id } = servicio;
  const { servicios } = cita;
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

  //comprobar si un servicio ya fue agregado
  if (servicios.some((agregado) => agregado.id === id)) {
    //eliminar un servicio
    cita.servicios = servicios.filter((agregado) => agregado.id !== id);
    divServicio.classList.remove("bg-[#103759]");
  } else {
    //copio el arreglo y le agrego un nuevo servicio
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add("bg-[#103759]");
  }
}

function idCliente() {
  cita.id = document.querySelector("#userId").value;
}

function nombreCliente() {
  const nombre = document.querySelector("#name").value;

  cita.nombre = nombre;
}

function seleccionarFecha() {
  const inputFecha = document.querySelector("#date");
  inputFecha.addEventListener("input", (e) => {
    const dia = new Date(e.target.value).getUTCDay();

    if ([6, 0].includes(dia)) {
      e.target.value = "";
      mostrarAlerta("fines de semana no permitidos", "error", ".formulario");
    } else {
      cita.fecha = e.target.value;
    }
  });
}

function mostrarAlerta(mensaje, tipo, elemento, ocultar = true) {
  //Prevenir que se muestre más de una alerta
  const alertaPrevia = document.querySelector(".alertas");
  if (alertaPrevia) {
    alertaPrevia.remove();
  }

  //Creando la alerta
  const alerta = document.createElement("div");
  alerta.textContent = mensaje;
  alerta.classList.add("alertas");
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
  const inputHora = document.querySelector("#time");
  inputHora.addEventListener("input", (e) => {
    const horaCita = e.target.value;
    const hora = horaCita.split(":")[0];

    if (hora < 10 || hora > 18) {
      e.target.value = "";
      mostrarAlerta("Hora no disponible", "error", ".formulario");
    } else {
      cita.hora = e.target.value;
    }
  });
}

function mostrarResumenCita() {
  const resumen = document.querySelector("#paso-3");

  //limpiar el contenido de resumen
  while (resumen.firstChild) {
    resumen.removeChild(resumen.firstChild);
  }

  if (Object.values(cita).includes("") || cita.servicios.length === 0) {
    mostrarAlerta(
      "Faltan Datos de Servicio, Fecha u Hora",
      "error",
      ".contenido-resumen",
      false
    );

    return;
  }

  //Mostrando los elementos en Resumen
  const { nombre, fecha, hora, servicios } = cita;
  //Cabecera para los Servicios
  const headServicios = document.createElement("H3");
  headServicios.textContent = "Resumen de los Servicios";
  resumen.appendChild(headServicios);

  servicios.forEach((servicio) => {
    const { id, nombre, precio } = servicio;

    const contenedorServicio = document.createElement("DIV");
    contenedorServicio.classList.add("contenedor-servicio");

    const textoServicio = document.createElement("P");
    textoServicio.textContent = nombre;

    const precioServicio = document.createElement("P");
    precioServicio.innerHTML = `<span>Precio: </span> ${precio}`;

    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);

    resumen.appendChild(contenedorServicio);
  });

  //Cabecera para las Citas
  const headCitas = document.createElement("H3");
  headCitas.textContent = "Resumen de los Citas";
  resumen.appendChild(headCitas);

  const nombreCliente = document.createElement("P");
  nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;

  //Formatear Fecha a Español
  const FechaObj = new Date(fecha);
  const mes = FechaObj.getMonth();
  const dia = FechaObj.getDate() + 2;
  const año = FechaObj.getFullYear();

  const FechaUTC = new Date(Date.UTC(año, mes, dia));

  const opciones = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  const FechaFormateada = FechaUTC.toLocaleDateString("es-ES", opciones);

  const fechaCita = document.createElement("P");
  fechaCita.innerHTML = `<span>Fecha: </span> ${FechaFormateada}`;

  const horaCita = document.createElement("P");
  horaCita.innerHTML = `<span>Hora: </span> ${hora}`;

  //Boton para crear un cita
  const botonReservar = document.createElement("button");
  botonReservar.classList.add("btn");
  botonReservar.textContent = "Reservar Cita";
  botonReservar.onclick = reservarCita;

  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
  resumen.appendChild(botonReservar);
}

async function reservarCita() {
  const datos = new FormData();
  const { id, nombre, fecha, hora, servicios } = cita;

  const idServicio = servicios.map((servicio) => servicio.id);

  datos.append("usuarioId", id);
  datos.append("fecha", fecha);
  datos.append("hora", hora);
  datos.append("servicios", idServicio);

  try {
    //consultando API
    const url = "http://localhost:3000/api/citas";
    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });
    const resultado = await respuesta.json();

    if (resultado.resultado) {
      Swal.fire({
        icon: "success",
        title: "Cita Creada",
        text: "Tu Cita fue Creada correctamente!",
        button: "Ok",
      }).then(() => {
        window.location.reload();
      });
    }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Hubo un error al guardar la cita",
      button: "Ok",
    });
  }
  /* console.log([...datos]); Para ver los datos del FormData() */
}

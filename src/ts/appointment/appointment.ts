import { formatDate, formatPrice } from '../helpers/currentFormat';
import { IAppointment, IAppointmentService } from '../interfaces';
import { getAllServices } from './servicesAPI';

const containerServices = document.querySelector('#services') as HTMLDivElement;
const afterPage = document.querySelector("#toContinue") as HTMLButtonElement;
const beforePage = document.querySelector("#toGoBack") as HTMLButtonElement;
const userId = document.querySelector("#userId") as HTMLInputElement;
const userName = document.querySelector("#name") as HTMLInputElement;
const userLastname = document.querySelector("#lastname") as HTMLInputElement;
const inputAppointmenDate = document.querySelector("#date") as HTMLInputElement;
const inputAppointmenTime = document.querySelector("#time") as HTMLInputElement;

const containerResumen = document.querySelector("#contentResumen") as HTMLDivElement;
const containerTabs = document.querySelectorAll('#container-tabs button') as NodeListOf<HTMLDivElement>;

let seccionTab = 1;
const firstSeccion = 1;
const lastSeccion = 3;

const services = await getAllServices();

const initialAppointment = () => {
  appointment.id = userId.value;
  appointment.name = userName.value;
  appointment.lastname = userLastname.value;

  showSection();
  tabs();

  showServices(services);

  buttonsPage();
  nextPage();
  PreviusPage();

  selectDateAppointment();
  selectTimeAppointment();

  mostrarResumenCita();
}

const appointment: IAppointment = {
  id: '',
  name: '',
  lastname: '',
  appointmentDate: '',
  appointmentTime: '',
  services: []
}

const tabs = () => {
  containerTabs.forEach(tab => {
    tab.addEventListener('click', ({ target }) => {
      if (target instanceof HTMLButtonElement) {
        seccionTab = parseInt(target.dataset.tab as string);

        showSection();

        buttonsPage();
      }
    })
  })
}

const showSection = () => {
  const previusSection = document.querySelector('.show-section') as HTMLDivElement;
  if (previusSection) {
    previusSection.classList.remove('block', 'show-section');
    previusSection.classList.add('hidden');
  }

  const currentSection = document.querySelector(`#section-${seccionTab}`) as HTMLDivElement;
  currentSection.classList.remove('hidden');
  currentSection.classList.add('block', 'show-section');

  const previusTab = document.querySelector('.current-tab') as HTMLDivElement;
  if (previusTab) {
    previusTab.classList.remove("bg-blue-500", "text-white", "current-tab");
    previusTab.classList.add("bg-blue-300", "text-black");
  }

  const currentTab = document.querySelector(`[data-tab='${seccionTab}']`) as HTMLDivElement;
  currentTab.classList.remove("bg-blue-300", "text-black");
  currentTab.classList.add("bg-blue-500", "text-white", "current-tab");
}

const buttonsPage = () => {
  if (seccionTab === firstSeccion) {
    beforePage.classList.add("opacity-0", "pointer-events-none");
    afterPage.classList.remove("opacity-0", "pointer-events-none");
  } else if (seccionTab === lastSeccion) {
    afterPage.classList.add("opacity-0", "pointer-events-none");
    beforePage.classList.remove("opacity-0", "pointer-events-none");

    mostrarResumenCita();
  } else {
    beforePage.classList.remove("opacity-0", "pointer-events-none");
    afterPage.classList.remove("opacity-0", "pointer-events-none");
  }

  showSection();
}

const nextPage = () => {
  afterPage.addEventListener('click', () => {
    if (seccionTab >= lastSeccion) return

    seccionTab++;
    buttonsPage();
  })
}

const PreviusPage = () => {
  beforePage.addEventListener('click', () => {
    if (seccionTab <= firstSeccion) return;

    seccionTab--;
    buttonsPage();
  })
}

const showServices = (services: IAppointmentService[]): void => {

  services.map(service => {
    const { id, price, title } = service;

    const btnService = document.createElement('button');
    btnService.classList.add('bg-[#001E3C]', 'col-span-6', 'w-full', 'overflow-hidden', 'rounded');
    btnService.dataset.idService = id;
    btnService.onclick = () => {
      const serviceObject = {
        ...service,
        price: +(price),
      }
      selectService(serviceObject);
    }

    const divService = document.createElement('div');
    divService.classList.add('w-full', 'py-8', 'px-4', 'text-center', 'hover:scale-110', 'transition-transform', 'duration-200');

    const titleService = document.createElement('h3');
    titleService.classList.add('font-medium', 'text-xl', 'text-white');
    titleService.textContent = title;

    const priceService = document.createElement('p');
    priceService.classList.add('font-bold', 'text-3xl', 'text-[#64B5F6]');
    priceService.textContent = `S/ ${price}`;

    divService.appendChild(titleService);
    divService.appendChild(priceService);
    btnService.appendChild(divService);

    containerServices.appendChild(btnService);
  })
}

const selectService = (service: IAppointmentService): void => {
  const { id } = service;
  const { services } = appointment;
  const serviceSelected = document.querySelector(`[data-id-service="${id}"]`) as HTMLButtonElement;

  if (services.some(service => service.id === id)) {
    const services = appointment.services.filter(service => service.id !== id);
    appointment.services = services; //001E3C

    serviceSelected.classList.remove('bg-[#103759]');
    serviceSelected.classList.add('bg-[#001E3C]');
    return;
  }

  appointment.services = [...services, service];
  serviceSelected.classList.remove('bg-[#001E3C]');
  serviceSelected.classList.add('bg-[#103759]');
  return;
}

const selectDateAppointment = (): void => {
  inputAppointmenDate.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {
      const selectedDay = new Date(target.value).getUTCDay();

      if ([6, 0].includes(selectedDay)) {
        target.value = "";

        return;
      }

      appointment.appointmentDate = target.value;
      return
    }
  });
}

function selectTimeAppointment() {
  inputAppointmenTime.addEventListener("input", ({ target }) => {

    if (target instanceof HTMLInputElement) {
      const hour = +(target.value.split(":")[0]);

      if (hour < 10 || hour > 18) {
        target.value = "";
        //mostrarAlerta("Hora no disponible", "error", ".formulario");

        return;
      }

      appointment.appointmentTime = target.value;
      return;
    }

  });
}

function mostrarResumenCita() {

  while (containerResumen.firstChild) {
    containerResumen.removeChild(containerResumen.firstChild);
  }

  const { name, lastname, appointmentDate, appointmentTime, services } = appointment;

  const headAppointment = document.createElement("H3");
  headAppointment.textContent = "Datos de la cita";

  const nameClient = document.createElement("P");
  nameClient.innerHTML = `<span>Nombre: </span> ${name}`;

  const lastnameClient = document.createElement("P");
  lastnameClient.innerHTML = `<span>Apellido: </span> ${lastname}`;

  const formatedDate = formatDate(appointmentDate)

  const appointmentDateSpan = document.createElement("P");
  appointmentDateSpan.innerHTML = `<span>Fecha: </span> ${formatedDate}`;

  const appointmentTimeSpan = document.createElement("P");
  appointmentTimeSpan.innerHTML = `<span>Hora: </span> ${appointmentTime}`;

  if (Object.values(appointment).includes("") || appointment.services.length === 0) {
    /* mostrarAlerta(
      "Faltan Datos de Servicio, Fecha u Hora",
      "error",
      ".contenido-resumen",
      false
    ); */
    console.log('sin datos')

    return;
  }

  const headServices = document.createElement("H3");
  headServices.textContent = "Datos de los servicios";

  containerResumen.appendChild(headAppointment);
  containerResumen.appendChild(nameClient);
  containerResumen.appendChild(lastnameClient);
  containerResumen.appendChild(appointmentDateSpan);
  containerResumen.appendChild(appointmentTimeSpan);
  containerResumen.appendChild(headServices);

  services.forEach((service) => {
    const { title, price } = service;

    const containerService = document.createElement("DIV");
    containerService.classList.add("contenedor-servicio");

    const titleService = document.createElement("P");
    titleService.textContent = title;

    const priceService = document.createElement("P");
    priceService.innerHTML = `<span>Precio: </span> ${formatPrice(price)}`;

    containerService.appendChild(titleService);
    containerService.appendChild(priceService);

    containerResumen.appendChild(containerService);
  });

  const totalPay = services.reduce(
    (total, service) => total + service.price,
    0
  );
  const containerTotal = document.createElement("DIV");
  containerTotal.classList.add("contenedor-total");
  containerTotal.innerHTML = `<span>Total a pagar: </span>${formatPrice(totalPay)}`;

  const bookAppointBtn = document.createElement("button");
  bookAppointBtn.classList.add("bg-blue-500", 'block', 'w-full', 'py-2', 'rounded', 'text-white', 'font-bold');
  bookAppointBtn.textContent = "Reservar Cita";
  bookAppointBtn.onclick = bookAppointment;

  containerResumen.appendChild(containerTotal);
  containerResumen.appendChild(bookAppointBtn);
}

const bookAppointment = async () => {

}

export {
  initialAppointment
};
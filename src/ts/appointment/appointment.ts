import Swal from 'sweetalert2';
import { formatDate, formatPrice } from '../helpers/currentFormat';
import { IAppointment, IAppointmentService } from '../interfaces';
import { createService, getAllServices } from './servicesAPI';

const containerServices = document.querySelector('#services') as HTMLDivElement;
const afterPage = document.querySelector('#toContinue') as HTMLButtonElement;
const beforePage = document.querySelector('#toGoBack') as HTMLButtonElement;
const userId = document.querySelector('#userId') as HTMLInputElement;
const userName = document.querySelector('#name') as HTMLInputElement;
const userLastname = document.querySelector('#lastname') as HTMLInputElement;
const inputAppointmenDate = document.querySelector('#date') as HTMLInputElement;
const inputAppointmenTime = document.querySelector('#time') as HTMLInputElement;

const containerResumen = document.querySelector('#contentResumen') as HTMLDivElement;
const containerTabs = document.querySelectorAll('#container-tabs button') as NodeListOf<HTMLDivElement>;

let seccionTab = 1;
const firstSeccion = 1;
const lastSeccion = 3;

const appointment: IAppointment = {
  id: '',
  name: '',
  lastname: '',
  appointmentDate: null,
  appointmentTime: '',
  services: []
}


const initialAppointment = () => {
  appointment.id = userId && userId.value;
  appointment.name = userId && userName.value;
  appointment.lastname = userId && userLastname.value;

  showSection();
  tabs();

  showServices();

  buttonsPage();
  nextPage();
  PreviusPage();

  selectDateAppointment();
  selectTimeAppointment();

  showResumen();
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
    previusTab.classList.remove('bg-blue-500', 'text-white', 'current-tab');
    previusTab.classList.add('bg-blue-300', 'text-black');
  }

  const currentTab = document.querySelector(`[data-tab='${seccionTab}']`) as HTMLDivElement;
  currentTab.classList.remove('bg-blue-300', 'text-black');
  currentTab.classList.add('bg-blue-500', 'text-white', 'current-tab');
}

const buttonsPage = () => {
  if (seccionTab === firstSeccion) {
    beforePage.classList.add("opacity-0", "pointer-events-none");
    afterPage.classList.remove("opacity-0", "pointer-events-none");
  } else if (seccionTab === lastSeccion) {
    afterPage.classList.add("opacity-0", "pointer-events-none");
    beforePage.classList.remove("opacity-0", "pointer-events-none");

    showResumen();
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

const showServices = async () => {
  const services = await getAllServices();

  services.map(service => {
    const { id, price, title } = service;

    const btnService = document.createElement('button');
    btnService.classList.add('bg-[#001E3C]', 'col-span-12', '2cs:col-span-6', 'w-full', 'overflow-hidden', 'rounded');
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

    serviceSelected.classList.remove('bg-blue-500');
    serviceSelected.classList.add('bg-[#001E3C]');
    return;
  }

  appointment.services = [...services, service];
  serviceSelected.classList.remove('bg-[#001E3C]');
  serviceSelected.classList.add('bg-blue-500');
  return;
}

const selectDateAppointment = (): void => {
  inputAppointmenDate.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {
      const selectedDay = new Date(target.value).getUTCDay();

      if ([6, 0].includes(selectedDay)) {
        target.value = "";
        showAlert("No se atiende los fines de semana", "error", ".formulario");

        return;
      }

      appointment.appointmentDate = target.value;
      return
    }
  });
}

const selectTimeAppointment = () => {
  inputAppointmenTime.addEventListener("input", ({ target }) => {

    if (target instanceof HTMLInputElement) {
      const hour = +(target.value.split(":")[0]);

      if (hour < 10 || hour > 18) {
        target.value = "";
        showAlert("No se atiende en ese horario", "error", ".formulario")

        return;
      }

      appointment.appointmentTime = target.value;
      return;
    }

  });
}

const showResumen = () => {

  const { name, lastname, appointmentDate, appointmentTime, services } = appointment;

  const isValidAppointment = services.length > 0 && [name, lastname, appointmentDate, appointmentTime].every(field => field !== undefined && field !== '');

  while (containerResumen.firstChild) {
    containerResumen.removeChild(containerResumen.firstChild);
  }

  const headAppointment = document.createElement("H3");
  headAppointment.classList.add('text-xl', 'font-bold', 'font-Jakarta', 'mb-2');
  headAppointment.textContent = "Datos de la cita";

  const nameClient = document.createElement("P");
  nameClient.classList.add('text-gray-400', 'font-medium');
  nameClient.innerHTML = `Nombre: <span class="font-bold text-white" >${name ?? 'Falta definir'}</span>`;

  const lastnameClient = document.createElement("P");
  lastnameClient.classList.add('text-gray-400', 'font-medium');
  lastnameClient.innerHTML = `Apellido: <span class="font-bold text-white" >${lastname ?? 'Falta definir'}</span>`;

  const formatedDate = formatDate(appointmentDate || '')

  const appointmentDateSpan = document.createElement("P");
  appointmentDateSpan.classList.add('text-gray-400', 'font-medium');
  appointmentDateSpan.innerHTML = `Fecha: <span class="font-bold text-white" >${formatedDate ?? 'Falta definir'}</span>`;

  const appointmentTimeSpan = document.createElement("P");
  appointmentTimeSpan.classList.add('text-gray-400', 'font-medium');
  appointmentTimeSpan.innerHTML = `Hora: <span class="font-bold text-white" >${appointmentTime || 'Falta definir'}</span>`;

  containerResumen.appendChild(headAppointment);
  containerResumen.appendChild(nameClient);
  containerResumen.appendChild(lastnameClient);
  containerResumen.appendChild(appointmentDateSpan);
  containerResumen.appendChild(appointmentTimeSpan);

  const divNotificate = document.createElement("DIV");
  divNotificate.innerHTML = '<p class="text-red-400 font-bold w-full text-center rounded py-2">Por favor, escoge al menos un servicio</p>'
  if (services.length <= 0) containerResumen.appendChild(divNotificate);

  const headServices = document.createElement("H3");
  headServices.classList.add('text-xl', 'font-bold', 'font-Jakarta', 'pt-4', 'pb-4', 'text-center');
  headServices.textContent = services.length > 1 ? "Tus servicios seleccionados" : 'Tu servicio seleccionado';
  if (services.length > 0) containerResumen.appendChild(headServices);

  const containerServices = document.createElement("DIV");
  containerServices.classList.add("grid", "grid-cols-12", "gap-1", '1md:gap-3');
  if (services.length > 0) containerResumen.appendChild(containerServices);

  services.forEach((service) => {
    const { title, price } = service;

    const containerService = document.createElement("DIV");
    containerService.classList.add('col-span-6', 'md:col-span-12', 'lg:col-span-4', 'flex', 'flex-col', 'justify-center', 'items-center', 'bg-[#001E3C]', 'rounded', 'p-2', 'mb-2');

    const titleService = document.createElement('P');
    titleService.classList.add('text-white', 'font-medium', 'text-center', 'text-gray-400', 'mb-2');
    titleService.textContent = title;

    const priceService = document.createElement('P');
    priceService.classList.add('text-white', 'font-bold', 'text-center', 'text-white');
    priceService.innerHTML = `<span>Precio: </span> ${formatPrice(price)}`;

    if (services.length > 0) {
      containerService.appendChild(titleService);
      containerService.appendChild(priceService);

      containerServices.appendChild(containerService);
      containerResumen.appendChild(containerServices);
    }
  });

  const totalPay = services.reduce(
    (total, service) => total + service.price,
    0
  );
  const containerTotal = document.createElement('DIV');
  containerTotal.classList.add('text-gray-400', 'font-medium', 'py-6', 'text-xl');
  containerTotal.innerHTML = `Total a pagar: <span class='text-white text-xl font-Jakarta ' >${formatPrice(totalPay)}</span>`;

  const bookAppointBtn = document.createElement('button');
  bookAppointBtn.classList.add('block', 'w-full', 'py-2', 'rounded', 'text-white', 'font-bold');
  bookAppointBtn.style.backgroundColor = isValidAppointment ? '#1D4ED8' : '#9ca3af';
  bookAppointBtn.style.cursor = isValidAppointment ? 'pointer ' : 'not-allowed';
  bookAppointBtn.type = 'submit';
  bookAppointBtn.disabled = !isValidAppointment;
  bookAppointBtn.textContent = 'Reservar Cita';
  bookAppointBtn.onclick = bookAppointment;

  if (services.length > 0) containerResumen.appendChild(containerTotal);

  containerResumen.appendChild(bookAppointBtn);
}

const showAlert = (message: string, typeMessage: string, ref: string, hidden: boolean = true) => {
  const previusAlert = document.querySelector(".alert");
  if (previusAlert) {
    previusAlert.remove();
  }

  //Creando la alerta
  const divAlert = document.createElement("div");
  divAlert.textContent = message;
  divAlert.classList.add('text-white', 'font-bold', 'w-full', 'text-center', 'rounded', 'py-2', 'alert');
  divAlert.style.backgroundColor = typeMessage === "error" ? "#e53e3e" : "#38a169";
  divAlert.style.marginTop = '1rem';

  const divFormulacio = document.querySelector(ref);
  divFormulacio!.appendChild(divAlert);

  if (hidden) {
    setTimeout(() => {
      divAlert.remove();
    }, 3000);
  }
}

const bookAppointment = async () => {
  const response = await createService(appointment);
  console.log(response);
  if (response) {
    Swal.fire({
      icon: "success",
      title: "Cita Creada",
      text: "Tu Cita fue Creada correctamente!",
      confirmButtonText: 'Ok!',
    }).then(() => {
      window.location.href = '/appointment';
    });
    return;
  }

  Swal.fire({
    icon: "error",
    title: "Error",
    text: "Hubo un error al guardar la cita",
    confirmButtonText: 'Ok!',
  });
}

export {
  initialAppointment
};
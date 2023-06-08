import { formatDate, formatPrice } from "../../../helpers/currentFormat";
import appointmentStore from "../../../store/appointmentStore";

export const showResumen = (element: HTMLElement) => {
  const appointment = appointmentStore.getCurrentAppointment();

  const { name, lastname, appointmentDate, appointmentTime, services } = appointment;

  const isValidAppointment = services.length > 0 && [name, lastname, appointmentDate, appointmentTime].every(field => field !== undefined && field !== '');

  while (element.firstChild) {
    element.removeChild(element.firstChild);
  }

  const containerResumen = document.createElement("DIV");
  containerResumen.classList.add('flex', 'flex-col', 'gap-1');
  containerResumen.innerHTML = `
    <h2 class="text-2xl font-bold font-Jakarta">Resumen de la cita</h2>
    <p class="text-gray-400 font-medium" >Nombre: <span class="font-bold text-white" >${name ?? 'Falta definir'}</span></p>
    <p class="text-gray-400 font-medium" >Apellido: <span class="font-bold text-white" >${lastname ?? 'Falta definir'}</span></p>
    <p class="text-gray-400 font-medium" >Fecha: <span class="font-bold text-white" >${formatDate(appointmentDate || '') ?? 'Falta definir'}</span></p>
    <p class="text-gray-400 font-medium" >Hora: <span class="font-bold text-white" >${appointmentTime ?? 'Falta definir'}</span></p>
    ${services.length <= 0 && `
      <div>
        <p class="text-red-400 font-bold w-full text-center rounded py-2">Por favor, escoge al menos un servicio</p>
      </div>
    `}
    ${services.length > 0 && `
      <h3 class="text-xl font-bold font-Jakarta py-4 text-center">${services.length > 1 ? "Tus servicios seleccionados" : 'Tu servicio seleccionado'}</h3>
      <div class="grid grid-cols-12 gap-1 1md:gap-3" id="appointmentServices" ></div>
    `}
  `

  const containerServices = containerResumen.querySelector('#appointmentServices') as HTMLElement;

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
  //bookAppointBtn.onclick = bookAppointment;

  if (services.length > 0) containerResumen.appendChild(containerTotal);

  containerResumen.appendChild(bookAppointBtn);
} 
import appointmentStore from "../../../store/appointmentStore";
import servicesStore from "../../../store/servicesStore";

let list: HTMLUListElement | null;

const createListServices = () => {
  const listServices = document.createElement('ul');

  listServices.classList.add('grid', 'grid-cols-12', 'gap-4', 'w-full')

  return listServices;
}

const selectService = (e: MouseEvent) => {
  const element = e.target as HTMLElement;
  const btn = element.closest('.select_service') as HTMLElement;

  if (!btn) return;
  btn.classList.toggle('bg-blue-500');
  const idService = btn.dataset.idService;
  const serviceSelected = servicesStore.getService(idService!);
  appointmentStore.addService(serviceSelected!);
}

export const renderServices = async (element: HTMLElement) => {
  const services = servicesStore.getServices();

  if (!list) {
    list = createListServices();
    element.appendChild(list);

    //events
    list.addEventListener('click', selectService);
  }

  while (list.firstChild) {
    list.removeChild(list.firstChild);
  }

  if (services.length === 0) {
    const taskElement = document.createElement("li");
    taskElement.textContent = "No hay servicios disponibles";
    taskElement.classList.add("text-center", "text-white", "col-span-12", "2cs:col-span-6", "w-full", "py-8", "px-4");
    list.appendChild(taskElement);
    return;
  }

  services.map(service => {
    const { id, price, title } = service;

    const itemService = document.createElement('li');
    itemService.classList.add('bg-[#001E3C]', 'col-span-12', '2cs:col-span-6', 'overflow-hidden', 'rounded');
    itemService.innerHTML = `
      <button class="w-full py-8 px-4 text-center hover:scale-110 transition-transform duration-200 select_service" data-id-service="${id}">
        <h3 class="font-medium text-xl text-white">${title}</h3>
        <p class="font-bold text-3xl text-[#64B5F6]">$${price}</p>
      </button>
    `

    list!.appendChild(itemService);
  });
}
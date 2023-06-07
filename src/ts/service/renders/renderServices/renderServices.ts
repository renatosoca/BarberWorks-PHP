import servicesStore from "../../../store/servicesStore";

let list: HTMLUListElement | null;

const createListServices = () => {
  const listServices = document.createElement('ul');
  listServices.classList.add('grid', 'grid-cols-12', 'gap-4', 'w-full')

  return listServices;
}

export const renderServices = async (element: HTMLElement) => {
  const services = servicesStore.getServices();
  console.log(services)
  if (!list) {
    list = createListServices();
    element.appendChild(list);

    //events
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
    itemService.classList.add('bg-[#001E3C]', 'col-span-12', '2cs:col-span-6', 'w-full', 'overflow-hidden', 'rounded');
    itemService.innerHTML = `
      <button class="w-full py-8 px-4 text-center hover:scale-110 transition-transform duration-200" data-id-service="${id}">
        <h3 class="font-medium text-xl text-white">${title}</h3>
        <p class="text-white">$${price}</p>
      </button>
    `

    list!.appendChild(itemService);
  });
}
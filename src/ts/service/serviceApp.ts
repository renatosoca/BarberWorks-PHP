import servicesStore from "../store/servicesStore";
import { renderServices } from "./renders/renderServices/renderServices";

const containerServices = document.querySelector('#services') as HTMLDivElement;

const serviceApp = async () => {
  await servicesStore.loadServices();

  renderServices(containerServices);
}

export {
  serviceApp,
}
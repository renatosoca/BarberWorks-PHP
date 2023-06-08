import { IServices } from '../interfaces';
import { getAllServices } from '../service/useCases/getAllServices';

interface IStore {
  services: IServices[],
}

const serviceStore: IStore = {
  services: [],
}

const loadServices = async (): Promise<void> => {
  const services = await getAllServices();

  serviceStore.services = services;
}

const getServices = (): IServices[] => {
  return serviceStore.services;
}

const getService = (id: string): IServices | undefined => {
  const serviceFound = serviceStore.services.find((service) => service.id === id);
  return serviceFound;
}

export default {
  loadServices,
  getServices,
  getService,
}
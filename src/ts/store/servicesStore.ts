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

export default {
  loadServices,
  getServices,
}
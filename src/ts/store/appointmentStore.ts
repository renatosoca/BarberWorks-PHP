import { IServices } from "../interfaces"

interface IStore {
  id: string,
  name: string,
  lastname: string,
  appointmentDate: string,
  appointmentTime: string,
  services: IServices[],
}

const appointmentState: IStore = {
  id: '',
  name: '',
  lastname: '',
  appointmentDate: '',
  appointmentTime: '',
  services: [],
}

const addService = (service: IServices): void => {
  const serviceFound = appointmentState.services.some((serviceFound) => serviceFound.id === service.id);

  if (serviceFound) {
    appointmentState.services = appointmentState.services.filter((serviceFound) => serviceFound.id !== service.id);
    return
  }

  appointmentState.services = [...appointmentState.services, service]
  return
}

const setFieldValue = (field: any, value: string): void => {
  switch (field) {
    case 'name':
      appointmentState.name = value;
      return;

    case 'lastname':
      appointmentState.lastname = value;
      return;

    case 'appointmentDate':
      appointmentState.appointmentDate = value;
      return;

    case 'appointmentTime':
      appointmentState.appointmentTime = value;
      return;

    default:
      return;
  }
}

export default {
  addService,
  setFieldValue,

  getCurrentServices: () => appointmentState.services,
  getCurrentAppointment: () => ({ ...appointmentState }),
}
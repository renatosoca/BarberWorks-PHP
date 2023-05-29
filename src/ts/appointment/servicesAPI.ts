import { IAppointment, IAppointmentService } from "../interfaces";

export const API_URL = 'http://localhost:3001';

const getAllServices = async (): Promise<IAppointmentService[]> => {
  try {
    const response = await fetch(`${API_URL}/api/v1/services`);
    const data = await response.json();

    return data;
  } catch (error) {
    return [];
  }
}

const createService = async (appointment: IAppointment): Promise<Boolean> => {
  const dataCreateAppointment = new FormData();
  const { id, appointmentDate, appointmentTime, services } = appointment;

  const id_services = services.map((service) => service.id);

  dataCreateAppointment.append('user_id', id);
  dataCreateAppointment.append('appointment_date', appointmentDate!);
  dataCreateAppointment.append('appointment_time', appointmentTime!);
  dataCreateAppointment.append('services', JSON.stringify(id_services));

  try {
    const response = await fetch(`${API_URL}/api/v1/create-appointment`, {
      method: 'POST',
      body: dataCreateAppointment
    });
    await response.json();

    return true;
  } catch (error) {
    return false;
  }
}

export {
  getAllServices,
  createService,
};
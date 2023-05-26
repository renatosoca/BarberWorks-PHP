import { IAppointmentService } from "../interfaces";

const API_URL = 'http://localhost:3000';

const getAllServices = async (): Promise<IAppointmentService[]> => {
  try {
    const response = await fetch(`${API_URL}/api/v1/services`);
    const data = await response.json();

    return data;
  } catch (error) {
    return [];
  }
}

export {
  getAllServices,
};
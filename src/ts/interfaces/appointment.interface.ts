import { IServices } from "./service.interface";

export interface IAppointment {
  id: string;
  name: string;
  lastname: string;
  appointmentDate?: string;
  appointmentTime?: string;
  services: IServices[];
}

export interface IAppointmentFromApi {
  id: string;
  name: string;
  lastname: string;
  appointment_date?: string;
  appointment_time?: string;
  services: IServices[];
}
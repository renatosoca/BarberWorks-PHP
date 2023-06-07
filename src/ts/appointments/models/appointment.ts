import { IAppointment, IServices } from "../../interfaces";

export class Appointment {
  id: string;
  name: string;
  lastname: string;
  appointmentDate: string;
  appointmentTime: string;
  services: IServices[];

  constructor({ id = '', name = '', lastname = '', appointmentDate = '', appointmentTime = '', services = [] }: IAppointment) {
    this.id = id;
    this.name = name;
    this.lastname = lastname;
    this.appointmentDate = appointmentDate;
    this.appointmentTime = appointmentTime;
    this.services = services;
  }
}
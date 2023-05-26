export interface IAppointment {
  id: string;
  name: string;
  lastname: string;
  appointmentDate: string;
  appointmentTime: string;
  services: IAppointmentService[];
}

export interface IAppointmentService {
  id: string;
  title: string;
  price: number;
}
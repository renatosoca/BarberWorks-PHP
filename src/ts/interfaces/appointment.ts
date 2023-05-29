export interface IAppointment {
  id: string;
  name: string;
  lastname: string;
  appointmentDate: string | null;
  appointmentTime: string | null;
  services: IAppointmentService[];
}

export interface IAppointmentService {
  id: string;
  title: string;
  price: number;
}
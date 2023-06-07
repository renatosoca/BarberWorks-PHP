import { IAppointment, IAppointmentFromApi } from "../../interfaces";


export const mapAppointmentFromModelToApi = (appointment: IAppointment): IAppointmentFromApi => {
  const { id, name, lastname, appointmentDate, appointmentTime, services } = appointment;
  return {
    id,
    name,
    lastname,
    appointment_date: appointmentDate,
    appointment_time: appointmentTime,
    services
  };
}
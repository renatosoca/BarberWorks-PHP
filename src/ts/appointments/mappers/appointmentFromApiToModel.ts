import { IAppointment, IAppointmentFromApi } from "../../interfaces";
import { Appointment } from "../models/appointment";

export const mapAppointmentFromApiToModel = (appointment: IAppointmentFromApi): IAppointment => {
  const { id, name, lastname, appointment_date, appointment_time, services } = appointment;

  return new Appointment({
    id,
    name,
    lastname,
    appointmentDate: appointment_date,
    appointmentTime: appointment_time,
    services
  })
}
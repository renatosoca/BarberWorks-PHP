import { API_URL } from "../../helpers/currentFormat";
import { IAppointment } from "../../interfaces";
import { mapAppointmentFromApiToModel } from "../mappers/appointmentFromApiToModel";
import { Appointment } from "../models/appointment";

export const saveAppointment = async (appointmentObject: IAppointment) => {
  let appointmentUpdated;

  const appointment = new Appointment(appointmentObject);

  const formData = new FormData();
  for (const [key, value] of Object.entries(appointment)) {
    formData.append(key, value);
  }

  if (appointment.id) {
    appointmentUpdated = await updateAppointment(appointment.id, formData);
  } else {
    appointmentUpdated = await createAppointment(formData);
  }

  return mapAppointmentFromApiToModel(appointmentUpdated);
}

const createAppointment = async (formData: FormData): Promise<IAppointment | null> => {
  try {
    const response = await fetch(`${API_URL}/api/v1/create-appointment`, {
      method: 'POST',
      body: formData
    });
    const appointment = await response.json();

    return appointment;
  } catch (error) {
    return null;
  }
}

const updateAppointment = async (id: string, appointment: FormData): Promise<IAppointment | null> => {
  try {
    const response = await fetch(`${API_URL}/api/v1/update-appointment/${id}`, {
      method: 'PUT',
      body: appointment
    });
    const data = await response.json();

    return data;
  } catch (error) {
    return null;
  }
}
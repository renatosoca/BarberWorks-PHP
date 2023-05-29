import "vite/modulepreload-polyfill";
import "./css/style.css";
import { initialSearchAppointment } from "./ts/admin";
import { initialAppointment } from "./ts/appointment";

const createAppointment = document.querySelector("#create-appointment");
const listAppointmentsAdmin = document.querySelector("#list-appointments-admin");

if (createAppointment) {
  initialAppointment();
}

if (listAppointmentsAdmin) {
  initialSearchAppointment();
}
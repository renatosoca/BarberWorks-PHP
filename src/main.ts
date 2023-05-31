import "vite/modulepreload-polyfill";
import "./css/style.css";
import { initialSearchAppointment } from "./ts/admin";
import { initialAppointment } from "./ts/appointment";

const createAppointment = document.querySelector("#create-appointment");
const listAppointmentsAdmin = document.querySelector("#list-appointments-admin");

const sidebarAdmin = document.querySelector('#sidebar');
const btnSidebarAdmin = document.querySelector('#btn-sidebar');

if (createAppointment) {
  initialAppointment();
}

if (listAppointmentsAdmin) {
  initialSearchAppointment();
}

if (sidebarAdmin && btnSidebarAdmin) {
  btnSidebarAdmin.addEventListener('click', () => {
    /* sidebarAdmin.classList.toggle('-left-full'); */
    sidebarAdmin.classList.toggle('-translate-x-full');
  })
}
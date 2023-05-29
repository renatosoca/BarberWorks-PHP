const initialSearchAppointment = () => {
  searchByDate();
}

function searchByDate() {
  const inputDate = document.querySelector('#date');
  if (!inputDate) return;
  inputDate.addEventListener('input', ({ target }) => {
    if (target instanceof HTMLInputElement) {
      const fechaSeleccionada = target.value;

      window.location.href = `?date=${fechaSeleccionada}`;
    }
  })
}
export {
  initialSearchAppointment
};
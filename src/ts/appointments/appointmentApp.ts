import appointmentStore from "../store/appointmentStore";
import { renderAlert } from "./renders/renderAlert/renderAlert";
import { showResumen } from "./renders/renderResumen/renderResumen";

const afterPage = document.querySelector('#toContinue') as HTMLButtonElement;
const beforePage = document.querySelector('#toGoBack') as HTMLButtonElement;
const userId = document.querySelector('#userId') as HTMLInputElement;
const userName = document.querySelector('#name') as HTMLInputElement;
const userLastname = document.querySelector('#lastname') as HTMLInputElement;
const inputAppointmenDate = document.querySelector('#date') as HTMLInputElement;
const inputAppointmenTime = document.querySelector('#time') as HTMLInputElement;

const containerTabs = document.querySelectorAll('#container-tabs button') as NodeListOf<HTMLDivElement>;
const contentResumen = document.querySelector('#contentResumen') as HTMLDivElement;

let seccionTab = 1;
const firstSeccion = 1;
const lastSeccion = 3;

const initAppointmentApp = (): void => {
  selectUserId();
  selectUSerName();
  selectDateAppointment();
  selectTimeAppointment();
  selectUserLastname();
  buttonsPage();
  tabs();
  showSection();
  nextPage();
  previusPage();

}
initAppointmentApp();

const selectUserId = (): void => {
  userId.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {
      appointmentStore.setFieldValue("id", target.value);
      return;
    }
  });
}

const selectUSerName = (): void => {
  userName.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {

      appointmentStore.setFieldValue("name", target.value);
      return;
    }
  });
}

const selectUserLastname = (): void => {
  userLastname.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {

      appointmentStore.setFieldValue("lastname", target.value);
      return;
    }
  });
}

const selectDateAppointment = (): void => {
  inputAppointmenDate.addEventListener("input", ({ target }) => {
    if (target instanceof HTMLInputElement) {
      const selectedDay = new Date(target.value).getUTCDay();

      if ([6, 0].includes(selectedDay)) {
        target.value = "";
        renderAlert("No se atiende los fines de semana", "error", ".formulario");

        return;
      }

      appointmentStore.setFieldValue("appointmentDate", target.value);
      return
    }
  });
}

const selectTimeAppointment = () => {
  inputAppointmenTime.addEventListener("input", ({ target }) => {

    if (target instanceof HTMLInputElement) {
      const hour = +(target.value.split(":")[0]);

      if (hour < 10 || hour > 18) {
        target.value = "";
        renderAlert("No se atiende en ese horario", "error", ".formulario")

        return;
      }

      appointmentStore.setFieldValue("appointmentTime", target.value);
      return;
    }

  });
}

const tabs = () => {
  containerTabs.forEach(tab => {
    tab.addEventListener('click', ({ target }) => {
      if (target instanceof HTMLButtonElement) {
        seccionTab = parseInt(target.dataset.tab as string);

        showSection();

        buttonsPage();
      }
    })
  })
}

const showSection = () => {
  const previusSection = document.querySelector('.show-section') as HTMLDivElement;
  if (previusSection) {
    previusSection.classList.remove('block', 'show-section');
    previusSection.classList.add('hidden');
  }

  const currentSection = document.querySelector(`#section-${seccionTab}`) as HTMLDivElement;
  currentSection.classList.remove('hidden');
  currentSection.classList.add('block', 'show-section');

  const previusTab = document.querySelector('.current-tab') as HTMLDivElement;
  if (previusTab) {
    previusTab.classList.remove('bg-blue-500', 'text-white', 'current-tab');
    previusTab.classList.add('bg-blue-300', 'text-black');
  }

  const currentTab = document.querySelector(`[data-tab='${seccionTab}']`) as HTMLDivElement;
  currentTab.classList.remove('bg-blue-300', 'text-black');
  currentTab.classList.add('bg-blue-500', 'text-white', 'current-tab');
}

const buttonsPage = () => {
  if (seccionTab === firstSeccion) {
    beforePage.classList.add("opacity-0", "pointer-events-none");
    afterPage.classList.remove("opacity-0", "pointer-events-none");
  } else if (seccionTab === lastSeccion) {
    afterPage.classList.add("opacity-0", "pointer-events-none");
    beforePage.classList.remove("opacity-0", "pointer-events-none");

    showResumen(contentResumen);
  } else {
    beforePage.classList.remove("opacity-0", "pointer-events-none");
    afterPage.classList.remove("opacity-0", "pointer-events-none");
  }

  showSection();
}

const nextPage = () => {
  afterPage.addEventListener('click', () => {
    if (seccionTab >= lastSeccion) return

    seccionTab++;
    buttonsPage();
  })
}

const previusPage = () => {
  beforePage.addEventListener('click', () => {
    if (seccionTab <= firstSeccion) return;

    seccionTab--;
    buttonsPage();
  })
}

export { };
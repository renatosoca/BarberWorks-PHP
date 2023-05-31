
const sidebarAdmin = document.querySelector('#sidebar-admin');
const btnSidebarAdmin = document.querySelector('#btn-sidebar-admin');

if (sidebarAdmin && btnSidebarAdmin) {
  btnSidebarAdmin.addEventListener('click', () => {
    sidebarAdmin.classList.toggle('-translate-x-full');
  })
}

export { };
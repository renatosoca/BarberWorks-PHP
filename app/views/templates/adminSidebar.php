<aside
  class="absolute 2lg:relative left-0 top-0 bottom-0 -translate-x-full 2lg:transform-none max-w-[15rem] w-full bg-[#0A1929] 2lg:bg-inherit text-[#B2BAC2] font-bold transition-transform duration-300"
  id="sidebar-admin"
>
  <ul class="px-3 py-6 flex flex-col gap-2 text-[#B2BAC2] font-bold">
    <li 
      class="w-full <?php echo isLinkActive('/admin/home') ? 'bg-[#132F4C] text-[#64B5F6]' : '' ?> hover:bg-[#103759] hover:text-white rounded transition-colors duration-200 ease-in-out"
    >
      <a class="w-full flex gap-2 items-center p-2" href="/admin/home">
        <svg xmlns="http://www.w3.org/2000/svg" 
          fill="none" 
          viewBox="0 0 24 24" 
          stroke-width="1.5" 
          stroke="currentColor" 
          class="w-6 h-6"
          width="8"
          height="8"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>

        Ver Citas
      </a>
    </li>
    
    <li 
      class="w-full <?php echo isLinkActive('/admin/services') ? 'bg-[#132F4C] text-[#64B5F6]' : '' ?> hover:bg-[#103759] hover:text-white rounded transition-colors duration-200 ease-in-out"
    >
      <a class="w-full flex gap-2 items-center p-2" href="/admin/services">
        <svg xmlns="http://www.w3.org/2000/svg" 
          class="w-6 h-6" 
          viewBox="0 0 24 24" 
          stroke-width="1.5" 
          stroke="currentColor" 
          fill="none" 
          stroke-linecap="round" 
          stroke-linejoin="round"
          width="8"
          height="8"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
          <path d="M16 3v4" />
          <path d="M8 3v4" />
          <path d="M4 11h16" />
          <path d="M11 15h1" />
          <path d="M12 15v3" />
        </svg>

        Ver Servicios
      </a>
    </li>
    
    <li 
      class="w-full <?php echo isLinkActive('/admin/service/create') ? 'bg-[#132F4C] text-[#64B5F6]' : '' ?> hover:bg-[#103759] hover:text-white rounded transition-colors duration-200 ease-in-out"
    >
      <a class="w-full flex gap-2 items-center p-2" href="/admin/service/create">
        <svg xmlns="http://www.w3.org/2000/svg" 
          class="w-6 h-6" 
          viewBox="0 0 24 24" 
          stroke-width="1.5" 
          stroke="currentColor" 
          fill="none" 
          stroke-linecap="round" 
          stroke-linejoin="round"
          width="8"
          height="8"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
          <path d="M16 3v4" />
          <path d="M8 3v4" />
          <path d="M4 11h16" />
          <path d="M11 15h1" />
          <path d="M12 15v3" />
        </svg>

        Nuevo Servicio
      </a>
    </li>
  </ul>
</aside>
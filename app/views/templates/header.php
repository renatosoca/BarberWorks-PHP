<header class="border-b border-gray-500" >
  <div class="max-w-[80rem] flex items-center justify-between mx-auto py-3 px-4 text-[#64B5F6]">
    <h1 class="text-xl 1sm:text-3xl font-bold font-Gotham">
      Barber Works
    </h1>

    <div class="flex gap-1 items-center">
      <p class="text-gray-300 hidden 1sm:block" ><?php echo $name . ' ' . $lastname; ?></p>

      <div class="p-[.3rem] border-[.01rem] border-[#132F4C] rounded-[.65rem]" >
        <svg xmlns="http://www.w3.org/2000/svg" 
          fill="none" 
          viewBox="0 0 24 24" 
          stroke-width="1.5" 
          stroke="currentColor" 
          class="w-6 h-6 text-[#64B5F6]"
          width="8"
          height="8"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </div>

      <a href="/logout" class="px-3 py-1 bg-red-400 rounded text-white ml-2 font-bold" >Cerrar sesión</a>

      <button
        class="p-[.3rem] border-[.01rem] border-[#132F4C] rounded-[.65rem] 2lg:hidden text-sm"
        id="btn-sidebar"
      >
        <svg 
          xmlns="http://www.w3.org/2000/svg" 
          class="w-6 h-6 text-[#64B5F6]" 
          width="8"
          height="8"
          viewBox="0 0 24 24" 
          stroke-width="1.5" 
          stroke="#64B5F6" 
          fill="none" 
          stroke-linecap="round" 
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M14 4h6v6h-6z" />
          <path d="M4 14h6v6h-6z" />
          <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
          <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
        </svg>
      </button>
    </div>
  </div>
</header>
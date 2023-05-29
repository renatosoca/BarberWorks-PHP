<?php include_once __DIR__.'/../templates/sideBar.php' ?>

<div class="w-full px-4 py-6 text-white" id="create-appointment">

  <div class="pt-4" >
    <div 
      class="relative flex gap-10 max-w-max font-semibold py-8 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:w-full before:bg-white before:text-white before:h-[.15rem]"
      id="container-tabs"
    >
      <button 
        class="w-10 h-10 rounded-full bg-blue-500 z-10 actual"
        type="button" 
        data-tab="1"
      >
        1
      </button>
      
      <button 
        class="w-10 h-10 rounded-full bg-blue-300 text-black z-10"
        type="button" 
        data-tab="2"
      >
        2
      </button>
      
      <button 
        class="w-10 h-10 rounded-full bg-blue-300 text-black z-10"
        type="button" 
        data-tab="3"
      >
        3
      </button>
    </div>

    <div class="" id="section-1">
      <h2 class="pb-4 text-4xl font-Jakarta font-bold" >Configura tu cita</h2>
      <h2 class="pb-8 text-xl font-Jakarta font-medium" >Elige uno o más servicios a continuación</h2>
      <div class="grid grid-cols-12 gap-4 w-full" id="services"></div>
    </div>

    <div class="hidden" id="section-2">
      <h2 class="pb-8 text-4xl font-Jakarta font-bold" >Selecciona tu fecha y hora</h2>

      <form action="" class="formulario">
        <input type="hidden" id="userId" value="<?php echo $userId ?>">

        <div class="flex gap-4 w-full">
          <div class="w-full">
            <label for="name" class="text-base">Nombre</label>
            <input
              class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
              type="text"
              id="name"
              name="appointment[name]"
              placeholder="Ingresa tu nombre completo"
              value="<?php echo sanitize($name); ?>"
              disabled
            />
          </div>
  
          <div class="w-full">
            <label for="lastname" class="text-base">Apellido</label>
            <input
              class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
              type="text"
              id="lastname"
              name="appointment[lastname]"
              placeholder="Ingresa tu apellido completo"
              value="<?php echo sanitize($lastname); ?>"
              disabled
            />
          </div>
        </div>

        <div class="">
          <label for="date" class="text-base">Fecha de la cita</label>
          <input
            class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
            type="date"
            id="date"
            name="appointment[date]"
            min="<?php echo date('Y-m-d'); ?>"
          />
        </div>

        <div class="">
          <label for="time" class="text-base">Hora de la cita</label>
          <input
            class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
            type="time"
            id="time"
            name="appointment[time]"
          />
        </div>
      </form>
    </div>

    <div class="hidden contenido-resumen" id="section-3">
      <h2 class="pb-8 text-4xl font-Jakarta font-bold" >Confirmar cita</h2>

      <div class="flex flex-col gap-1" id="contentResumen"></div>
    </div>

    <div class="flex justify-between pt-10 text-base font-semibold">
      <button id="toGoBack" class="bg-blue-600 px-14 py-2 rounded">Regresar</button>
      <button id="toContinue" class="bg-blue-600 px-14 py-2 rounded">Continuar</button>
    </div>
  </div>
</div>
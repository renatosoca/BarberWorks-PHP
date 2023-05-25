<?php include_once __DIR__.'/../templates/sideBar.php' ?>

<div class="w-full px-4 py-6 text-white">

  <div class="pt-4" >
    <h2>Agendar una cita</h2>

    <div 
      class="relative flex gap-4 max-w-max font-semibold py-8 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:w-full before:bg-white before:text-white before:h-1"
      id="containers-taps"
    >
      <button 
        class="px-4 py-1 rounded-full bg-blue-500 z-10 actual"
        type="button" 
        data-paso="1"
      >
        Servicios
      </button>
      
      <button 
        class="px-4 py-1 rounded-full bg-blue-300 text-black z-10"
        type="button" 
        data-paso="2"
      >
        Información Cita
      </button>
      
      <button 
        class="px-4 py-1 rounded-full bg-blue-300 text-black z-10"
        type="button" 
        data-paso="3"
      >
        Resumen
      </button>
    </div>

    <div class="" id="paso-1">
      <h2 class="pb-8 text-xl font-Jakarta font-medium" >Elige tus servicios a continuación</h2>
      <div class="grid grid-cols-12 gap-4 w-full" id="services"></div>
    </div>

    <div class="hidden" id="paso-2">
      <h2 class="pb-8 text-xl font-Jakarta font-medium" >Coloca tus datos y fecha de tu cita</h2>

      <form action="" class="formulario">
        <input type="hidden" id="userId" value="<?php echo $userId ?>">

        <div class="campo">
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

        <div class="campo">
          <label for="date" class="text-base">Fecha de la cita</label>
          <input
            class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
            type="date"
            id="date"
            name="appointment[date]"
            min="<?php echo date('Y-m-d'); ?>"
          />
        </div>

        <div class="campo">
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

    <div class="hidden contenido-resumen" id="paso-3">
      <h2 class="text-xl font-Jakarta font-medium" >Confirmar cita</h2>
      <p class="pt-2 pb-8 text-sm font-Jakarta font-medium" >Verifica que la información sea correcta</p>
    </div>

    <div class="flex justify-between pt-10 text-base font-semibold">
      <button id="toGoBack" class="bg-blue-600 px-14 py-2 rounded">Regresar</button>
      <button id="toContinue" class="bg-blue-600 px-14 py-2 rounded">Continuar</button>
    </div>
  </div>
</div>

<?php 
  $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
  "; 
?>
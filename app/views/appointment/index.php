<?php include_once __DIR__.'/../templates/sideBar.php' ?>

<div class="w-full px-4 py-6 text-white">
  <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-sky-500 px-4 py-10 rounded">
    <p class="text-4xl font-bold font-Jakarta pb-2 text-white" >!Hola <?php echo $name ?>¡</p>
    <p class="text-sm font-medium text-gray-200" >Estamos aquí para ayudarte</p>
  </div>

  <?php if (count($appointments) === 0): ?>
    <h3 class="text-2xl font-bold font-Jakarta text-center py-8">Aquí se mostraran todas tus citas cuando agendes una o más</h3>
  <?php return; endif; ?>

  <h2 class="text-xl font-bold font-Jakarta my-6">Tus proximas citas</h2>

  <div>
    <ul class="flex flex-col gap-4 pt-6">
      <?php 
      $idAppointments = 0;
      foreach ($appointments as $key => $value) : 
        if($idAppointments !== $value->id) :
          $total = 0;
      ?>
          <li class="text-base text-blue-500 font-semibold grid grid-cols-12 gap-2 bg-[#001E3C] rounded p-6">
            <div class="col-span-6">
              <h2 class="text-white text-xl font-bold pb-2" >Datos de la cita</h2>
              <p>Hora: <span class="text-white" ><?php echo sanitize($value->appointment_time); ?></span></p>
              <p>Cliente: <span class="text-white" ><?php echo sanitize($value->client); ?></span></p>
              <p>Email: <span class="text-white" ><?php echo sanitize($value->email); ?></span></p>
              <p>Telefono: <span class="text-white" ><?php echo sanitize($value->phone); ?></span></p>
            </div>

            <div class="col-span-6">
              <h3 class="text-white text-xl font-bold pb-2" >Servicios</h3>
      <?php
              $idAppointments = $value->id;
        endif;
      ?>
              <p class="text-gray-300 m-0 flex justify-between">
                <?php echo sanitize($value->service) ?>
                <span class="text-gray-200" >
                  <?php echo "S/ ".(sanitize($value->price)); ?>
                </span>
              </p>
      <?php
            $total += $value->price;
            $currency = $value->id;
            $next = $appointments[$key + 1]->id ?? 0;

              if (isFinal($currency, $next)) :
      ?>
                <p class="text-blue-500 text-xl pt-4">Total: <span class="text-white">S/ <?php echo $total; ?></span></p>
            </div>
      <?php    
              endif;
      endforeach;
      ?>
          </li>
    </ul>
  </div>
</div>
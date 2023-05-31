<?php include_once __DIR__.'/../templates/adminSidebar.php'; ?>

<div class="text-white p-6 w-full" id="list-appointments-admin">
  <h1 class="text-2xl 1sm:text-3xl text-center 1sm:text-start font-bold pb-6">Panel de Administración</h1>
  <h2 class="text-center text-xl font-bold" >Buscar citas</h2>

  <div class="w-full pt-6">
    <form action="" class="text-black" id="filter-date">
      <div class="w-full flex items-center">
        <label for="date" class="text-white h-full pr-2" >Filtrar por fecha:</label>
        <input
          class="flex-1 px-4 py-1 rounded outline-none"
          type="date" 
          name="date" 
          id="date" 
          value="<?php echo sanitize($fecha) ?>"
        >
      </div>
    </form>
  </div>

  <?php if(count($appointments) === 0) echo '<h2 class="text-center text-white font-bold text-2xl pt-6">No hay appointments en esta Fecha</h2>'; ?>

  <div id="appointments-admin">
    <ul class="flex flex-col gap-4 pt-6">
      <?php 
      $idAppointments = 0;
      foreach ($appointments as $key => $value) : 
        if($idAppointments !== $value->id) :
          $total = 0;
      ?>
          <li class="text-base text-blue-500 font-semibold grid grid-cols-12 gap-2 bg-[#001E3C] rounded p-4">
            <div class="col-span-12 1md:col-span-6">
              <h2 class="text-center text-white text-xl font-bold pb-2" >Datos de la cita</h2>
              <p>Hora: <span class="text-white" ><?php echo sanitize($value->appointment_time); ?></span></p>
              <p>Cliente: <span class="text-white" ><?php echo sanitize($value->client); ?></span></p>
              <p>Email: <span class="text-white" ><?php echo sanitize($value->email); ?></span></p>
              <p>Telefono: <span class="text-white" ><?php echo sanitize($value->phone); ?></span></p>
            </div>

            <div class="col-span-12 1md:col-span-6 flex flex-col">
              <h3 class="text-center text-white text-xl font-bold pb-2" >Servicios</h3>
      <?php
              $idAppointments = $value->id;
        endif;
      ?>
              <p class="text-blue-300 m-0 flex flex-col 1cs:flex-row 1cs:justify-between">
                <?php echo sanitize($value->service) ?>
                <span class="text-blue-500" >
                  <?php echo "S/ ".(sanitize($value->price)); ?>
                </span>
              </p>
      <?php
            $total += $value->price;
            $currency = $value->id;
            $next = $appointments[$key + 1]->id ?? 0;

              if (isFinal($currency, $next)) :
      ?>
                <p class="text-blue-500">Total: <span class="text-white">S/ <?php echo $total; ?></span></p>
            </div>

            <form action="/api/v1/delete-appointment" class="col-span-12" method="POST">
              <input type="hidden" name="id" value="<?php echo $value->id ?>">
              <input type="submit" class="block w-full 1md:w-min bg-red-500 px-6 py-1 rounded text-white cursor-pointer" value="Eliminar">
            </form>
      <?php    
              endif;
      endforeach;
      ?>
          </li>
    </ul>
  </div>
</div>
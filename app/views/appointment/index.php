<?php include_once __DIR__.'/../templates/sideBar.php' ?>

<div class="w-full px-4 py-6 text-white">
  <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-sky-500 px-4 py-10 rounded">
    <p class="text-4xl font-bold font-Jakarta pb-2 text-white" >!Hola <?php echo $name ?>¡</p>
    <p class="text-sm font-medium text-gray-200" >Estamos aquí para ayudarte</p>
  </div>

  <h2 class="text-xl font-bold font-Jakarta my-6">Tus proximas citas</h2>

  <div class="" >

    <?php foreach ($appointments as $appointment): ?>
      <div class="bg-[#001E3C] rounded-md shadow-md p-4 my-4 ">
        <div class="flex justify-between">
          <div>
            <p class="text-xl font-bold">Fecha: <?php echo ($appointment->appointment_date) ?></p>
            <p class="text-sm font-medium"><?php echo $appointment->appointment_time ?></p>
          </div>
          <div>
            <p class="text-xl font-bold">Hora: <?php echo $appointment->appointment_time ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
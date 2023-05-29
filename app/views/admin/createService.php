<?php include_once __DIR__.'/../templates/adminSidebar.php'; ?>

<div class="text-white p-6 w-full">
  <h1 class="text-3xl font-bold pb-6">Crear Servicio</h1>
  
  <?php include_once __DIR__.'/../templates/alerts.php'; ?>
  
  <form action="/admin/service/create" method="POST"  class="w-full"">
  
    <?php include_once __DIR__.'/formService.php'; ?>

    <button 
      type="submit" 
      class="block bg-blue-500 font-bold text-center text-white px-3 py-2 rounded hover:bg-blue-700 w-full transition-colors duration-200 ease-in-out"
    >
      Crear servicio
    </button>
  </form>
</div>
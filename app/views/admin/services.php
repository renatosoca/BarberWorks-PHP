<?php include_once __DIR__.'/../templates/adminSidebar.php'; ?>

<div class="text-white p-6 w-full">
  <h1 class="text-3xl font-bold pb-6">Servicios</h1>
  <p class="text-xl font-bold pb-6">Administrador de Servicios</p>
  
  <ul class="w-full grid grid-cols-12 gap-4">
    <?php foreach ($services as $row): ?>
      <li class="bg-[#001E3C] col-span-12 1sm:col-span-6 px-4 py-2 rounded">
        <p>Servicio número: <span><?php echo $row->id ?></span></p>
        <p>Titulo: <span><?php echo $row->title; ?></span></p>
        <p>Precio: <span><?php echo $row->price; ?></span></p>
        <div class="flex justify-between pt-4">
          <a href="/admin/service/<?php echo $row->id ?>" class="bg-blue-500 px-6 py-1 rounded font-bold text-white">Editar</a>
  
          <form action="/admin/services/delete" method="POST">
            <input type="hidden" name="id" value="<?php echo $row->id; ?>">
            <input type="submit" value="Eliminar" class="bg-red-500 px-6 py-1 rounded font-bold text-white cursor-pointer">
          </form>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
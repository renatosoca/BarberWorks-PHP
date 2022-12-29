<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administrador de Servicios</p>

<?php include_once __DIR__.'/../templates/navegacion.php'; ?>

<ul class="servicios">
    <?php foreach ($servicios as $row) { ?>
        <li>
            <p>Nombre: <span><?php echo $row->nombre; ?></span></p>
            <p>Precio: <span><?php echo $row->precio; ?></span></p>
            <div class="acciones">
                <a href="/servicio/editar?id=<?php echo $row->id ?>" class="btn">Editar</a>

                <form action="/servicio/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                    <input type="submit" value="Eliminar" class="btn eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>
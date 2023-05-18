<h1 class="nombre-pagina">Crear Servicio</h1>

<?php 
    include_once __DIR__.'/../templates/navegacion.php';
    include_once __DIR__.'/../templates/alertas.php';
?>

<form action="/servicio/crear" method="POST" class="formulario">

    <?php include_once __DIR__.'/formulario.php'; ?>

    <input type="submit" value="Crear" class="btn">
</form>
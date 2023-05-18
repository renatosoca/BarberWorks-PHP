<h1 class="nombre-pagina">Actualizar Servicio</h1>

<?php 
    include_once __DIR__.'/../templates/navegacion.php';
    include_once __DIR__.'/../templates/alertas.php';
?>

<form method="POST" class="formulario">

    <?php include_once __DIR__.'/formulario.php'; ?>

    <input type="submit" value="Editar" class="btn">
</form>
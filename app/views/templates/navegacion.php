<div class="barra">
    <p>Hola: <?php echo $nombre; ?></p>

    <a href="/logout" class="btn">Salir</a>
</div>

<?php if( isset($_SESSION['admin']) ) { ?>
<nav class="tabs">
    <a class="btn"  href="/admin" >Ver Citas</a>
    <a class="btn"  href="/servicio" >Ver Servicios</a>
    <a class="btn"  href="/servicio/crear" >Nuevo Servicio</a>
</nav>
<?php } ?>
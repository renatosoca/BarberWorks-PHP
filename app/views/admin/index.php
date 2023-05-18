<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include_once __DIR__.'/../templates/navegacion.php'; ?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo s($fecha) ?>">
        </div>
    </form>
</div>

<?php if(count($citas) === 0) echo '<h2>No hay Citas en esta Fecha</h2>'; ?>

<div id="citas-admin">
    <ul class="citas">
        <?php 
            $idCitas = 0;
            foreach ($citas as $key => $value) { 
                if($idCitas !== $value->id) {
                    $total = 0;
        ?>
                    <li>
                        <p>ID: <span><?php echo s($value->id); ?></span></p>
                        <p>Hora: <span><?php echo s($value->hora); ?></span></p>
                        <p>Cliente: <span><?php echo s($value->cliente); ?></span></p>
                        <p>Email: <span><?php echo s($value->email); ?></span></p>
                        <p>Telefono: <span><?php echo s($value->telefono); ?></span></p>
                        <h3>Servicios</h3>
        <?php
                    $idCitas = $value->id;
                } //Fin del If
        ?>
                        <p class="servicio"><span><?php echo s($value->servicio). " ". s($value->precio); ?></span></p>
        <?php
                $total += $value->precio;
                $actual = $value->id;
                $proximo = $citas[$key + 1]->id ?? 0;

                if (esFinal($actual, $proximo)) { 
        ?>
                    <p>Total: <span><?php echo $total; ?></span></p>
                    <form action="/api/eliminar" class="formulario" method="POST">
                        <input type="hidden" name="id" value="<?php echo $value->id ?>">
                        <input type="submit" class="btn eliminar" value="Eliminar">
                    </form>
        <?php    
                }
            } //Fin del Foreach 
        ?>
                    </li>
    </ul>
</div>

<?php
    $script = "
            <script src='src/js/buscador.js'></script>
    ";
?>
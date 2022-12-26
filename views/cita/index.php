<h1 class="nombre-pagina">Citas</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1" >Servicios</button>
        <button type="button" data-paso="2" >Información Cita</button>
        <button type="button" data-paso="3" >Resumen</button>
    </nav>

    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center" >Elige tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>

    <div class="seccion" id="paso-2">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center" >Coloca tus datos y fecha de tu cita</p>

        <form action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="cita[nombre]" id="nombre" placeholder="Tu Nombre" value="<?php echo s($nombre); ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" name="cita[fecha]" id="fecha" >
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" name="cita[hora]" id="hora" >
            </div>
        </form>
    </div>

    <div class="seccion" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center" >Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="btn">&laquo; Anterior</button>
        <button id="siguiente" class="btn">Siguiente&raquo;</button>
    </div>
</div>

<?php $script = "<script src='src/js/app.js'></script>"; ?>
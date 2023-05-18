<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuacion</p>

<?php include_once __DIR__ .'/../templates/alertas.php';
    if ($error) return;
?>

<form clas="formulario" method="POST">
    <div class="campo">
        <label for="pass">Password</label>
        <input 
            type="password"
            id="pass"
            name="recuperar[pass]"
            placeholder="Ingresa tu Nuevo Password"
        />
    </div>

    <input type="submit" class="btn" value="Reestablecer Password">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>
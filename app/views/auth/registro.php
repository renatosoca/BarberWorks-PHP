<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php include_once __DIR__.'/../templates/alertas.php' ?>

<form clas="formulario" action="/crear-cuenta" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            name="register[nombre]"
            placeholder="Ingresa tu Nombre"
            value="<?php echo s($user->nombre); ?>"
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text"
            id="apellido"
            name="register[apellido]"
            placeholder="Ingresa tu Apellido"
            value="<?php echo s($user->apellido); ?>"
        />
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel"
            id="telefono"
            name="register[telefono]"
            placeholder="Ingresa tu Telefono"
            value="<?php echo s($user->telefono); ?>"
        />
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            name="register[email]"
            placeholder="Ingresa tu Email"
            value="<?php echo s($user->email); ?>"
        />
    </div>

    <div class="campo">
        <label for="pass">Password</label>
        <input 
            type="password"
            id="pass"
            name="register[pass]"
            placeholder="Ingresa tu Password"
        />
    </div>

    <input type="submit" class="btn" value="Crear Cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>
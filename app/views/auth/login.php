<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<?php include_once __DIR__.'/../templates/alertas.php'; ?>

<form clas="formulario" action="/" method="POST">
    <div class="campo">
        <label for="email" class="text-5xl">Email</label>
        <input 
            type="email"
            id="email"
            name="login[email]"
            placeholder="Ingresa tu Email"
        />
    </div>

    <div class="campo">
        <label for="pass">Password</label>
        <input 
            type="password"
            id="pass"
            name="login[pass]"
            placeholder="Ingresa tu Password"
        />
    </div>

    <input type="submit" class="btn" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>
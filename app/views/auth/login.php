<h1 class="text-center text-4xl font-bold font-Jakarta pb-4">Iniciar Sesión</h1>
<p class="text-center font-medium">Inicia Sesión con tus datos</p>

<?php include_once __DIR__.'/../templates/alerts.php'; ?>

<form 
  class="max-w-lg w-full mx-auto rounded-md flex flex-col gap-3 py-10" 
  action="/" 
  method="POST"
>
  <div class="campo">
    <label for="email" class="text-base">Email</label>
    <input
      class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
      type="email"
      id="email"
      name="login[email]"
      placeholder="Ingresa tu correo"
    />
  </div>

  <div class="campo">
    <label for="email" class="text-base">Contraseña</label>
    <input
      class="w-full py-2 px-3 rounded-md text-black font-medium outline-none"
      type="password"
      id="password"
      name="login[password]"
      placeholder="Ingresa tu contraseña"
    />
  </div>

  <button 
    type="submit" 
    class="py-2 px-10 rounded-md w-full bg-blue-800 mt-5 hover:bg-blue-700 transition-colors duration-300 ease-in-out text-white font-medium" 
    value="Iniciar Sesión"
  >
    Iniciar Sesión
  </button>
</form>

<div class="max-w-lg w-full flex gap-2 justify-between">
  <p>¿Aún no tienes una cuenta? <a href="/register">Crear una</a></p>
  <a href="/forgot-password">¿Olvidaste tu Password?</a>
</div>
<?php
require_once __DIR__ . '/../app/core/app.php';

use App\Router;
use App\Controllers\HomeController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/rena', [HomeController::class, 'index']);
Router::get('/prueba/:id', [HomeController::class, 'prueba']);

//Router::get("/", [LoginController::class, "login"]);
//$router->post("/", [LoginController::class, "login"]);
//Cerrar Sesión
/* $router->get("/logout", [LoginController::class, "logout"]); */
//recuperar Password
/* $router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);
$router->get("/recuperar", [LoginController::class, "recuperar"]);
$router->post("/recuperar", [LoginController::class, "recuperar"]); */
//Crear Cuenta
/* $router->get("/crear-cuenta", [LoginController::class, "crear"]);
$router->post("/crear-cuenta", [LoginController::class, "crear"]); */
//Confirmar Cuenta
/* $router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']); */
//Mensaje de confirmacion de Cuenta
/* $router->get('/mensaje', [LoginController::class, 'mensaje']); */

//Area Privada
/* $router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']); */

//CRUD
/* $router->get('/servicio', [ServicioController::class, 'index']);
$router->get('/servicio/crear', [ServicioController::class, 'crear']);
$router->post('/servicio/crear', [ServicioController::class, 'crear']);
$router->get('/servicio/editar', [ServicioController::class, 'editar']);
$router->post('/servicio/editar', [ServicioController::class, 'editar']);
$router->post('/servicio/eliminar', [ServicioController::class, 'eliminar']); */


//API de Citas
/* $router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']); */


//comprueba que existan las URL y se les asigne las funciones del controller correspondiente
Router::dispatch();

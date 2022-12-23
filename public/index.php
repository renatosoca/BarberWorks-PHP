<?php
require_once __DIR__ . '/../includes/app.php';

use Controller\LoginController;
use Router\Router;

$router = new Router();

//Iniciar Sesión
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
//Cerrar Sesión
$router->get("/logout", [LoginController::class, "logout"]);
//recuperar Password
$router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);
$router->get("/recuperar", [LoginController::class, "recuperar"]);
$router->post("/recuperar", [LoginController::class, "recuperar"]);
//Crear Cuenta
$router->get("/crear-cuenta", [LoginController::class, "crear"]);
$router->post("/crear-cuenta", [LoginController::class, "crear"]);
//Confirmar Cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);


//comprueba que existan las URL y se les asigne las funciones del controller correspondiente
$router->comprobarRutas();

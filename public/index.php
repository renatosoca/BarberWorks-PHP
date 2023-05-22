<?php
require_once __DIR__ . '/../app/core/app.php';

use App\Router;
use App\Controllers\AuthController;

Router::get('/', [AuthController::class, 'authUser']);
Router::post('/', [AuthController::class, 'authUser']);

Router::get('/logout', function() {
  session_start();
  $_SESSION = [];
  Router::redirect('/');
});

Router::get('/register', [AuthController::class, 'registerUser']);
Router::post('/register', [AuthController::class, 'registerUser']);

Router::get('/confirm-account/:token', [AuthController::class, 'confirmAccount']);
Router::get('/message', function() {
  Router::render('auth/message', 'AuthLayout', [
    'title' => 'Mensaje de confirmación',
  ]);
});

Router::get('/forgot-password', [AuthController::class, 'forgotPassword']);
Router::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Router::get('/reset-password/:token', [AuthController::class, 'resetPassword']);
Router::post('/reset-password/:token', [AuthController::class, 'resetPassword']);


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


Router::dispatch();

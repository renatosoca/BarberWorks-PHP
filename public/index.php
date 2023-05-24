<?php
require_once __DIR__ . '/../app/core/app.php';

use App\Router;
use App\Controllers\AuthController;
use App\Controllers\ServiceController;
use App\Controllers\AppointmentController;

//ROUTES PUBLICS
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

//ROUTES PRIVATES
Router::get('/appointment', [AppointmentController::class, 'index']);

Router::get('/admin', [AdminController::class, 'index']);


//CRUD
Router::get('/servicio', [ServiceController::class, 'index']);
Router::get('/servicio/crear', [ServiceController::class, 'crear']);
Router::post('/servicio/crear', [ServiceController::class, 'crear']);
Router::get('/servicio/editar', [ServiceController::class, 'editar']);
Router::post('/servicio/editar', [ServiceController::class, 'editar']);
Router::post('/servicio/eliminar', [ServiceController::class, 'eliminar']);


//API de Citas
Router::get('/api/servicios', [APIController::class, 'index']);
Router::post('/api/citas', [APIController::class, 'guardar']);
Router::post('/api/eliminar', [APIController::class, 'eliminar']);


Router::dispatch();

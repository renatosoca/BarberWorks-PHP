<?php
require_once __DIR__ . '/../app/core/app.php';

use App\Router;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
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
Router::get('/create-appointment', [AppointmentController::class, 'createAppointment']);

Router::get('/admin/home', [AdminController::class, 'index']);
Router::get('/admin/services', [ServiceController::class, 'index']);
Router::get('/admin/service/create', [ServiceController::class, 'create']);
Router::post('/admin/service/create', [ServiceController::class, 'create']);
Router::get('/admin/service/:id', [ServiceController::class, 'update']);
Router::post('/admin/service/:id', [ServiceController::class, 'update']);
Router::post('/admin/services/delete', [ServiceController::class, 'delete']);


Router::get('/api/v1/services', [ServiceController::class, 'getAllServices']);
Router::post('/api/v1/create-appointment', [ServiceController::class, 'saveAppointment']);
Router::post('/api/v1/delete-appointment', [ServiceController::class, 'deleteAppointment']);

Router::dispatch();

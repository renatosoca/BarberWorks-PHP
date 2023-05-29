<?php

namespace App\Controllers;

use App\Router;
use App\Models\Appointment;

class AppointmentController {

  public static function index() {
    $isAuth = isAuth();
    if (!$isAuth) Router::redirect('/');

    $appointments = Appointment::findAll( 'user_id', $_SESSION['userId'] );

    Router::render('appointment/index', 'AppointmentLayout', [
      'title' => 'Inicio',
      'userId' => $_SESSION['userId'],
      'name' => explode(' ', $_SESSION['name'])[0],
      'lastname' => explode(' ', $_SESSION['lastname'])[0],
      'appointments' => $appointments
    ]);
  }

  public static function createAppointment() {
    $isAuth = isAuth();
    if (!$isAuth) Router::redirect('/');

    Router::render('appointment/createAppointment', 'AppointmentLayout', [
      'title' => 'Crear cita',
      'userId' => $_SESSION['userId'],
      'name' => explode(' ', $_SESSION['name'])[0],
      'lastname' => explode(' ', $_SESSION['lastname'])[0],
    ]);
  }
}
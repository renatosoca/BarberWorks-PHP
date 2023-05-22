<?php

namespace App\Controllers;

use App\Router;

class AppointmentController {

  public function index() {
    session_start();

    $isAuth = isAuth();

    if (!$isAuth) Router::redirect('/');

    Router::render('cita/index', 'AppointmentLayout', [
      'name' => $_SESSION['name'],
      'lastname' => $_SESSION['lastname'],
      'id' => $_SESSION['userId']
    ]);
  }
}
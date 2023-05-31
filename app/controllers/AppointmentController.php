<?php

namespace App\Controllers;

use App\Router;
use App\Models\Appointment;
use App\Models\AppointmentServices;

class AppointmentController {

  public static function index() {
    $isAuth = isAuth();
    if (!$isAuth) Router::redirect('/');

    $query = "SELECT a.id, a.appointment_time, CONCAT(u.name, ' ' ,u.lastname) as client, ";
    $query .= " u.email, u.phone, s.title as service, s.price  ";
    $query .= " FROM appointments a ";
    $query .= " INNER JOIN users u ON a.user_id = u.id";
    $query .= " INNER JOIN appointments_Details ad ON ad.appointment_id = a.id ";
    $query .= " INNER JOIN services s ON ad.service_id = s.id ";
    $query .= " WHERE a.user_id =  '{$_SESSION['userId']}' ";

    $appointments = AppointmentServices::PrepareSQL($query);

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
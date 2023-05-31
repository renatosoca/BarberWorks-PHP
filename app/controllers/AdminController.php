<?php
namespace App\Controllers;

use App\Router;
use App\Models\AppointmentServices;

class AdminController {

  public function index() {
    $isAdmin = isAdmin();
    if (!$isAdmin) Router::redirect('/');

    $fecha = $_GET['date'] ?? date('Y-m-d');
    $fechas = explode("-", $fecha);
    
    if( !$fechas = checkdate( $fechas[1], $fechas[2], $fechas[0]) ) {
      header('Location: /404');
    }

    $query = "SELECT a.id, a.appointment_time, CONCAT(u.name, ' ' ,u.lastname) as client, ";
    $query .= " u.email, u.phone, s.title as service, s.price  ";
    $query .= " FROM appointments a ";
    $query .= " INNER JOIN users u ON a.user_id = u.id";
    $query .= " INNER JOIN appointments_Details ad ON ad.appointment_id = a.id ";
    $query .= " INNER JOIN services s ON ad.service_id = s.id ";
    $query .= " WHERE appointment_date =  '{$fecha}' ";

    $citas = AppointmentServices::PrepareSQL($query);

    Router::render('admin/index', 'AdminLayout', [
      'title' => 'Inicio',
      'name' => $_SESSION['name'],
      'lastname' => $_SESSION['lastname'],
      'appointments' => $citas,
      'fecha' => $fecha
    ]);
  }
}
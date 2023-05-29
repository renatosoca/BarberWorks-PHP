<?php
namespace App\Controllers;

use App\Router;
use App\Models\CitasServicios;

class AdminController {

    public function index() {
        $isAdmin = isAdmin();
        if (!$isAdmin) Router::redirect('/');

        $fecha = $_GET['date'] ?? date('Y-m-d');
        $fechas = explode("-", $fecha);
        
        if( !$fechas = checkdate( $fechas[1], $fechas[2], $fechas[0]) ) {
          header('Location: /404');
        }

        $consulta = "SELECT a.id, a.appointment_time, CONCAT(u.name, ' ' ,u.lastname) as client, ";
        $consulta .= " u.email, u.phone, s.title as service, s.price  ";
        $consulta .= " FROM appointments a ";
        $consulta .= " INNER JOIN users u ON a.user_id = u.id";
        $consulta .= " INNER JOIN appointments_Details ad ON ad.appointment_id = a.id ";
        $consulta .= " INNER JOIN services s ON ad.service_id = s.id ";
        $consulta .= " WHERE appointment_date =  '{$fecha}' ";

        $citas = CitasServicios::PrepareSQL($consulta);

        Router::render('admin/index', 'AdminLayout', [
            'title' => 'Inicio',
            'name' => $_SESSION['name'],
            'lastname' => $_SESSION['lastname'],
            'appointments' => $citas,
            'fecha' => $fecha
        ]);
    }
}
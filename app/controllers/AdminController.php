<?php
namespace Controller;

use Model\CitasServicios;
use Router\Router;

class AdminController {
    public static function index( Router $router ) {
        session_start();
        isAdmin();

        $fecha = $_GET['date'] ?? date('Y-m-d');
        $fechas = explode("-", $fecha);
        
        if( !$fechas = checkdate( $fechas[1], $fechas[2], $fechas[0]) ) {
            header('Location: /404');
        }

        $consulta = "SELECT c.id, c.hora, CONCAT(u.nombre, ' ' ,u.apellido) as cliente, ";
        $consulta .= " u.email, u.telefono, s.nombre as servicio, s.precio  ";
        $consulta .= " FROM citas c ";
        $consulta .= " INNER JOIN usuarios u ON c.usuarioId=u.id";
        $consulta .= " INNER JOIN citasservicios cs ON cs.citasId=c.id ";
        $consulta .= " INNER JOIN servicios s ON cs.servicioId=s.id ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = CitasServicios::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
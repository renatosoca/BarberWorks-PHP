<?php
namespace Controller;

use Model\Servicio;
use Router\Router;

class ServicioController {

    public static function index( Router $router) {
        session_start();
        isAdmin();

        $servicios = Servicio::all();
    
        $router->render('admin/servicios', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear( Router $router ) {
        session_start();
        isAdmin();
        $alertas = [];
    
        $servicio = new Servicio;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicio($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicio/crear');
            }
        }
        
        $router->render('admin/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function editar( Router $router ) {
        session_start();
        isAdmin();
        $alertas = [];
        if (!is_numeric( $_GET['id'])) return;
    
        $servicio = Servicio::find( $_GET['id'] );
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicio');
            }
        }
        
        $router->render('admin/editar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();

            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}
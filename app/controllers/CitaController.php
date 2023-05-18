<?php
namespace Controller;

use Router\Router;

class CitaController {

    public static function index( Router $router) {
        session_start();

        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['usuarioId']
        ]);
    }
}
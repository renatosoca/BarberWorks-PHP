<?php
namespace App\Controllers;

use App\Models\Service;
use App\Router;

class ServiceController {

  public static function index() {
      session_start();

      $isAdmin = isAdmin();
      if (!$isAdmin) Router::redirect('/');

      $servicios = Service::findAll();
  
      Router::render('admin/servicios', '', [
          'nombre' => $_SESSION['nombre'],
          'servicios' => $servicios
      ]);
  }

  public static function crear() {
      session_start();
      isAdmin();
      $alertas = [];
  
      $servicio = new Service;
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $servicio = new Service($_POST);
          $alertas = $servicio->validate();
          if (empty($alertas)) {
              $servicio->save();
              header('Location: /servicio/crear');
          }
      }
      
      Router::render('admin/crear', '', [
          'nombre' => $_SESSION['nombre'],
          'servicio' => $servicio,
          'alertas' => $alertas
      ]);
  }

  public static function editar() {
      session_start();
      isAdmin();
      $alertas = [];
      if (!is_numeric( $_GET['id'])) return;
  
      $servicio = Service::findById( $_GET['id'] );
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $servicio->syncronize($_POST);
          $alertas = $servicio->validate();

          if (empty($alertas)) {
              $servicio->save();
              header('Location: /servicio');
          }
      }
      
      Router::render('admin/editar', '', [
          'nombre' => $_SESSION['nombre'],
          'servicio' => $servicio,
          'alertas' => $alertas
      ]);
  }

  public static function eliminar() {
      
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $id = $_POST['id'];
          $servicio = Service::findById($id);
          $servicio->eliminar();

          header('Location:'. $_SERVER['HTTP_REFERER']);
      }
  }
}
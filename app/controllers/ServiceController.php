<?php
namespace App\Controllers;

use App\Router;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\AppointmentsDetails;

class ServiceController {

  public function getAllServices() {
    $services = Service::findAll();
    
    return $services;
  }
  public function saveAppointment() {
    
    $appointment = new Appointment($_POST);
    $savedAppointment = $appointment->save();
    $appointmentID = $savedAppointment['id'];

    $servicesID = json_decode($_POST['services']);
    $servicesID = array_map('stripslashes', $servicesID);
    foreach ($servicesID as $serviceID) {
      $args = [
        'appointment_id' => $appointmentID,
        'service_id' => $serviceID
      ];
      $appointmentDetail = new AppointmentsDetails($args);
      $appointmentDetail->insert();
    }

    return ($servicesID);
  }
  public  function deleteAppointment() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $appointment = Appointment::findById($id);
      $appointment->delete();

      header('Location:'. $_SERVER['HTTP_REFERER']);
    }
  }


  public function index() {

    $isAdmin = isAdmin();
    if (!$isAdmin) Router::redirect('/');

    $services = Service::findAll();

    Router::render('admin/services', 'AdminLayout', [
      'title' => 'Listado de servicios',
      'name' => $_SESSION['name'],
      'lastname' => $_SESSION['lastname'],
      'services' => $services
    ]);
  }

  public function create() {
    $isAdmin = isAdmin();
    if (!$isAdmin) Router::redirect('/');

    $alerts = [];

    $service = new Service();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service = new Service($_POST);
      $alerts = $service->validate();
      
      if (empty($alerts)) {
        $service->save();
        header('Location: /admin/service/create');
      }
    }
    
    Router::render('admin/createService', 'AdminLayout', [
      'title' => 'Crear servicio',
      'name' => $_SESSION['name'],
      'lastname' => $_SESSION['lastname'],
      'service' => $service,
      'alerts' => $alerts
    ]);
  }

  public function update( $id = '') {
    $isAdmin = isAdmin();
    if (!$isAdmin) Router::redirect('/');
    $alerts = [];
    
    $service = Service::findById( $id );
    if (!$service) Router::redirect('/admin/services');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->synchronize($_POST);
      $alerts = $service->validate();

      if (empty($alerts)) {
        $service->save();
        header('Location: /admin/services');
      }
    }
    
    Router::render('admin/updateService', 'AdminLayout', [
      'title' => $service->title,
      'name' => $_SESSION['name'],
      'lastname' => $_SESSION['lastname'],
      'alerts' => $alerts,
      'service' => $service,
    ]);
  }

  public function delete() {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $service = Service::findById($id);
      $service->delete();

      header('Location:'. $_SERVER['HTTP_REFERER']);
    }
  }
}
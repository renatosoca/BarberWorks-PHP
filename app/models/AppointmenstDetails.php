<?php

namespace App\Models;

class AppointmentsDetails extends Model {

  protected static string $table = 'appointments_details';
  protected static array $columnsDB = ['id', 'appointment_id', 'service_id'];

  public string $id;
  public string $appointment_id;
  public string $service_id;

  public function __construct(array $args = []) {
    $this->id = $args['id'] ?? '';
    $this->appointment_id = $args['appointment_id'] ?? '';
    $this->service_id = $args['service_id'] ?? '';
  }

}
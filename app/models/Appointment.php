<?php

namespace App\Models;

class Appointment extends Model {

  protected static string $tabla = 'appointments';
  protected static array $columnasDB = ['id', 'appointment_date', 'appointment_time', 'user_id'];

  public string $id;
  public string $appointment_date;
  public string $appointment_time;
  public string $user_id;

  public function __construct(array $args = []) {
    $this->id = $args['id'] ?? '';
    $this->appointment_date = $args['appointment_date'] ?? '';
    $this->appointment_time = $args['appointment_time'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
  }

}
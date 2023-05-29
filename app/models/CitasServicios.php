<?php

namespace App\Models;

class CitasServicios extends Model {
  protected static string $table = 'appointments_details';
  protected static array $columnsDB = ['id', 'appointment_time', 'client', 'email', 'phone', 'service', 'price'];

  public string $id;
  public $appointment_time;
  public $client;
  public $email;
  public $phone;
  public $service;
  public $price;

  function __construct($args = []) {
    $this->id = $args['id'] ?? '';
    $this->appointment_time = $args['appointment_time'] ?? '';
    $this->client = $args['client'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->service = $args['service'] ?? '';
    $this->price = $args['price'] ?? '';
  }
}
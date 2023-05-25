<?php

namespace App\Models;

class CitasServicios extends Model {
  protected static $table = 'appointments_details';
  protected static $columnsDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

  public $id;
  public $hora;
  public $cliente;
  public $email;
  public $telefono;
  public $servicio;
  public $precio;

  function __construct($args = []) {
    $this->id = $args['id'] ?? '';
    $this->hora = $args['hora'] ?? '';
    $this->cliente = $args['cliente'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->servicio = $args['servicio'] ?? '';
    $this->precio = $args['precio'] ?? '';
  }
}
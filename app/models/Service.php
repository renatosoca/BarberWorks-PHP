<?php

namespace App\Models;

class Service extends Model {

  protected static string $tabla = 'services';
  protected static array $columnasDB = ['id', 'title', 'price'];

  public string $id;
  public string $title;
  public string $price;

  public function __construct(array $args = []) {
    $this->id = $args['id'] ?? '';
    $this->title = $args['title'] ?? '';
    $this->price = $args['price'] ?? '';
  }

  public function validate() {
    if (!$this->title) self::$alerts['error'][] = 'El título es obligatorio';
    if (!$this->price) self::$alerts['error'][] = 'El precio es obligatorio';
    if (!is_numeric( $this->price )) self::$alerts['error'][] = 'El precio tiene que ser numérico';

    return self::$alerts;
  }

}
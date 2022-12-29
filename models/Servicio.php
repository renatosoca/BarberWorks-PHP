<?php
namespace Model;

class Servicio extends ActiveRecord {
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'El Precio es Obligatorio';
        }
        if (!is_numeric( $this->precio )) {
            self::$alertas['error'][] = 'El Precio Tiene que ser Numerico';
        }

        return self::$alertas;
    }
}
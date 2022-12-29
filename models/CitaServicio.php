<?php
namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'citasId', 'servicioId'];

    public $id;
    public $citasId;
    public $servicioId;

    function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citasId = $args['citasId'] ?? null;
        $this->servicioId = $args['servicioId'] ?? null;
    }
}
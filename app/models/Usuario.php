<?php
namespace App\Models;

class Usuario extends Model {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'pass', 'telefono', 'admin', 'confirmado', 'token'];

    public string $id;
    public string $nombre;
    public string $apellido;
    public string $email;
    public string $pass;
    public string $telefono;
    public string $admin;
    public bool $confirmado;
    public string $token;

    public function __construct( array $args = []) {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->pass = $args['pass'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '';
        $this->confirmado = $args['confirmado'] ?? false;
        $this->token = $args['token'] ?? '';
    }

    public function validar() {
        if (!$this->nombre) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio';
        }
        if (!$this->telefono) {
            self::$alerts['error'][] = 'El Telefono es Obligatorio';
        }
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es Obligatorio';
        }
        if (strlen($this->pass) < 6) {
            self::$alerts['error'][] = 'El pass debe tener al menos 6 caracteres';
        }

        return self::$alerts;
    }

    public function validarUser() {
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es Obligatorio';
        }

        return self::$alerts;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }

        return self::$alerts;
    }

    public function validarPass() {
        if (!$this->pass) {
            self::$alerts['error'][] = 'La contraseña es Obligatorio';
        }
        if (strlen($this->pass) < 6) {
            self::$alerts['error'][] = 'El pass debe tener al menos 6 caracteres';
        }

        return self::$alerts; 
    }

    /* public function existeUsuario() {
        $query = "SELECT * FROM ". self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alerts['error'][] = 'El Usuario ya está registrado';
        }

        return $resultado;
    } */

    public function hashPassword() {
        $this->pass = password_hash($this->pass, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comporbarPassANDVerificado($pass) {
        $resultado = password_verify($pass, $this->pass);
        
        if (!$resultado || !$this->confirmado) {
            self::$alerts['error'][] = 'Contraseña incorrecto o falta verificar su E-mail';
        }else {
            return true;
        }
    }
}
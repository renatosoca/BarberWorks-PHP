<?php

namespace App\Controllers;

use App\Router;
use Classes\Email;
use App\Models\Usuario;

class LoginController {

    public static function login( Router $router ) {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Almacenar los datos del formulario
            $auth = new Usuario($_POST['login']);
            $alertas = $auth->validarUser();
            
            if (empty( $alertas )) {
                //Comprobar si existe el usuario
                $user = Usuario::findOne('email', $auth->email);
                if ($user) {
                    if ( $user->comporbarPassANDVerificado($auth->pass) ) {
                        session_start();
                        $_SESSION['usuarioId'] = $user->id;
                        $_SESSION['nombre'] = $user->nombre. " " .$user->apellido;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        if ($user->admin === "1") {
                            $_SESSION['admin'] = $user->admin;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::setAlert('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlert();
        $router->render("auth/login", [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function olvide( Router $router ) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario( $_POST['olvide'] );
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $user = Usuario::findOne('email', $auth->email);
                
                if ($user && $user->confirmado === "1") {
                    $user->crearToken();
                    $user->guardar();

                    $mail = new Email($user->email, $user->nombre, $user->token);
                    $resultado = $mail->enviarInstrucciones();
                    if ($resultado) {
                        Usuario::setAlert('exito', 'Revisa tu Email');
                    }
                } else {
                    Usuario::setAlert('error', 'El usuario no existe o no está confirmado');
                }
            }
        }
        
        $alertas = Usuario::getAlert();
        $router->render("auth/olvide", [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar( Router $router ) {
        $alertas = [];
        $error = false;
        $token = sanitize( $_GET['token'] );

        $user = Usuario::findOne('token', $token);
        if (empty($user)) {
            Usuario::setAlert('error', 'Token no Valido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pass = new Usuario($_POST['recuperar']);
            $alertas = $pass->validarPass();
            if (empty( $alertas )) {
                $user->pass = $pass->pass;
                $user->hashPassword();
                $user->token = '';
                
                $resultado = $user->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlert();
        $router->render('auth/recuperar', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear( Router $router ) {
        $user = new Usuario;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronize( $_POST['register'] );
            $alertas = $user->validar();

            if (empty($alertas)) {
                $resultado = /* $user->existeUsuario() ?? */ true;

                if (/* $resultado->num_rows */ $resultado) {
                    $alertas = Usuario::getAlert();
                } else {
                    $user->hashPassword();
                    $user->crearToken();

                    $mail = new Email($user->email, $user->nombre, $user->token);
                    $mail->enviarConfirmacion();
                    
                    $resultado = $user->save();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render("auth/registro", [
            'user' => $user,
            'alertas' => $alertas
        ]);
    }

    public static function confirmar( Router $router ) {
        $alertas = [];

        $token = sanitize( $_GET['token'] );

        $auth = Usuario::findOne('token', $token);

        if (empty( $auth ) || $auth->token === '') {
            Usuario::setAlert('error', 'Token no valido');
            
        } else {
            $auth->confirmado = "1";
            $auth->token = "";

            $auth->guardar();
            Usuario::setAlert('exito', 'Cuenta comprobada correctamente');
        }

        $alertas = Usuario::getAlert();
        $router->render('auth/confirmar', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje( Router $router ) {

        $router->render('auth/mensaje', [

        ]);
    }
}

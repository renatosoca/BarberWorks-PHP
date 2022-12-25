<?php

namespace Controller;

use Classes\Email;
use Model\Usuario;
use Router\Router;

class LoginController
{

    public static function login( Router $router ) {
        $alertas = [];
        $auth = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Almacenar los datos del formulario
            $auth = new Usuario($_POST['login']);
            $alertas = $auth->validarUser();
            
            if (empty( $alertas )) {
                //Comprobar si existe el usuario
                $user = Usuario::where('email', $auth->email);
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
                            header('Location: /citas');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/login", [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        echo "logout";
    }

    public static function olvide( Router $router ) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario( $_POST['olvide'] );
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $user = Usuario::where('email', $auth->email);
                
                if ($user && $user->confirmado === "1") {
                    debuguear("si existe");
                } else {
                    debuguear("no existe");
                }
            }
        }

        $router->render("auth/olvide", [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar() {
        echo "recuperar";
    }

    public static function crear( Router $router ) {
        $user = new Usuario;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sincronizar( $_POST['register'] );
            $alertas = $user->validar();

            if (empty($alertas)) {
                $resultado = $user->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    $user->hashPassword();
                    $user->crearToken();

                    $mail = new Email($user->email, $user->nombre, $user->token);
                    $mail->enviarConfirmacion();
                    
                    $resultado = $user->guardar();

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

        $token = s( $_GET['token'] );

        $auth = Usuario::where('token', $token);

        if (empty( $auth ) || $auth->token === '') {
            Usuario::setAlerta('error', 'Token no valido');
            
        } else {
            $auth->confirmado = "1";
            $auth->token = "";

            $auth->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje( Router $router ) {

        $router->render('auth/mensaje', [

        ]);
    }
}

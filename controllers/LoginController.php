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
            $auth = new Usuario($_POST['login']);
            $alertas = $auth->validarUser();
            
            if (empty( $alertas )) {
                
            }
        }

        $router->render("auth/login", [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }

    public static function logout() {
        echo "logout";
    }

    public static function olvide( Router $router ) {
        $router->render("auth/olvide", [

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

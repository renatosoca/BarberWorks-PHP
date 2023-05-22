<?php

namespace App\Controllers;

use App\Router;
use App\Models\User;

class AuthController {

  public function authUser(){
    $alerts = [];
    $user = new User();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User($_POST['login']);
      $alerts = $user->validateUser();

      if (empty($alerts)) {
        $user = User::findOne('email', $user->email);
        if ($user) {
          if ($user->verifyPassword($user->password)) {
            session_start();
            $_SESSION['userId'] = $user->id;
            $_SESSION['name'] = $user->name;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['email'] = $user->email;
            $_SESSION['login'] = true;

            if ($user->role !== 'admin') Router::redirect('/appointment');
            
            $_SESSION['admin'] = $user->role;
            Router::redirect('/admin');
          }
          
          User::setAlert('error', 'Email o contraseña incorrectos');

        } else {
          User::setAlert('error', 'No hay ningún usuario registrado con ese email');
        }
      }
    }

    $alerts = User::getAlerts();

    Router::render('auth/login', 'AuthLayout', [
      'title' => 'Iniciar sesión',
      'alerts' => $alerts,
      'user' => $user,
    ]);
  }

  public static function registerUser() {
    $user = new User();
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user->synchronize($_POST['register']);
      $alerts = $user->valitade();

      if (empty($alerts)) {
        $userExist = USer::findOne('email', $user->email);
        if ($userExist) {
          $alerts = User::getAlerts();
        } else {
          $user->hashPassword();
          $user->generateToken();

          //Send Mail

          $user->save();
          
          Router::redirect('/message-register');
        }
      }
    }

    Router::render('auth/register', 'AuthLayout', [
      'title' => 'Registro de usuario',
      'user' => $user,
      'alerts' => $alerts,
    ]);
  }

  public function confirmAccount( $token = '') {
    $alerts = [];
    $token = sanitize($token);
    $auth = User::findOne('token', $token);

    if ($auth && !$auth->token) {
      $auth->hasVerifiedEmail = true;
      $auth->token = '';

      $auth->save();

      User::setAlert('success', 'Tu cuenta ha sido verificada');
    } else {
      User::setAlert('error', 'El token es inválido');
    }

    $alerts = User::getAlerts();

    Router::render('auth/confirmAccount', 'AuthLayout', [
      'title' => 'Confirmar cuenta',
      'alerts' => $alerts,
    ]);
  }

  public function forgotPassword() {
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user = new User($_POST['forgot']);
      $alerts = $user->validateEmail();

      if (empty($alerts)) {
        $user = User::findOne('email', $user->email);

        if ($user && $user->hasVerifiedEmail) {
          $user->generateToken();
          $user->save();

          //Send Mail

          User::setAlert('success', 'Hemos enviado las instrucciones a tu Email');
        } else {
          User::setAlert('error', 'No hay ningún usuario registrado con ese email');
        }
      }
    }

    $alerts = User::getAlerts();

    Router::render('auth/forgotPassword', 'AuthLayout', [
      'title' => 'Recuperar contraseña',
      'alerts' => $alerts,
    ]);
  }

  public function resetPassword( $token = '' ) {
    $alerts = [];
    $token = sanitize($token);
    $error = false;

    $user = User::findOne('token', $token);
    if (!$user) {
      $error = true;
      User::setAlert('error', 'El token es inválido');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
      $tempUser = new User($_POST['newPassword']);
      $alerts = $tempUser->validatePassword();

      if (empty($alerts)) {
        $user->password = $tempUser->password;
        $user->hashPassword();
        $user->token = '';
        
        //Send Mail

        $user->save();

        Router::redirect('/');
      }
    }

    $alerts = User::getAlerts();

    Router::render('auth/resetPassword', 'AuthLayout', [
      'title' => 'Nueva contraseña',
      'alerts' => $alerts,
      'error' => $error,
    ]);
  }

}

?>
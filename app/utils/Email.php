<?php 
namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
  public string $email;
  public string $name;
  public string $lastname;
  public string $token;

  public function __construct($email, $name, $lastname, $token) {
    $this->email = $email;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->token = $token;
  }

  public function SendMail($template, $title, $buttonName, $href): bool {
    try {
      $mail = new PHPMailer();
  
      $mail->isSMTP();
      $mail->Host = $_ENV['EMAIL_HOST'];
      $mail->Port = ($_ENV['EMAIL_PORT']);
      $mail->SMTPAuth = true;
      $mail->Username = $_ENV['EMAIL_USER'];
      $mail->Password = $_ENV['EMAIL_PASS'];
      $mail->SMTPSecure = $_ENV['EMAIL_SECURE'];
  
      $mail->setFrom('u18215194@gmail.com', 'Renato Soca');
      $mail->addAddress($this->email,$this->name . ' '. $this->lastname);
      $mail->Subject = $buttonName;
      
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      $company = 'BarberWorks';
      
      ob_start();
      include_once __DIR__ . "/../views/emails/$template.php";
      $content = ob_get_clean();

      $mail->Body = $content;
      
      /* $content = '<html>';
      $content .= "<p>Hola <strong>" . $this->name . ' ' . $this->lastname . ", </strong>" ;
      $content .= "<p>Gracias por registrarte en BarberWorks, para confirmar tu cuenta, presiona el siguiente enlace:</p>";
      $content .= "<p>Presiona aquí: <a href=". $_ENV['HOST'] . "/confirm-account/" . $this->token ." >Confirmar cuenta</a></p>";
      $content .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
      $content .= "</html>"; */
  
      $response =  $mail->send();

      return $response;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
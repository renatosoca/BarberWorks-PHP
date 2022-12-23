<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        $mail = new PHPMailer();

        //CONFIG SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->SMTPAuth = true;
        $mail->Username = '4a8895ebea0bc9';
        $mail->Password = 'a24423000737a7';
        $mail->SMTPSecure = 'tls';

        //CONTENIDO DEL EMAIL
        $mail->setFrom('admin@appsalon.com');
        $mail->addAddress('rena@gmail.com','AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        
        //HABILITAR HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        //DEFINIR CONTENIDO
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en app salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token ."'>Confirmar cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Esto es Texto Alternativo sin HTML';

        //ENVIAR EMAIL
        $mail->send();
    }
}
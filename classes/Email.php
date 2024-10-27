<?php
    namespace Classes;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email{
        public $email;
        public $nombre;
        public $token;

        public function __construct($email, $nombre, $token)
        {
            $this->email=$email;
            $this->nombre=$nombre;
            $this->token=$token;
        }

        public function enviarConfirmacion(){
            $mail = new PHPMailer();

            //Server settings
            $mail->isSMTP();  
            $mail->Host       = $_ENV['EMAIL_HOST'];                     
            $mail->SMTPAuth   = true;  
            $mail->Port       = $_ENV['EMAIL_PORT'];                                 
            $mail->Username   = $_ENV['EMAIL_USER'];                     //SMTP username
            $mail->Password   = $_ENV['EMAIL_PASS'];                               //SMTP password
            
            $mail->setFrom('cuentas@appsalon.com');  
            $mail->addAddress('cuentas@appsalon.com','AppSalon.com');  
            $mail->Subject='confirma tu cuenta';
            
            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            $contenido="<html>";
            $contenido .="<p><strong>Hola : " . $this->nombre . "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .="<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=".$this->token."'>Confirmar Cuenta</a>   </p>"; 
            $contenido .="<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido .="</html>";

            $mail->Body=$contenido;

            $mail->send();
        }

        public function enviarInstrucciones(){
            $mail = new PHPMailer();

            //Server settings
            $mail->isSMTP();  
            $mail->Host       = $_ENV['EMAIL_HOST'];                     
            $mail->SMTPAuth   = true;  
            $mail->Port       = $_ENV['EMAIL_PORT'];                                 
            $mail->Username   = $_ENV['EMAIL_USER'];                     //SMTP username
            $mail->Password   = $_ENV['EMAIL_PASS'];                               //SMTP password
            
            $mail->setFrom('cuentas@appsalon.com');  
            $mail->addAddress('cuentas@appsalon.com','AppSalon.com');  
            $mail->Subject='Restablece tu password';
            
            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            $contenido="<html>";
            $contenido .="<p><strong>Hola : " . $this->nombre . "</strong> Has solicitado restablecer tu password sigue el siguiente enlace</p>";
            $contenido .="<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=".$this->token."'>Restablecer Password</a></p>"; 
            $contenido .="<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $contenido .="</html>";

            $mail->Body=$contenido;

            $mail->send();
        }
    }
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class MailService {
    public static function sendTestEmail($toEmail, $toName) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mailhog';        
            $mail->SMTPAuth = false;       
            $mail->Port = 1025;              

            // Configurer l'email
            $mail->setFrom('noreply@videgrenierenligne.com', 'Mailer');
            $mail->addAddress($toEmail, $toName);
            $mail->isHTML(true);                  
            $mail->Subject = 'Test d\'envoi d\'email';
            $mail->Body    = 'Ceci est un test d\'envoi d\'email via PHPMailer et MailHog.';

            // Envoi de l'email
            $mail->send();
            return "Le message a été envoyé avec succès";
        } catch (Exception $e) {
            return "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }
}

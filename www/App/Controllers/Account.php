<?php
namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Account extends \Core\Controller {
    public function accountPage() {
    }

    public function sendTestEmail() {
        var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "La méthode est bien appelée"; // Ajoutez ceci pour vérifier si la méthode est bien atteinte.
            exit();
            // Envoi de l'email via PHPMailer
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'mailhog';
                $mail->SMTPAuth = false;
                $mail->Port = 1025;
    
                $mail->setFrom('noreply@yourdomain.com', 'Mailer');
                $mail->addAddress('murierromain@gmail.com', 'Utilisateur Test');
                $mail->isHTML(true);
                $mail->Subject = 'Test d\'envoi d\'email';
                $mail->Body    = 'Ceci est un test d\'envoi d\'email via PHPMailer et MailHog.';
    
                $mail->send();
                echo 'Le message a été envoyé avec succès';
            } catch (Exception $e) {
                echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
            }
        }
    
        // Redirection après le traitement
        header('Location: /account');
        exit();
    }    
}

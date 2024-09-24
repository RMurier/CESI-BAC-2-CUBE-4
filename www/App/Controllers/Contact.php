<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Articles;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config;

class Contact extends \Core\Controller
{
    public function formAction()
    {
        // Récupérer l'ID de l'article et décoder le nom d'utilisateur
        $id = $this->route_params['id'];
        
        // Récupérer l'article par ID
        $article = Articles::getById($id);

        // Vérifier si l'article existe
        if (!$article) {
            throw new \Exception('Article non trouvé pour l\'ID : ' . $id);
        }
        
        // Rendre la vue avec les données nécessaires
        View::renderTemplate('Contact/form.html', [
            'article' => $article 
        ]);
    }

    // Ajout de la méthode pour traiter l'envoi de l'email
    public function sendAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'message' => $_POST['message'],
            ];

            // Récupération de l'article
            $article = Articles::getById($this->route_params['id']);

            // Appel de la méthode contact pour envoyer l'email
            if ($this->contact($data, $article)) {
                // Rediriger ou afficher un message de succès
                View::renderTemplate('Contact/success.html');
            } else {
                // Rediriger ou afficher un message d'erreur
                View::renderTemplate('Contact/failure.html');
            }
        }
    }

    // Fonction privée pour envoyer l'email
    private function contact($data, $article)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Informations personnelles
        $mail->Host = Config::SMTP_HOST;
        $mail->Port = Config::SMTP_PORT;
        $mail->Username = Config::SMTP_USER;
        $mail->Password = Config::SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        // Récupérer l'utilisateur destinataire
        $destUser = \App\Models\User::getOne($this->route_params['id']);
        $mail->addAddress($destUser['email']);
        
        // Expéditeur
        $mail->setFrom($data['email'], $data['name']);
        
        // Objet du mail
        $mail->Subject = "Demande info sur l'article : " . $article['name'];
        
        // Contenu du mail
        $mail->Body = $data['message'];

        // Envoi du mail
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}

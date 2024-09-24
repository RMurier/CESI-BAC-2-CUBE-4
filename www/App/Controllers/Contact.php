<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Articles; // Assurez-vous que cette ligne fait référence au bon modèle

class Contact extends \Core\Controller
{
    public function formAction()
    {
        // Récupérer l'ID du produit et décoder le nom d'utilisateur
        $id = $this->route_params['id'];

        $article = Articles::getById($id);
        
        View::renderTemplate('Contact/form.html', [
            'article' => $article
        ]);
    }
}
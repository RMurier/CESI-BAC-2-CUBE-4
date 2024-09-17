<?php

namespace App\Controllers;

use App\Models\Articles;
use \Core\View;
use Exception;

/**
 * Confidentialite controller
 */
class Confidentialite extends \Core\Controller
{

    /**
     * Affiche la page d'accueil
     *
     * @return void
     * @throws \Exception
     */
    public function politiqueAction()
    {
        View::renderTemplate('Confidentialite/politique.html', []);
    }
}

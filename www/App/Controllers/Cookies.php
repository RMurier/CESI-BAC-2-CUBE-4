<?php

namespace App\Controllers;

use App\Models\Articles;
use \Core\View;
use Exception;

/**
 * Cookies controller
 */
class Cookies extends \Core\Controller
{

    /**
     * Affiche la page d'accueil
     *
     * @return void
     * @throws \Exception
     */
    public function politiqueAction()
    {
        View::renderTemplate('Cookies/politique.html', []);
    }
}

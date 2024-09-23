<?php

namespace App\Controllers;

use App\Config;
use App\Models\UserRegister;
use App\Models\Articles;
use App\Utility\Hash;
use \Core\View;
use Exception;

/**
 * User controller
 */
class Search extends \Core\Controller
{
    /**
     * Affiche la page de login
     */
    public function searchAction()
    {
        $search_query = $this->route_params['name'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $search_query = $_POST['search'];
        }

        $articles = Articles::searchByName($search_query);

        View::renderTemplate('Recherche/index.html', [
            'articles' => $articles,
            'search_query' => $search_query
        ]);
    }

}

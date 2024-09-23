<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Statistics;

class Admin extends \Core\Controller
{
    /**
     * Affiche la page de statistiques
     */
    public function statisticsAction()
    {
        // Récupérer les statistiques depuis le modèle
        $total_users = Statistics::getTotalUsers();
        $total_admins = Statistics::getTotalAdmins();
        $total_products = Statistics::getTotalProducts();

        // Afficher la page des statistiques avec les données
        View::renderTemplate('Admin/statistics.html', [
            'total_users' => $total_users,
            'total_admins' => $total_admins,
            'total_products' => $total_products
        ]);
    }
}

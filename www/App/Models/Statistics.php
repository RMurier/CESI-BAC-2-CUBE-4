<?php

namespace App\Models;

use App\Utility\Hash;
use Core\Model;
use App\Core;
use Exception;
use App\Utility;

class Statistics extends Model
{
    /**
     * Retourne le nombre total d'utilisateurs
     *
     * @return int
     */
    public static function getTotalUsers()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM users');
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row['total'];
    }

    /**
     * Retourne le nombre total d'administrateurs
     *
     * @return int
     */
    public static function getTotalAdmins()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM users WHERE is_admin = 1');
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row['total'];
    }

    /**
     * Retourne le nombre total de produits
     *
     * @return int
     */
    public static function getTotalProducts()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(*) AS total FROM articles');
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $row['total'];
    }
}

<?php
namespace App\Models;

use PDO;

class User extends \Core\Model
{
    /**
     * Crée un utilisateur dans la base de données
     * 
     * @param array $data Tableau contenant 'email', 'username', 'password', 'salt'
     * 
     * @return int|bool Retourne l'ID de l'utilisateur créé, ou false en cas d'échec
     */
    public static function createUser($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare('
            INSERT INTO users (email, username, password, salt)
            VALUES (:email, :username, :password, :salt)
        ');

        // Lier les valeurs des paramètres
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], PDO::PARAM_STR);
        $stmt->bindValue(':salt', $data['salt'], PDO::PARAM_STR);

        // Exécuter et vérifier l'insertion
        if ($stmt->execute()) {
            return $db->lastInsertId();  // Retourner l'ID de l'utilisateur créé
        }

        return false;  // Retourner false en cas d'échec
    }

    /**
     * Récupère un utilisateur par email pour l'authentification
     * 
     * @param string $email L'email de l'utilisateur
     * 
     * @return array|bool Retourne les données de l'utilisateur ou false si non trouvé
     */
    public static function getByLogin($email)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Stocke un token de "remember me" pour l'auto-login
     * 
     * @param int $userID ID de l'utilisateur
     * @param string $token Token généré pour l'auto-login
     * @param int $expiry Timestamp de l'expiration du token
     * 
     * @return void
     */
    public static function storeRememberToken($userID, $token, $expiry)
    {
        $db = static::getDB();
        $stmt = $db->prepare('
            INSERT INTO user_tokens (user_id, token, expiry)
            VALUES (:user_id, :token, :expiry)
        ');

        $stmt->bindValue(':user_id', $userID, PDO::PARAM_INT);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':expiry', $expiry, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Récupère un utilisateur par token pour l'auto-login
     * 
     * @param string $token Le token "remember me"
     * 
     * @return array|bool Retourne les données de l'utilisateur ou false si non trouvé
     */
    public static function getUserByToken($token)
    {
        $db = static::getDB();
        $stmt = $db->prepare('
            SELECT users.* 
            FROM users 
            INNER JOIN user_tokens 
            ON users.id = user_tokens.user_id 
            WHERE user_tokens.token = :token 
            AND user_tokens.expiry > :now
        ');

        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->bindValue(':now', time(), PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

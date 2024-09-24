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
class User extends \Core\Controller
{
    /**
     * Affiche la page de login
     */
    public function loginAction()
    {
        if (isset($_POST['submit'])) {
            $f = $_POST;

            // Validation des informations d'authentification
            if ($this->login($f)) {
                // Si login OK, redirige vers le compte et arrête l'exécution
                header('Location: /account');
                exit;  // Assure-toi que le script s'arrête après la redirection
            } else {
                // Afficher un message d'erreur en cas d'échec de login
                View::renderTemplate('User/login.html', ['error' => 'Email ou mot de passe incorrect']);
            }
        } else {
            // Afficher la page de login si le formulaire n'est pas soumis
            View::renderTemplate('User/login.html');
        }
    }


    /**
     * Page de création de compte
     */
    public function registerAction()
    {
        if(isset($_POST['submit'])){
            $f = $_POST;

            if($f['password'] !== $f['password-check']){
                // Gestion d'erreur côté utilisateur
                View::renderTemplate('User/register.html', ['error' => 'Les mots de passe ne correspondent pas']);
                return;
            }

            // validation
            if ($this->register($f)) {
                // Connexion automatique après inscription
                $this->login($f);
                header('Location: /account');
            } else {
                View::renderTemplate('User/register.html', ['error' => 'Problème lors de l\'inscription']);
            }
        }

        View::renderTemplate('User/register.html');
    }

    /**
     * Affiche la page du compte
     */
    public function accountAction()
    {
        $articles = Articles::getByUser($_SESSION['user']['id']);
        $_SESSION['error_message'] = "dzazadazda";  // Stocker le message d'erreur
        header('Location: /'); // Rediriger vers la page où afficher l'erreur
        exit();
        View::renderTemplate('User/account.html', [
            'articles' => $articles
        ]);
    }

    /*
     * Fonction privée pour enregistrer un utilisateur
     */
    private function register($data)
    {
        try {
            // Générer un salt pour le hachage du mot de passe
            $salt = Hash::generateSalt(32);

            $userID = \App\Models\User::createUser([
                "email" => $data['email'],
                "username" => $data['username'],
                "password" => Hash::generate($data['password'], $salt),
                "salt" => $salt
            ]);

            return $userID;

        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Fonction pour authentifier l'utilisateur
     */
    private function login($data)
    {
        try {
            if (!isset($data['email']) || !isset($data['password'])) {
                throw new Exception('Identifiants manquants');
            }

            $user = \App\Models\User::getByLogin($data['email']);

            if (!$user) {
                throw new Exception('Utilisateur non trouvé');
            }

            // Vérification du mot de passe
            if (Hash::generate($data['password'], $user['salt']) !== $user['password']) {
                throw new Exception('Mot de passe incorrect');
            }

            // Stocker les infos de l'utilisateur dans la session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin']
            ];

            // Si l'utilisateur a coché "remember me", créer un cookie
            if (isset($data['remember_me']) && $data['remember_me'] == 'on') {
                $this->createRememberMeCookie($user['id']);
            }

            return true;

        } catch (Exception $ex) {
            // Afficher l'erreur pour déboguer
            echo "Erreur lors de la connexion : " . $ex->getMessage();
            return false;
        }
    }


    /**
     * Création d'un cookie pour l'auto login
     */
    private function createRememberMeCookie($userID)
    {
        // Générer un token
        $token = bin2hex(random_bytes(16));
        $expiry = time() + (86400 * 2); // 2 jours

        // Stocker le token dans la base de données
        \App\Models\User::storeRememberToken($userID, $token, $expiry);

   }

    /**
     * Fonction pour vérifier le cookie et reconnecter automatiquement l'utilisateur
     */
    public static function autoLogin()
    {
        if (isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];

            // Vérifier le token dans la base de données
            $user = \App\Models\User::getUserByToken($token);

            if ($user) {
                // Reconnecter l'utilisateur
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'is_admin' => $user['is_admin']
                ];

                return true;
            }
        }

        return false;
    }

    /**
     * Logout: Supprimer le cookie et la session
     */
    public function logoutAction()
    {
        // Supprimer les cookies et la session
        if (isset($_COOKIE['remember_me'])) {
            setcookie('remember_me', '', time() - 3600, '/');
        }

        $_SESSION = array();
        session_destroy();

        header("Location: /");
    }
}

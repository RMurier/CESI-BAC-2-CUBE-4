<?php

namespace App\Models;

use Core\Model;
use App\Core;
use DateTime;
use Exception;
use App\Utility;

/**
 * Articles Model
 */
class Articles extends Model {

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getAll($filter) {
        $db = static::getDB();

        $query = 'SELECT * FROM articles ';

        switch ($filter){
            case 'views':
                $query .= ' ORDER BY articles.views DESC';
                break;
            case 'data':
                $query .= ' ORDER BY articles.published_date DESC';
                break;
            case '':
                break;
        }

        $stmt = $db->query($query);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getOne($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT 
                user.id as idUser,
                user.username as username,
                user.email as email,
                user.password as password,
                user.salt as salt,
                user.is_admin as is_admin,
                articles.id as idArticle,
                articles.name as name,
                articles.description as description,
                articles.published_date as published_date,
                articles.views as views,
                articles.picture as picture
            FROM articles
            INNER JOIN users as user ON articles.user_id = user.id
            WHERE articles.id = ? 
            LIMIT 1');
        
        $stmt->execute([$id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT * FROM articles
            WHERE articles.id = ? 
            LIMIT 1');

        $stmt->execute([$id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function addOneView($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            UPDATE articles 
            SET articles.views = articles.views + 1
            WHERE articles.id = ?');

        $stmt->execute([$id]);
    }

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getByUser($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT *, articles.id as id FROM articles
            LEFT JOIN users ON articles.user_id = users.id
            WHERE articles.user_id = ?');

        $stmt->execute([$id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getSuggest() {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT *, articles.id as id FROM articles
            INNER JOIN users ON articles.user_id = users.id
            ORDER BY published_date DESC LIMIT 10');

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    /**
     * Recherche les articles (ou produits) par nom
     *
     * @param string $name Le terme de recherche
     * @return array Les articles correspondants
     */
    public static function searchByName($name)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM articles WHERE name LIKE :name');        
        $stmt->execute([':name' => '%' . $name . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     * ?
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function save($data) {
        $db = static::getDB();

        $stmt = $db->prepare('INSERT INTO articles(name, description, user_id, published_date) VALUES (:name, :description, :user_id,:published_date)');

        $published_date =  new DateTime();
        $published_date = $published_date->format('Y-m-d');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':published_date', $published_date);
        $stmt->bindParam(':user_id', $data['user_id']);

        $stmt->execute();

        return $db->lastInsertId();
    }

    public static function attachPicture($articleId, $pictureName){
        $db = static::getDB();

        $stmt = $db->prepare('UPDATE articles SET picture = :picture WHERE articles.id = :articleid');

        $stmt->bindParam(':picture', $pictureName);
        $stmt->bindParam(':articleid', $articleId);


        $stmt->execute();
    }
}
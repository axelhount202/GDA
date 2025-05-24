<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    // Instance unique de la classe
    private static $instance = null;
    private $connection;

    private $host = 'localhost';
    private $db_name = 'gda';
    private $username = 'root';
    private $password = '';

    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur MySQL : " . $e->getMessage());
        }
    }

    // Méthode statique pour récupérer la connexion PDO
    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
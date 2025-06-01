<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Exception;

class Relances {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function createNewRelance($id) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO Relances (Id_Cahier) VALUES (?)"
            );
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erreur SQL - createNewRelance() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - createNewRelance() : " . $e->getMessage());
            return false;
        }
    }
        
    public function getAllRelances() {
        try {
            $stmt = $this->pdo->query(
                "SELECT C.Intitule, R.Created_at
                 FROM Relances R
                 JOIN Cahiers C ON R.Id_Cahier = C.ID
                 WHERE R.Id_Cahier NOT IN (SELECT Id_Cahier FROM Affectations)"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Erreur SQL - getAllRelances() : " . $e->getMessage());
            return [];
        }
    } 
}

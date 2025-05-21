<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Professeurs {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Trouver un professeur par son ID
    public function getProfesseurById($id) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM Professeurs WHERE ID = ?"
            );
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL - getProfesseurById() : " . $e->getMessage());
            return false;
        }
    }  

    // Récupérer tous les professeurs non affectés a un cahier
    public function getNonAssignedProfesseurs() {
        try {
            $stmt = $this->pdo->query(
                "SELECT * FROM Professeurs WHERE ID NOT IN (SELECT Id_Professeur FROM Affectations)"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch(PDOException $e) {
            error_log("Erreur SQL - getNonAssignedProfesseurs() : " . $e->getMessage());
            return [];
        }
    }
}
?>
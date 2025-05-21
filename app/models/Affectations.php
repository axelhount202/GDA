<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Exception;

class Affectations {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Insérer une nouvelle affectation entre un professeur et un cahier des charges
    public function createNewAssignment($Id_Cahier, $Id_Professeur,) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO Affectations (Id_Cahier, Id_Professeur) VALUES (?, ?)"
            );
            $stmt->execute([$Id_Cahier, $Id_Professeur]);

            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur SQL - createNewAssignment() : " . $e->getMessage());
            return false;
        }  catch (Exception $e) {
            error_log("Erreur - createNewAssignment() : " . $e->getMessage());
            return false;
        }
    }

    // Obtenir l'id d'un professeur en fonction du cahier qui lui est affecté
    public function getProfesseurByCahierId($ID_Cahier) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT Id_Professeur FROM Affectations WHERE Id_Cahier = ?"
            );
            $stmt->execute([(int)$ID_Cahier]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL - getProfesseurByCahierId : " . $e->getMessage());
            return false;
        }
    } 
}
?>
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

    public function createProfesseur($professor_lastname, $professor_surname, $professor_skill, $professor_phone_number) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT COUNT(*) FROM Professeurs WHERE Nom = ? AND Prenom = ?"
            );
            $stmt->execute([$professor_lastname, $professor_surname]);

            if ($stmt->fetchColumn() > 0) {
                return false;
            }

            $stmt = $this->pdo->prepare(
                "INSERT INTO Professeurs (Nom, Prenom, Competence, Telephone) VALUES (?, ?, ?, ?)"
            );
            return $stmt->execute([$professor_lastname, $professor_surname, $professor_skill, $professor_phone_number]);
        } catch (PDOException $e) {
            error_log("Erreur SQL - createProfesseur() : " . $e->getMessage());
        }
    }

    public function getProfesseurById($professor_id) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM Professeurs WHERE ID = ?"
            );
            $stmt->execute([$professor_id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL - getProfesseurById() : " . $e->getMessage());
            return false;
        }
    }
    
    public function getAllProfesseur() {
        try {
            $stmt = $this->pdo->query(
                "SELECT ID, Nom, Prenom, Competence FROM Professeurs"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        }catch (PDOException $e) {
            error_log("Erreur SQL - getAllProfesseur() : " . $e->getMessage());
            return false;
        }
    }

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

    public function updateProfesseur($professor_id, $professor_lastname, $professor_surname, $professor_skill, $professor_phone_number) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT COUNT(*) FROM Professeurs WHERE Nom = ? AND Prenom = ? AND ID != ?"
            );
            $stmt->execute([$professor_lastname, $professor_surname, $professor_id]);

            if ($stmt->fetchColumn() > 0) {
                return false;
            }

            $stmt = $this->pdo->prepare(
                "UPDATE Professeurs SET Nom = ?, Prenom = ?, Competence = ?, Telephone = ?
                 WHERE ID = ?"
            );
            return $stmt->execute([$professor_lastname, $professor_surname, $professor_skill, $professor_phone_number, $professor_id]);
        } catch (PDOException $e) {
            error_log("Erreur SQL - updateProfesseur() : " . $e->getMessage());
            return false;
        }
    }

    public function deleteProfesseur($professor_id) {
        try {
            $stmt = $this->pdo->prepare(
                "DELETE FROM Professeurs WHERE ID = ?"
            );
            $stmt->execute([$professor_id]);
        } catch (PDOException $e) {
            error_log("Erreur SQL - deleteProfesseur() : " . $e->getMessage());
            return false;
        }
    }
}

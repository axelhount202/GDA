<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Exception;

class Cahiers {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Insérer un nouveau cahier
    public function createNewCahier($nom_binome, $prenom_binome, $filiere_binome, $intitule, $domaine, $chemin_pdf, $id_utilisateur) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO Cahiers (Nom_binome, Prenom_binome, Filiere_binome, Intitule, Domaine, Chemin_PDF, Id_Utilisateur) VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$nom_binome, $prenom_binome, $filiere_binome, $intitule, $domaine, $chemin_pdf, $id_utilisateur]);
            
            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur SQL - createNewCahier() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - createNewCahier() : " . $e->getMessage());
            return false;
        }
    }

    // Trouver un cahier par son Id
    public function getCahierById($id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM Cahiers WHERE ID = ?"
            );
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Erreur - getCahierById() : " . $e->getMessage());
            return false;
        }

    }

    // Trouver un cahier grâce au compte utilisateur qui l'a créé
    public function getCahierByUtilisateurId($ID_Utilisateur) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM Cahiers WHERE Id_Utilisateur = ?"
            );
            $stmt->execute([$ID_Utilisateur]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Errereur - getCahierByUtilisateurId() : " . $e->getMessage());
            return false;
        }
    }
    
    // Récupérer tous les cahiers non affectés a un professeur
    public function getNonAffectedCahiers() {
        try {
            $stmt = $this->pdo->query(
                "SELECT * FROM Cahiers WHERE ID NOT IN (SELECT Id_Cahier FROM Affectations)"
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Erreur - getNonAffectedCahiers() : " . $e->getMessage());
            return false;
        }
    }
}
?>
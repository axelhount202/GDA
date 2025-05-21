<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;
use Exception;

class Utilisateurs {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Inserer un nouveau compte utilisateur
    public function createNewUser($lastname, $surname, $email, $password, $field, $role) {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare(
                "INSERT INTO Utilisateurs (Nom, Prenom, Email, Mot_de_passe, Filiere, Role) VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->execute([$lastname, $surname, $email, $hash, $field, $role]);
    
            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur SQL - createNewUser() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - createNewUser() : " . $e->getMessage());
            return false;
        }
    }
    

    // Pour la creation d'un nouveau compte : vérifier si l'email fourni est déjà utilisé
    public function checkEmail($email) {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM Utilisateurs WHERE Email = ?");
            $stmt->execute([$email]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur - checkEmail() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - checkEmail() : " . $e->getMessage());
            return false;
        }
    }

    // Pour le login : vérifier si l'email fourni existe dans la BD
    public function checkUserCredentials($email, $password) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT ID, Mot_de_passe FROM Utilisateurs WHERE Email = ?"
            );
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['Mot_de_passe'])) {
                return $user['ID'];
            }
        } catch (PDOException $e) {
            error_log("Erreur - checkUserCredentials() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - checkUserCredentials() : " . $e->getMessage());
            return false;
        }
    }

    // Obtenir le role d'un utilisateur en fonction de son id
    public function getRoleById($id) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT Role FROM Utilisateurs WHERE ID = ?"
            );
            $stmt->execute([$id]);

            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Erreur SQL - getRoleById() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - getRoleById() : " . $e->getMessage());
            return false;
        }
    }

    // Obtenir la filiere d'un étudiant en fonction de son id
    public function getFieldById($id) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT Filiere FROM Utilisateurs WHERE ID = ?"
            );
            $stmt->execute([$id]);
            
            return $stmt->fetchColumn();        
        } catch (PDOException $e) {
            error_log("Erreur - getFieldById() : " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Erreur - getFieldById() : " . $e->getMessage());
            return false;
        }
    }
}
?>
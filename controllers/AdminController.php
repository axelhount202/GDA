<?php
require_once __DIR__ . '/../config/database.php';

class AdminController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste des étudiants
    public function listEtudiants()
    {
        $stmt = $this->pdo->query("SELECT * FROM Utilisateur WHERE Role = 'etudiant'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Liste des cahiers des charges
    public function listCahiers()
    {
        $stmt = $this->pdo->query("SELECT * FROM Cahiers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Assigner un encadreur à un étudiant
    public function assignEncadreur($cahierId, $professeurId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Affectation (ID_Cahier, ID_Professeur)
            VALUES (:id_cahier, :id_professeur)
        ");
        return $stmt->execute(['id_cahier' => $cahierId, 'id_professeur' => $professeurId]);
    }

    // Relancer l'attribution d'un encadreur
    public function listRelances()
    {
        $stmt = $this->pdo->query("SELECT * FROM Relance");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

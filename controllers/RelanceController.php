<?php
require_once __DIR__ . '/../config/database.php';

class RelanceController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste des relances
    public function index()
    {
        $stmt = $this->pdo->query("
            SELECT R.*, C.Intitulle
            FROM Relance R
            JOIN Cahiers C ON R.ID_Cahier = C.ID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Relancer pour une affectation
    public function store($cahierId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Relance (ID_Cahier)
            VALUES (:id_cahier)
        ");
        return $stmt->execute(['id_cahier' => $cahierId]);
    }

    // Supprimer une relance
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Relance WHERE ID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>

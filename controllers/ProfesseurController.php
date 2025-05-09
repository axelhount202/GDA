<?php
require_once __DIR__ . '/../config/database.php';

class ProfesseurController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste des professeurs
    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM Professeur");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un professeur
    public function store($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Professeur (Nom, Prenom, Competence, Telephone)
            VALUES (:nom, :prenom, :competence, :telephone)
        ");
        return $stmt->execute($data);
    }

    // Afficher un professeur
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Professeur WHERE ID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mise à jour d'un professeur
    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE Professeur SET
            Nom = :nom, Prenom = :prenom, Competence = :competence, Telephone = :telephone
            WHERE ID = :id
        ");
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Supprimer un professeur
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Professeur WHERE ID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>

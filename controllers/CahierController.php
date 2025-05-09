<?php
require_once __DIR__ . '/../config/database.php';

class CahierController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste des cahiers
    public function index()
    {
        $stmt = $this->pdo->query("
            SELECT C.*, U.Nom AS EtudiantNom, U.Prenom AS EtudiantPrenom
            FROM Cahiers C
            JOIN Utilisateur U ON C.ID_Utilisateur = U.ID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un cahier
    public function store($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Cahiers (Nom_binome, Prenom_binome, Filiere_binome, ID_Utilisateur, Intitulle, Domaine, Chemin_PDF)
            VALUES (:nom_binome, :prenom_binome, :filiere_binome, :id_utilisateur, :intitulle, :domaine, :chemin_pdf)
        ");
        return $stmt->execute($data);
    }

    // Afficher un cahier
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Cahiers WHERE ID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Supprimer un cahier
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Cahiers WHERE ID = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>

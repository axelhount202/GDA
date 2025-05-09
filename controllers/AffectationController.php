<?php
require_once __DIR__ . '/../config/database.php';

class AffectationController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Liste des affectations
    public function index()
    {
        $stmt = $this->pdo->query("
            SELECT A.*, C.Intitulle, P.Nom AS ProfesseurNom, P.Prenom AS ProfesseurPrenom
            FROM Affectation A
            JOIN Cahiers C ON A.ID_Cahier = C.ID
            JOIN Professeur P ON A.ID_Professeur = P.ID
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Assigner un professeur à un cahier
    public function store($cahierId, $professeurId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Affectation (ID_Cahier, ID_Professeur)
            VALUES (:id_cahier, :id_professeur)
        ");
        return $stmt->execute([
            'id_cahier' => $cahierId,
            'id_professeur' => $professeurId,
        ]);
    }

    // Supprimer une affectation
    public function delete($cahierId, $professeurId)
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM Affectation
            WHERE ID_Cahier = :id_cahier AND ID_Professeur = :id_professeur
        ");
        return $stmt->execute([
            'id_cahier' => $cahierId,
            'id_professeur' => $professeurId,
        ]);
    }
}
?>

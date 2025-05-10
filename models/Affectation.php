<?php
class Affectation {
    private $pdo;
    private $table = "Affectations";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function assign($idCahier, $idProfesseur) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table}
            (ID_Cahier, ID_Professeur) VALUES (?, ?)");
        return $stmt->execute([$idCahier, $idProfesseur]);
    }

    public function findByCahier($idCahier) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ID_Cahier = ?");
        $stmt->execute([$idCahier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

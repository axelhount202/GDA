<?php
class Cahier {
    private $pdo;
    private $table = "Cahiers";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function submit($idUtilisateur, $theme, $binome = null) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table}
            (ID_Utilisateur, Theme, Binome) VALUES (?, ?, ?)");
        return $stmt->execute([$idUtilisateur, $theme, $binome]);
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUser($idUtilisateur) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ID_Utilisateur = ?");
        $stmt->execute([$idUtilisateur]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

<?php
class Relance {
    private $pdo;
    private $table = "Relances";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function relancer($idCahier) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (ID_Cahier, DateRelance) VALUES (?, NOW())");
        return $stmt->execute([$idCahier]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCahier($idCahier) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ID_Cahier = ?");
        $stmt->execute([$idCahier]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

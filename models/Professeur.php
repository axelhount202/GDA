<?php
class Professeur {
    private $pdo;
    private $table = "Professeur";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($nom, $prenom, $competences) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} 
            (Nom, Prenom, Competences) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $prenom, json_encode($competences)]);
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

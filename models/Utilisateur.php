<?php
class Utilisateur {
    private $pdo;
    private $table = "Utilisateur";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

   
    public function register($nom, $prenom, $email, $password, $filiere, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} 
            (Nom, Prenom, Email, Password, Filiere, Role) 
            VALUES (?, ?, ?, ?, ?, ?)");

        return $stmt->execute([
            $nom,
            $prenom,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $role === 'etudiant' ? $filiere : null,
            $role
        ]);
    }

   
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            return $user;
        }

        return false;
    }

    
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE ID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getCahiers($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM cahiers WHERE ID = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
<?php
require_once "config/database.php";

class UtilisateurController {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function index() {
        $query = "SELECT * FROM Utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id) {
        $query = "SELECT * FROM Utilisateur WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO Utilisateur (Nom, Prenom, Email, Password, Filiere, Role) VALUES (:nom, :prenom, :email, :password, :filiere, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom", $data['Nom']);
        $stmt->bindParam(":prenom", $data['Prenom']);
        $stmt->bindParam(":email", $data['Email']);
        $stmt->bindParam(":password", $data['Password']);
        $stmt->bindParam(":filiere", $data['Filiere']);
        $stmt->bindParam(":role", $data['Role']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE Utilisateur SET Nom = :nom, Prenom = :prenom, Email = :email, Filiere = :filiere, Role = :role WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $data['Nom']);
        $stmt->bindParam(":prenom", $data['Prenom']);
        $stmt->bindParam(":email", $data['Email']);
        $stmt->bindParam(":filiere", $data['Filiere']);
        $stmt->bindParam(":role", $data['Role']);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM Utilisateur WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}

<?php
namespace App\Controllers;

use App\Models\Utilisateurs;

class RegisterController {
    // Affichage de la page d'inscription
    public function showRegisterPage() {
        require __DIR__ . '/../Views/auth/register.php';
    }

    // Traitement du formulaire d'inscription
    public function handleRegistration() {
        // Données issues du formulaire
        $lastname = htmlspecialchars(trim($_POST['lastname'] ?? ''));
        $surname = htmlspecialchars(trim($_POST['surname'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password'] ?? '');
        $role = htmlspecialchars(trim($_POST['role'] ?? ''));

        $field = $role === 'admin' ? NULL : htmlspecialchars(trim($_POST['field'] ?? ''));

        unset($_SESSION['message']);

        if (empty($lastname) || empty($surname) || empty($email) || empty($password) || empty($role)) {
            $_SESSION['message']['require'] = [
                'type' => 'alert-danger', 
                'message' => "Tous les champs requis doivent être remplis !"
            ];
        }

        if ($role === 'etudiant' && empty($field)) {
            $_SESSION['message']['field'] = [
                'type' => 'alert-danger', 
                'message' => "La filière est obligatoire pour un étudiant !"
            ];
        }

        $utilisateurs = new Utilisateurs();

        if ($utilisateurs->checkEmail($email)) {
            $_SESSION['message']['email'] = [
                'type' => 'alert-danger', 
                'message' => "L' email '<strong>$email</strong>' est déjà utilisé."
            ];
        }

        if (isset($_SESSION['message']['require']) || isset($_SESSION['message']['field']) || isset($_SESSION['message']['email'])) {
            header('Location: /register');
            exit;
        }

        $user = $utilisateurs->createNewUser($lastname, $surname, $email, $password, $field, $role);
        $_SESSION['user'] = [
            'id' => $user
        ];

        // Redirection en fonction du rôle
        if ($role === 'admin') {
            header('Location: /admin');
        } else {
            header('Location: /etudiant');
        }
        exit;
    }
}

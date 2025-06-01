<?php
namespace App\Controllers;

use App\Models\Utilisateurs;

class AuthController {
    // Fonction qui affiche la page de login
    public function showLoginPage() {
        require __DIR__ . '/../Views/auth/login.php';
    }

    // Traitement des données fournies dans le formulaire
    public function handleLogin() {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        $utilisateurs = new Utilisateurs();
        $user_id = $utilisateurs->checkUserCredentials($email, $password);

        // Authentification réussie
        if ($user_id) {
            $_SESSION['user'] = [
                'id' => $user_id
            ];

            // Redirection vers les pages en fonction du rôle
            if ($utilisateurs->getRoleById($user_id) === 'admin') {
                header('Location: /admin');
            } else {
                header('Location: /etudiant');
            }
            exit;
        } else {
            // Authentification échouée
            unset($_SESSION['message']);
            $_SESSION['message'] = [
                'type' => 'alert-danger',
                'message' => "Identifiants incorrects."
            ];
            header('Location: /login');
            exit;
        }
    }

    // Gestion de la déconnection à un compte
    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }
}

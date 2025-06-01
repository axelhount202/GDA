<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Démarrage sécurisé de la session avec des restrictions
session_start([
    // 'cookie_httponly' => true,
    // 'cookie_secure' => true,
    // 'cookie_samesite' => 'Strict',
    'use_strict_mode' => true,
    'use_only_cookies' => true,
    'gc_maxlifetime' => 1800
]);

use App\Controllers\AdminController;
use App\Controllers\AssignController;
use App\Controllers\ProfessorsController;
use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\EtudiantController;
use App\Controllers\InformationController;

use App\Models\Utilisateurs;

// Chargement de toutes les classes pour l'utilisation des namespaces
require_once __DIR__ . '/../vendor/autoload.php';

$routes = [
    'GET' => [
        '/' => [AuthController::class, 'showLoginPage'],
        '/login' => [AuthController::class, 'showLoginPage'],
        '/register' => [RegisterController::class, 'showRegisterPage'],
        // Routes administrateur
        '/admin' => [AdminController::class, 'showAdminPage'],
        '/admin/affectations' => [AssignController::class, 'showAssignmentPage'],
        '/admin/professeurs' => [ProfessorsController::class, 'showProfessorsPage'],
        '/admin/professeurs/creer' => [ProfessorsController::class, 'showNewProfessorPage'],
        '/admin/professeurs/modifier' => [ProfessorsController::class, 'showProfessorsUpdatePage'],
        // Routes étudiant
        '/etudiant' => [EtudiantController::class, 'showEtudiantPage'],
        '/etudiant/statu' => [InformationController::class, 'showStatuPage'],
        // Erreurs
        '/errors/404' => function() {
            require __DIR__ . '/../app/Views/errors/404_error.php';
        },
        '/errors/500' => function() {
            require __DIR__ . '/../app/Views/errors/500_error.php';
        }
    ],
    'POST' => [
        '/login' => [AuthController::class, 'handleLogin'],
        '/register' => [RegisterController::class, 'handleRegistration'],
        '/logout' => [AuthController::class, 'logout'],
        // Routes administrateur
        '/admin/affectations' => [AdminController::class, 'assignCahierToProfesseur'],
        '/admin/affectations/supprimer' => [AssignController::class, 'deleteAssignment'],
        '/admin/professeurs/creer' => [ProfessorsController::class, 'createProfessor'],
        '/admin/professeurs/valeurspardefaut' => [ProfessorsController::class, 'insertDefalutProfessors'],
        '/admin/professeurs/modifier' => [ProfessorsController::class, 'modifyProfessor'],
        '/admin/professeurs/supprimer' => [ProfessorsController::class, 'deleteProfessor'],
        // Routes étudiant
        '/etudiant/envoyer' => [EtudiantController::class, 'sendCahier'],
        '/etudiant/statu/relance' => [InformationController::class, 'sendRelance'],
        '/etudiant/statu/supprimer' => [InformationController::class, 'deleteCahierData']
    ]      
];

// Réception de la requête d'un utilisateur
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];

    // Traitement pour l'exécution du controlleur adéquat
    if (is_array($route)) {
        [$controllerClass, $action] = $route;

        // Fonction pour la protection des routes
        function checkRole($role) {
            try {
                if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
                    $_SESSION = [];
                    session_destroy();
                    header('Location: /login');
                    exit;
                }

                $utilisateurs = new Utilisateurs();
                $user_role = $utilisateurs->getRoleById($_SESSION['user']['id']);
    
                if (!isset($_SESSION['user']['id']) || $user_role === false || $user_role !== $role) {
                    $_SESSION = [];
                    session_destroy();
                    header('Location: /login');
                    exit;
                }
            } catch (Exception $e) {
                error_log("Erreur - checkRole() : " . $e->getMessage());
                http_response_code(500);
                header ('Location: /errors/500');
                exit;
            }
        }

        if ($uri === '/admin' || 
            $uri === '/admin/affectations' || 
            $uri === '/admin/affectations/supprimer' ||
            $uri === '/admin/professeurs' ||
            $uri === '/admin/professeurs/creer' ||
            $uri === '/admin/professeurs/modifier' ||
            $uri === '/admin/professeurs/supprimer') {
            checkRole('admin');
        }

        if ($uri === '/etudiant' || 
            $uri === '/etudiant/statu' || 
            $uri === '/etudiant/envoyer' || 
            $uri === '/etudiant/statu/relance') {
            checkRole('etudiant');
        }

        $controller = new $controllerClass();
        $controller->$action();
    } else {
        if ($route instanceof Closure) {
            $route();
        } else {
        require_once $route;
        }
    }
} else {
    http_response_code(404);
    header('Location: /errors/404');
    exit;
}

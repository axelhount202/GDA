<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start([
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict',
    'use_strict_mode' => true,
    'use_only_cookies' => true,
    'gc_maxlifetime' => 1800
]);

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\EtudiantController;
use App\Controllers\InformationController;
use App\Models\Utilisateurs;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = [
    'GET' => [
        '/' => [AuthController::class, 'showLoginPage'],
        '/login' => [AuthController::class, 'showLoginPage'],
        '/register' => [RegisterController::class, 'showRegisterPage'],
        '/admin' => [AdminController::class, 'showAdminPage'],
        '/etudiant' => [EtudiantController::class, 'showEtudiantPage'],
        '/statu' => [InformationController::class, 'showStatuPage'],
        '/errors/404' => function() {
            require __DIR__ . '/../app/views/errors/404_error.php';
        },
        '/errors/500' => function() {
            require __DIR__ . '/../app/views/errors/500_error.php';
        }
    ],
    'POST' => [
        '/login' => [AuthController::class, 'handleLogin'],
        '/register' => [RegisterController::class, 'handleRegistration'],
        '/logout' => [AuthController::class, 'logout'],
        '/admin/affectation' => [AdminController::class, 'assignCahierToProfesseur'],
        '/etudiant/envoyer' => [EtudiantController::class, 'sendCahier'],
        '/statu/relance' => [InformationController::class, 'sendRelance']
    ]      
];

// Recéption de la requete utilisateur
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$uri])) {
    $route = $routes[$method][$uri];

    // Traitement pour les controlleurs
    if (is_array($route)) {
        [$controllerClass, $action] = $route;

        // Fonction pour la protection des routes
        function checkRole($role) {
            try {
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

        if ($uri === '/admin' || $uri === '/admin/affectation') {
            checkRole('admin');
        }

        if ($uri === '/etudiant' || $uri === '/etudiant/envoyer' || $uri === '/etudiant/relance') {
            checkRole('etudiant');
        }

        $controller = new $controllerClass();
        $controller->$action();
    } else {
        if ($route instanceof Closure) {
            $route();
        } else {
        // Traitement pour les fonctions anonymes
        require_once $route;
        }
    }
} else {
    http_response_code(404);
    header('Location: /errors/404');
    exit;
}
?>
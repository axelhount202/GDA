<?php
namespace App\Controllers;

use App\Models\Cahiers;
use App\Models\Professeurs;
use App\Models\Affectations;
use App\Models\Relances;
use Exception;

class AdminController {
    // Fonction qui affiche la page admin
    public function showAdminPage() {
        // Retourne les cahiers non affectés
        $cahiers = new Cahiers();
        $afficher_cahiers = $cahiers->getNonAffectedCahiers();
        
        // Retourne les professeurs non affectés
        $professeurs = new Professeurs();
        $afficher_professeurs = $professeurs->getNonAssignedProfesseurs();
        
        // Retourne les relances des étudiants
        $relances = new Relances();
        $afficher_relances = $relances->getAllRelances();

        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    // Gestion de l'affectation d'un cahier à un professeur
    public function assignCahierToProfesseur() {
        try {
            $cahiers = new Cahiers();
            $cahier = $cahiers->getCahierByID((int)$_POST['cahier_id']);
    
            $professeurs = new Professeurs();
            $professeur = $professeurs->getProfesseurByID((int)$_POST['professeur_id']);
    
            // Vérifie si l'affectation est possible
            $message = $this->checkAssignmentPossibility($cahier['Domaine'], $professeur['Competence']);

            if ($message['message'] === "Un cahier a été affecté à un professeur.") {
                $affectations = new Affectations();
                $affectations->createNewAssignment((int)$_POST['cahier_id'], (int)$_POST['professeur_id']);
            }

            unset($_SESSION['message']);
            $_SESSION['message'] = $message;
            header("Location: /admin");
            exit;    
        } catch (Exception $e) {
            error_log("Erreur - assignCaheirToProfesseur : " . $e->getMessage());
            header("Location: /admin");
            exit;
        }
    }

    // Fonction pour vérifier si l'affectation est possible
    private function checkAssignmentPossibility($domaine_cahier, $competence_professeur) {
        try {
            $domaines = explode('-', $domaine_cahier);
            $competences = explode('-', $competence_professeur);
    
            foreach ($domaines as $domaine) {
                // Un domaine ou un couple de domaine doit etre inclu dans la(les) compétence(s)
                if (!in_array($domaine, $competences)) {
                    return [
                        'type' => 'alert-danger',
                        'message' => "L'affectation ne peut se faire."
                    ];
                }
            }
            return [
                'type' => 'alert-success',
                'message' => "Un cahier a été affecté à un professeur."
            ];
        } catch (Exception $e) {
            error_log("Erreur - checkAssignmentPossibility() ; " . $e->getMessage());
            return [
                'type' => 'alert-danger',
                'message' => "Une erreur est survenue lors de la verification."
            ];
        }
    }
}

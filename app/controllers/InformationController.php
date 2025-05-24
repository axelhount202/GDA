<?php
namespace App\Controllers;

use App\Models\Affectations;
use App\Models\Professeurs;
use App\Models\Cahiers;
use App\Models\Relances;

class InformationController {
    public function showStatuPage() {
        $this->checkAssignment();
        $informations = $this->checkCahierInformations();
        require __DIR__ . '/../views/etudiant/statu.php';
    }

    // Vérification sur le statu d'affectation du cahier des charges
    public function checkAssignment() {
        $user_id = $_SESSION['user']['id'];
        // Vérification de la soumission préalable du cahier
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);
        
        // unset($_SESSION['message']['affectation']);

        if (!$cahier) {
            $_SESSION['message']['affectation'] = [
                'type' => 'alert-danger',
                'message' => "Vous n'avez pas encore soumis votre cahier."
            ];
        } else {
            $cahier_id = $cahier['ID'];
            // Vérification de l'affectation d'un professeur
            $affectations = new Affectations();
            $affectation = $affectations->getProfesseurByCahierId($cahier_id);

            if (!$affectation) {
                $_SESSION['message']['affectation'] = [
                    'type' => 'alert-danger',
                    'message' => "Aucun professeur n'a été affecté à votre cahier."
                ];
            } else {
                // Récupération des informations sur le professeur affecté au cahier
                $professeurs = new Professeurs();
                $professeur = $professeurs->getProfesseurByID($affectation['ID_Professeur']);
                $_SESSION['message']['affectation'] = [
                    'type' => 'alert-info',
                    'message' => "Mr/Mme " . $professeur['Prenom'] . " " . $professeur['Nom'] . " a été affecté(e) à votre cahier."
                ];
            }
        }
    }

    public function checkCahierInformations() {
        $user_id = $_SESSION['user']['id'];
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);

        if (!$cahier) {
            return false;
        } else {
            return $cahier;
        }
    }

    // Gestion de l'envoie d'une relance vers l'admin
    public function sendRelance() {
        $user_id = $_SESSION['user']['id'];
        // Vérification de la soumission préalable du cahier
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);

        // unset($_SESSION['message']['notify']);

        if (!$cahier) {
            $_SESSION['message']['notify'] = [
                'type' => 'alert-danger',
                'message' => "Soumission préalable du cahier requise."
            ];
            header('Location: /etudiant/statu');
            exit;
        }

        $cahier_id = $cahier['ID'];
        // Le cahier est-il déjà affecté à un professeur?
        $affectations = new Affectations();
        $affectation = $affectations->getProfesseurByCahierId($cahier_id);

        if ($affectation) {
            $_SESSION['message']['notify'] = [
                'type' => 'alert-danger',
                'message' => "Relance non envoyee. Votre cahier a déjà été affecté à un professeur."
            ];
            header('Location: /etudiant/statu');
            exit;
        }

        // Insertion d'une relance dans la BD
        $relances = new Relances();
        $relances->createNewRelance($cahier_id);    
        $_SESSION['message']['notify'] = [
            'type' => 'alert-success',
            'message' => "Votre relance a bien été envoyée."
        ];
        header('Location: /etudiant/statu');
        exit;
    }
}
?>
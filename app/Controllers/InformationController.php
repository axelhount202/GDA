<?php
namespace App\Controllers;

use App\Models\Affectations;
use App\Models\Professeurs;
use App\Models\Cahiers;
use App\Models\Relances;

class InformationController {
    // Fonction qui affiche la page des informations sur un cahier
    public function showStatuPage() {
        $this->checkAssignment();
        $informations = $this->checkCahierInformations();
        require __DIR__ . '/../Views/etudiant/statu.php';
    }

    // Vérification du statu d'affectation du cahier
    public function checkAssignment() {
        $user_id = $_SESSION['user']['id'];
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);
        
        unset($_SESSION['message']['affectation']);

        if (!$cahier) {
            $_SESSION['message']['affectation'] = [
                'type' => 'alert-danger',
                'message' => "Vous n'avez pas encore soumis votre cahier."
            ];
        } else {
            $cahier_id = $cahier['ID'];
            $affectations = new Affectations();
            $affectation = $affectations->getProfesseurByCahierId($cahier_id);

            if (!$affectation) {
                $_SESSION['message']['affectation'] = [
                    'type' => 'alert-danger',
                    'message' => "Aucun professeur n'a encore été affecté à votre cahier."
                ];
            } else {
                $professeurs = new Professeurs();
                $professeur = $professeurs->getProfesseurByID($affectation['Id_Professeur']);
                $_SESSION['message']['affectation'] = [
                    'type' => 'alert-info',
                    'message' => "Mr/Mme " . $professeur['Prenom'] . " " . $professeur['Nom'] . " a été affecté(e) à votre cahier."
                ];
            }
        }
    }

    // Fonction qui retourne les informations sur cahier
    public function checkCahierInformations() {
        $user_id = $_SESSION['user']['id'];
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);

        return $cahier ?: false;
    }

    // Envoie d'une relance à l'admin
    public function sendRelance() {
        $user_id = $_SESSION['user']['id'];
        $cahiers = new Cahiers();
        $cahier = $cahiers->getCahierByUtilisateurId($user_id);

        unset($_SESSION['message']['notify']);

        if (!$cahier) {
            $_SESSION['message']['notify'] = [
                'type' => 'alert-danger',
                'message' => "Soumission préalable du cahier requise."
            ];
            header('Location: /etudiant/statu');
            exit;
        }

        $cahier_id = $cahier['ID'];
        $affectations = new Affectations();
        $affectation = $affectations->getProfesseurByCahierId($cahier_id);

        if ($affectation) {
            $_SESSION['message']['notify'] = [
                'type' => 'alert-danger',
                'message' => "Relance non envoyée. Votre cahier a déjà été affecté à un professeur."
            ];
            header('Location: /etudiant/statu');
            exit;
        }

        $relances = new Relances();
        $relances->createNewRelance($cahier_id);    
        $_SESSION['message']['notify'] = [
            'type' => 'alert-success',
            'message' => "Votre relance a bien été envoyée."
        ];
        header('Location: /etudiant/statu');
        exit;
    }

    // Suppression d'un cahier
    public function deleteCahierData() {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: /logout');
            exit;
        } else {
            $cahiers = new Cahiers();
            unset($_SESSION['message']['notify']);

            if ($cahiers->deleteCahierByIdUtilisateur($_SESSION['user']['id']) !== 1) {
                $_SESSION['message']['notify'] = [
                    'type' => 'alert-danger',
                    'message' => 'Echec de la suppression.'
                ];
            } else {
                $_SESSION['message']['notify'] = [
                    'type' => 'alert-success',
                    'message' => 'Cahier supprimé.'
                ];
            }
        }
        header('Location: /etudiant/statu');
        exit;
    }
}

<?php
namespace App\controllers;

use App\Models\Affectations;

class AssignController {
  // Fonction qui affiche la page de toutes les affectations 
  public function showAssignmentPage() {
    $affectations = new Affectations();
    $afficher_affectations = $affectations->getAllAffectations();

    require __DIR__ . '/../Views/admin/affectations.php';
  }

  // Fonction qui supprime une affectation
  public function deleteAssignment() {
    $cahier_id = (int)$_POST['cahier_id'];
    $professeur_id = (int)$_POST['professeur_id'];

    $affectations = new Affectations();
    $success = $affectations->deleteAssignmentById($cahier_id, $professeur_id);

    unset($_SESSION['message']);
    $_SESSION['message'] = [
        'type' => 'alert-success',
        'message' => 'Affectation supprimée.'
    ];
    header('Location: /admin/affectations');
    exit;
  }
}

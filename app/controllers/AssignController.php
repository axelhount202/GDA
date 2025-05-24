<?php
namespace App\controllers;

use App\Models\Affectations;

class AssignController {
  public function showAssignmentPage() {
    $affectations = new Affectations();
    $afficher_affectations = $affectations->getAllAffectations();

    require __DIR__ . '/../views/admin/affectations.php';
  }

  public function deleteAssignment() {
    $cahier_id = (int)$_POST['cahier_id'];
    $professeur_id = (int)$_POST['professeur_id'];

    $affectations = new Affectations();
    $success = $affectations->deleteAssignmentById($cahier_id, $professeur_id);

    $_SESSION['message'] = [
        'type' => 'alert-info',
        'message' => 'Affectation supprimée.'
    ];
    header('Location: /admin/affectations');
    exit;
  }

}
?>        
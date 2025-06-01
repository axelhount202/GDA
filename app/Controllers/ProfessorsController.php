<?php
namespace App\Controllers;

use App\Models\Professeurs;

class ProfessorsController{
  // Fonction qui affiche la page de tous les professeurs
  public function showProfessorsPage() {
    $professeurs = new Professeurs;
    $afficher_professeurs = $professeurs->getAllProfesseur();

    require __DIR__ . '/../Views/admin/professeurs.php';
  }

  // Fonction qui affiche la page de création d'un nouveau compte professeur
  public function showNewProfessorPage() {
    require __DIR__ . '/../Views/admin/nouveauProfesseur.php';
  }

  // Fonction qui affiche la page de mise à jour d'un compte professeur
  public function showProfessorsUpdatePage() {
    require __DIR__ . '/../Views/admin/modifierProfesseurs.php';
  }

  // Fonction pour insérer des comptes de professeurs par défaut dans la base de données
  public function insertDefalutProfessors() {
    $professeurs = new Professeurs();    
    $professors = [
        ['Martin', 'Paul', 'AL', '0601020304'],
        ['Bernard', 'Claire', 'SI', '0605060708'],
        ['Dubois', 'Sophie', 'SRC', '0611121314'],
        ['Morel', 'Antoine', 'AL-SI', '0615161718'],
        ['Laurent', 'Julie', 'AL-SRC', '0619202122'],
        ['Petit', 'Marc', 'SI-SRC', '0623242526'],
        ['Roux', 'Anne', 'AL-SI-SRC', '0627282930'],
        ['Gautier', 'Lucas', 'AL', '0631323334'],
        ['Faure', 'Emma', 'SI', '0635363738'],
        ['Blanchard', 'Léo', 'SRC', '0639404142'],
        ['Fontaine', 'Chloé', 'AL', '0643444546'],
        ['Chevalier', 'Nina', 'SI', '0647484950'],
        ['Perrin', 'Maxime', 'SRC', '0651525354'],
        ['Noël', 'Laura', 'AL-SI', '0655565758'],
        ['Lemoine', 'Jules', 'AL-SRC', '0659606162'],
        ['Garnier', 'Alice', 'SI-SRC', '0663646566'],
        ['Martinez', 'Théo', 'AL-SI-SRC', '0667686970']
    ];
    $inserted = false;

    foreach ($professors as $professor) {
      [$lastname, $surname, $skill, $phone_number] = $professor;
      $check = $professeurs->createProfesseur($lastname, $surname, $skill, $phone_number);

      if ($check) {
        $inserted = true;
      }
    }
    
    unset($_SESSION['message']);

    if ($inserted) {
      $_SESSION['message'] = [
        'type' => 'alert-success',
        'message' => "Plusieurs comptes de professeurs ont été créés."
      ];
    } else {
      $_SESSION['message'] = [
        'type' => 'alert-danger',
        'message' => "Échec : Les données que vous envoyez sont déjà dans la base de données."
      ];
    }
    header('Location: /admin/professeurs');
    exit;
  }

  public function createProfessor() {
    $lastname = htmlspecialchars(trim($_POST['lastname'] ?? ''));
    $surname = htmlspecialchars(trim($_POST['surname'] ?? ''));
    $field = htmlspecialchars(trim($_POST['field'] ?? ''));
    $phone_number = htmlspecialchars(trim($_POST['phone_number'] ?? ''));

    $professeurs = new Professeurs();
    $check = $professeurs->createProfesseur($lastname, $surname, $field, $phone_number);

    if (!$check) {
      unset($_SESSION['message']);
      $_SESSION['message'] = [
          'type' => 'alert-danger',
          'message' => "Échec : veuillez changer les informations."
      ];
      header('Location: /admin/professeurs/creer');
      exit;
    }
    
    header('Location: /admin/professeurs');
    exit;
  }

  public function modifyProfessor() {
    $_SESSION['professeur_id'] = (int)$_POST['professeur_id'];
    $professor_id = $_SESSION['professeur_id'];
    $lastname = htmlspecialchars(trim($_POST['lastname'] ?? ''));
    $surname = htmlspecialchars(trim($_POST['surname'] ?? ''));
    $field = htmlspecialchars(trim($_POST['field'] ?? ''));
    $phone_number = htmlspecialchars(trim($_POST['phone_number'] ?? ''));

    $professeurs = new Professeurs();
    $check = $professeurs->updateProfesseur($professor_id, $lastname, $surname, $field, $phone_number);

    if (!$check) {
      unset($_SESSION['message']);
      $_SESSION['message'] = [
          'type' => 'alert-danger',
          'message' => "Échec : veuillez changer les informations."
      ];
      header('Location: /admin/professeurs/modifier');
      exit;
    }

    unset($_SESSION['message']);
    $_SESSION['message'] = [
        'type' => 'alert-success',
        'message' => "Modification réussie."
    ];
    header('Location: /admin/professeurs/modifier');
    exit;
  }

  public function deleteProfessor() {
    $professor_id = $_POST['professeur_id'];

    $professeurs = new Professeurs();
    $professeurs->deleteProfesseur($professor_id);

    unset($_SESSION['message']);
    $_SESSION['message'] = [
        'type' => 'alert-success',
        'message' => "Suppression réussie."
    ];
    header('Location: /admin/professeurs');
    exit;
  }
}

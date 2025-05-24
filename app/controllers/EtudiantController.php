<?php
namespace App\Controllers;

use App\Models\Utilisateurs;
use App\Models\Cahiers;

class EtudiantController {
    // Afficher la page étudiant
    public function showEtudiantPage() {
        require __DIR__ . '/../views/etudiant/dashboard.php';
    }

    // Traitement du formulaire de soumission d'un cahier des charges
    public function sendCahier() {
        // Données issues du formulaire
        $member_2_lastname = htmlspecialchars(trim($_POST['member_2_lastname'] ?? ''));
        $member_2_surname = htmlspecialchars(trim($_POST['member_2_surname'] ?? ''));
        $member_2_field = htmlspecialchars(trim($_POST['member_2_field'] ?? ''));
        $title = htmlspecialchars(trim($_POST['title'] ?? ''));
        $pdf_file = $_FILES['pdf_file'] ?? null;
        $user_id = $_SESSION['user']['id'];
        $utilisateurs = new Utilisateurs();
        $member_1_field = $utilisateurs->getFieldById($user_id);

        unset($_SESSION['message']);

        if (!$pdf_file || $pdf_file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['message']['form'] = [
                'type' => 'alert-danger',
                'message' => "Erreur lors de l'upload du fichier."
            ];
            header('Location: /etudiant');
            exit;
        }

        if ($pdf_file['type'] !== 'application/pdf') {
            $_SESSION['message']['form'] = [
                'type' => 'alert-danger',
                'message' => "Seuls les fichiers PDF sont autorisés."
            ];
            header('Location: /etudiant');
            exit;
        }

        if ($pdf_file['size'] > 2 * 1024 * 1024) { // 2MB
            $_SESSION['message']['form'] = [
                'type' => 'alert-danger',
                'message' => "Le fichier ne doit pas dépasser 2MB."
            ];
            header('Location: /etudiant');
            exit;
        }

        // Génération du domaine (en fonction de la filière des deux membres du binôme)
        $domaine = $this->generateDomaine($member_1_field, $member_2_field);

        // Chemin pour stocker le fichier PDF
        $directoryPath = __DIR__ . '/../../src/cahiers/';

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0775, true);
        }

        $file_name = uniqid('cahier_', true) . '.pdf';
        $fullPath = $directoryPath . $file_name;

        if (!move_uploaded_file($pdf_file['tmp_name'], $fullPath)) {
            $_SESSION['message']['form'] = [
                'type' => 'alert-danger',
                'message' => "Erreur lors de l'enregistrement du fichier."
            ];
            header('Location: /etudiant');
            exit;
        }

        // Enregistrement du cahier en BD
        $cahiers = new Cahiers();
        $cahiers->createNewCahier($member_2_lastname, $member_2_surname, $member_2_field, $title, $domaine, 'src/cahiers/' . $file_name, $user_id);
        $_SESSION['message']['form'] = [
            'type' => 'alert-success',
            'message' => "Cahier des charges soumis avec succès.",
        ];
        // Redirection vers la page étudiant
        header('Location: /etudiant');
        exit;
    }

    // Fonction pour générer un domaine (en fonction de la filière des deux membres du binôme)
    private function generateDomaine(string $etudiant_1_field, string $etudiant_2_field) {
        if ($etudiant_1_field === $etudiant_2_field) {
            return $etudiant_1_field;
        }
        $domaine = [$etudiant_1_field, $etudiant_2_field];
        sort($domaine, SORT_STRING);

        return $domaine[0] . '-' . $domaine[1];
    }
}
?>
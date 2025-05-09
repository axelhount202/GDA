<?php
require_once __DIR__ . '/../config/database.php';

class EtudiantController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Inscrire un étudiant
    public function store($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Utilisateur (Nom, Prenom, Email, Password, Filiere, Role)
            VALUES (:nom, :prenom, :email, :password, :filiere, 'etudiant')
        ");
        return $stmt->execute($data);
    }

    // Afficher les informations d'un étudiant
    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Utilisateur WHERE ID = :id AND Role = 'etudiant'");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

	// Soumettre un cahier
	public function submitCahier($data, $file)
	{
		// Vérification du type de fichier (doit être un PDF)
		if ($file['type'] !== 'application/pdf') {
			return [
				'success' => false,
				'message' => 'Le fichier soumis doit être au format PDF.',
			];
		}

		// Définir le chemin d'enregistrement du fichier
		$uploadDir = __DIR__ . '/../uploads/';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true); // Créer le dossier si inexistant
		}

		$fileName = uniqid() . '_' . basename($file['name']);
		$uploadPath = $uploadDir . $fileName;

		// Déplacer le fichier vers le répertoire des téléchargements
		if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
			return [
				'success' => false,
				'message' => 'Erreur lors du téléchargement du fichier.',
			];
		}

		// Insérer les données dans la table `Cahiers`
		$stmt = $this->pdo->prepare("
			INSERT INTO Cahiers (Titre, Binome, Fichier, DateSoumission, ID_Utilisateur)
			VALUES (:titre, :binome, :fichier, NOW(), :id_utilisateur)
		");

		$success = $stmt->execute([
			'titre' => $data['titre'],
			'binome' => $data['binome'],
			'fichier' => $fileName, // Nom unique du fichier enregistré
			'id_utilisateur' => $data['id_utilisateur'],
		]);

		if ($success) {
			return [
				'success' => true,
				'message' => 'Cahier soumis avec succès.',
			];
		} else {
			return [
				'success' => false,
				'message' => 'Erreur lors de la soumission du cahier.',
			];
		}
	}


    // Liste des cahiers soumis par l'étudiant
    public function listCahiers($etudiantId)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM Cahiers WHERE ID_Utilisateur = :id_utilisateur
        ");
        $stmt->execute(['id_utilisateur' => $etudiantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher l'encadreur pour un cahier
    public function getEncadreur($cahierId)
    {
        $stmt = $this->pdo->prepare("
            SELECT P.Nom, P.Prenom, P.Email
            FROM Affectation A
            JOIN Professeur P ON A.ID_Professeur = P.ID
            WHERE A.ID_Cahier = :id_cahier
        ");
        $stmt->execute(['id_cahier' => $cahierId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Relancer une affectation
    public function relancerAffectation($cahierId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Relance (ID_Cahier)
            VALUES (:id_cahier)
        ");
        return $stmt->execute(['id_cahier' => $cahierId]);
    }

    // Vérifier et relancer si aucun encadreur n'est trouvé
    public function verifierOuRelancer($cahierId)
    {
        $encadreur = $this->getEncadreur($cahierId);

        if (!$encadreur) {
            // Si aucun encadreur n'est trouvé, effectuer une relance
            $this->relancerAffectation($cahierId);
            return [
                'status' => 'relance',
                'message' => 'Aucune affectation trouvée. Une relance a été effectuée.',
            ];
        } else {
            // Si un encadreur est trouvé, retourner ses informations
            return [
                'status' => 'encadreur',
                'data' => $encadreur,
            ];
        }
    }
}
?>

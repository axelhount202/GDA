<?php
require_once 'Database.php';
require_once 'models/Utilisateur.php';

$db = new Database();
$pdo = $db->getConnection();

$utilisateur = new Utilisateur($pdo);
$liste = $utilisateur->all(); 

$user= $utilisateur->find(1);
$getcahier= $utilisateur->getCahiers(1);



if (!empty($liste)) {
    foreach ($liste as $utilisateur) {
        echo "ID: " . $utilisateur['ID'] . "<br>";
        echo "Nom: " . $utilisateur['Nom'] . "<br>";
        echo "Prénom: " . $utilisateur['Prenom'] . "<br>";
        echo "Email: " . $utilisateur['Email'] . "<br>";
        echo "Filière: " . $utilisateur['Filiere'] . "<br>";
        echo "Rôle: " . $utilisateur['Role'] . "<br><br>";
    }
} else {
    echo "Aucun utilisateur trouvé.";
}

if (!empty($user)) {
    
        echo "ID: " . $user['ID'] . "<br>";
        echo "Nom: " . $user['Nom'] . "<br>";
        echo "Prénom: " . $user['Prenom'] . "<br>";
        echo "Email: " . $user['Email'] . "<br>";
        echo "Filière: " . $user['Filiere'] . "<br>";
        echo "Rôle: " . $user['Role'] . "<br><br>";
} else {
    echo "Aucun utilisateur trouvé.";
}

if (!empty($getcahier)) {
   foreach ($getcahier as $cahier){
    echo "ID: " . $cahier['ID'] . "<br>";
    echo "Nom_binome: " . $cahier['Nom_binome'] . "<br>";
    echo "Prénom_binome: " . $cahier['Prenom_binome'] . "<br>";
    echo "ID_Utilisateur: " . $cahier['ID_Utilisateur'] . "<br>";
    echo "Intitulle: " . $cahier['Intitulle'] . "<br>";
    echo "Domaine: " . $cahier['Domaine'] . "<br><br>";
    echo "Chemin_PDF: " . $cahier['Chemin_PDF'] . "<br><br>";
}
} else {
echo "Aucun utilisateur trouvé.";
}

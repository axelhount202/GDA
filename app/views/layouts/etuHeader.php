<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Application de gestion</title>
    <link rel="stylesheet" href="/styles/etu_style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="etudiant">
        <nav>
            <ul>                
                <li><a href="/etudiant" style="margin-right: 15px">Cahier</a></li>
                <li><a href="/statu">Statu cahier</a></li>
            </ul>
            <form action="/logout" method="POST">
                <button type="submit">Se déconnecter</button>
            </form>
        </nav>
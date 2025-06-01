<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>
    <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
    <link rel="stylesheet" href="/src/styles/etu_style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="etudiant">
        <nav>
            <ul>                
                <li><a href="/etudiant" style="margin-right: 15px">Cahier</a></li>
                <li><a href="/etudiant/statu">Statu cahier</a></li>
            </ul>
            <form action="/logout" method="POST">
                <button type="submit">Déconnexion</button>
            </form>
        </nav>
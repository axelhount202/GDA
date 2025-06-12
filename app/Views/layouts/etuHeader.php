<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>
    <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-blue': '#243c5a', // Exemple de couleur personnalisée
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex flex-1">
        <nav class="w-64 bg-gray-800 text-white p-4">
            <ul class="space-y-2">                
                <li><a href="/etudiant" class="block py-2 px-4 rounded hover:bg-gray-700">Cahier</a></li>
                <li><a href="/etudiant/statu" class="block py-2 px-4 rounded hover:bg-gray-700">Statut cahier</a></li>
                <form action="/logout" method="POST" class="pt-4">
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Déconnexion</button>
                </form>
            </ul>
        </nav>
        <main class="flex-1 p-8">
</body>
</html>
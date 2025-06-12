<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>
    <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
    <style>
        body {
            background-color: #f3f4f6; /* Equivalent to bg-gray-100 */
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Stacks header, main, footer vertically */
            margin: 0;
            padding: 0;
        }

        .top-nav {
            background-color: #1f2937; /* Equivalent to bg-gray-800 */
            padding: 1rem; /* Equivalent to p-4 */
            color: white;
            display: flex; /* Makes items inside horizontal */
            justify-content: flex-start; /* Aligns items to the start */
            align-items: center; /* Vertically aligns items */
            flex-wrap: wrap; /* Allows items to wrap on smaller screens */
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex; /* Horizontal list items */
            gap: 1rem; /* Space between links */
            flex-grow: 1; /* Allows the list to take available space */
            align-items: center;
        }

        .nav-list-item a {
            display: block;
            padding: 0.5rem 1rem; /* Equivalent to py-2 px-4 */
            border-radius: 0.25rem; /* Equivalent to rounded */
            color: inherit;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        .nav-list-item a:hover {
            background-color: #374151; /* Equivalent to hover:bg-gray-700 */
        }

        .logout-form {
            margin-left: auto; /* Pushes the logout button to the right */
        }

        .logout-button {
            background-color: #dc2626; /* Equivalent to bg-red-600 */
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem; /* Equivalent to py-2 px-4 */
            border-radius: 0.25rem; /* Equivalent to rounded */
            border: none;
            cursor: pointer;
            outline: none;
            box-shadow: 0 0 transparent;
            transition: background-color 0.2s ease-in-out;
        }

        .logout-button:hover {
            background-color: #b91c1c; /* Equivalent to hover:bg-red-700 */
        }

        .main-content {
            padding: 1rem; /* Equivalent to p-8 */
        }
    </style>
</head>
<body>
    <nav class="top-nav">
        <ul class="nav-list">
            <li class="nav-list-item"><a href="/etudiant">Cahier</a></li>
            <li class="nav-list-item"><a href="/etudiant/statu">Statut cahier</a></li>
        </ul>
        <div class="logout-form">
            <form action="/logout" method="POST">
                <button type="submit" class="logout-button">Déconnexion</button>
            </form>
        </div>
    </nav>
    <main class="main-content">
        </main>
</body>
</html>
<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main class="flex min-h-screen bg-gray-100">
    <nav class="w-64 bg-gray-800 text-white p-4">
        <ul class="space-y-2">                
            <li><a href="/admin" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a></li>
            <li><a href="/admin/affectations" class="block py-2 px-4 rounded hover:bg-gray-700">Affectations</a></li>
            <li><a href="/admin/professeurs" class="block py-2 px-4 rounded hover:bg-gray-700">Professeurs</a></li>
            <form action="/logout" method="POST" class="pt-4">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard Administrateur</h1>
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Liste des professeurs</h2>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th colspan="2" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Noms & Prénoms</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Compétences</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($afficher_professeurs as $professeur): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <?= htmlspecialchars($professeur['Nom'] . " " .  $professeur['Prenom']); ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <?= htmlspecialchars($professeur['Competence']); ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex space-x-2">
                                <form action="/admin/professeurs/modifier" method="GET">
                                    <input type="hidden" name="professeur_id" value="<?= $professeur['ID'] ?>">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">Modifier</button>
                                </form>
                                <form action="/admin/professeurs/supprimer" method="POST">
                                    <input type="hidden" name="professeur_id" value="<?= $professeur['ID'] ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div class="alert mt-3 p-3 rounded-md 
                <?php echo ($_SESSION['message']['type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="flex space-x-4 mt-6">
            <form action="/admin/professeurs/creer" method="GET">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ajouter un professeur</button>
            </form>

            <form action="/admin/professeurs/valeurspardefaut" method="POST">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Insérer des professeurs par défaut</button>
            </form>
        </div>
    </div>
</main>


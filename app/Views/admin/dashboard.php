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
        
        <form action="/admin/affectations" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Faire une nouvelle affectation</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-700">Cahiers non affectés</h3>
                    <select name="cahier_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php foreach ($afficher_cahiers as $cahier): ?>
                            <?php $intitule_tronquer = strlen($cahier['Intitule']) > 30 ? substr($cahier['Intitule'], 0, 30) . '...' : $cahier['Intitule']; ?>
                            <option value = "<?= htmlspecialchars($cahier['ID']); ?>">
                                <?= htmlspecialchars($intitule_tronquer); ?> - <?= htmlspecialchars($cahier['Domaine']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-700">Professeurs non affectés</h3>
                    <select name="professeur_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php foreach ($afficher_professeurs as $professeur): ?>
                            <?php $nom_tronquer = strlen($professeur['Nom'] . " " . $professeur['Prenom']) > 30 ? substr($professeur['Nom'] . " " . $professeur['Prenom'], 0, 30) . '...' : ($professeur['Nom'] . " " . $professeur['Prenom']); ?>
                            <option value="<?= htmlspecialchars($professeur['ID']); ?>">
                                <?= htmlspecialchars($nom_tronquer); ?> - <?= htmlspecialchars($professeur['Competence']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
                <div class="alert mt-3 p-3 rounded-md 
                    <?php echo ($_SESSION['message']['type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Faire une affectation</button>
        </form>

        <h2 class="text-2xl font-bold mb-4 text-gray-800">Relances des Étudiants</h2>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Intitulé du cahier</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date de relance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($afficher_relances as $relance): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?= htmlspecialchars($relance['Intitule']);?></td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?= htmlspecialchars($relance['Created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


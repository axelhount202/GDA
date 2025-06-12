<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-6 pb-4 border-b-2 border-gray-200">Statut du cahier</h1>

        <?php if (!isset($informations) || empty($informations)): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">Aucun cahier des charges soumis pour le moment.</span>
            </div>
            <div class="infos bg-gray-50 p-4 rounded-md border border-gray-200">
                <h2 class="text-xl font-semibold mb-3 text-gray-700">Informations cahier</h2>
                <div class="space-y-2 text-gray-600">
                    <p>Nom binôme : <strong class="font-bold">inconnu</strong></p>
                    <p>Prénom binôme : <strong class="font-bold">inconnu</strong></p>
                    <p>Intitulé du cahier : <strong class="font-bold">inconnu</strong></p>
                </div>
            </div>
        <?php else: ?>
            <div class="infos bg-gray-50 p-4 rounded-md border border-gray-200 mb-6">
                <h2 class="text-xl font-semibold mb-3 text-gray-700">Informations</h2>
                <div class="space-y-2 text-gray-600">
                    <p>Nom binôme : <strong class="font-bold"><?= htmlspecialchars($informations['Nom_binome']); ?></strong></p>
                    <p>Prénom binôme : <strong class="font-bold"><?= htmlspecialchars($informations['Prenom_binome']); ?></strong></p>
                    <p>Intitulé du cahier : <strong class="font-bold"><?= htmlspecialchars($informations['Intitule']); ?></strong></p>
                    <p>Statut : <strong class="font-bold 
                        <?php 
                        if ($informations['Statut'] === 'Affecté') echo 'text-green-600';
                        elseif ($informations['Statut'] === 'En attente') echo 'text-yellow-600';
                        else echo 'text-red-600';
                        ?>">
                        <?= htmlspecialchars($informations['Statut']); ?>
                    </strong></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message']['notify']) && !empty($_SESSION['message']['notify'])): ?>
            <div class="alert mt-6 p-3 rounded-md 
                <?php echo ($_SESSION['message']['notify']['type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                <?= htmlspecialchars($_SESSION['message']['notify']['message']); unset($_SESSION['message']['notify']) ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
            <form action="/etudiant/statu/relance" method="POST" class="flex-1">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Faire une relance</button>
            </form>
            <form action="/etudiant/statu/supprimer" method="POST" class="flex-1">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Supprimer le cahier</button>
            </form>
        </div>
    </div>


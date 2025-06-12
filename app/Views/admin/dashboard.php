<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main style="display: flex; min-height: 100vh; background-color: #f3f4f6;">
    <nav style="width: 16rem; background-color: #1f2937; color: white; padding: 1rem;">
        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem;">                
            <li><a href="/admin" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Dashboard</a></li>
            <li><a href="/admin/affectations" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Affectations</a></li>
            <li><a href="/admin/professeurs" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Professeurs</a></li>
            <form action="/logout" method="POST" style="padding-top: 1rem;">
                <button type="submit" style="width: 100%; background-color: #dc2626; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div style="flex: 1; padding: 2rem;">
        <h1 style="font-size: 2.25rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Dashboard Administrateur</h1>
        
        <form action="/admin/affectations" method="POST" style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1.5rem; margin-bottom: 2rem;">
            <h2 style="font-size: 1.875rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Faire une nouvelle affectation</h2>
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                <div style="grid-column: span 1;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">Cahiers non affectés</h3>
                    <select name="cahier_id" style="display: block; width: 100%; background-color: white; border: 1px solid #9ca3af; padding: 0.5rem 1rem; border-radius: 0.25rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
                        <?php foreach ($afficher_cahiers as $cahier): ?>
                            <?php $intitule_tronquer = strlen($cahier['Intitule']) > 30 ? substr($cahier['Intitule'], 0, 30) . '...' : $cahier['Intitule']; ?>
                            <option value = "<?= htmlspecialchars($cahier['ID']); ?>">
                                <?= htmlspecialchars($intitule_tronquer); ?> - <?= htmlspecialchars($cahier['Domaine']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="grid-column: span 1;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">Professeurs non affectés</h3>
                    <select name="professeur_id" style="display: block; width: 100%; background-color: white; border: 1px solid #9ca3af; padding: 0.5rem 1rem; border-radius: 0.25rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
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
                <div style="margin-top: 0.75rem; padding: 0.75rem; border-radius: 0.375rem; 
                    <?php echo ($_SESSION['message']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
                    <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <button type="submit" style="margin-top: 1rem; background-color: #2563eb; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Faire une affectation</button>
        </form>

        <h2 style="font-size: 1.875rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Relances des Étudiants</h2>
        <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Intitulé du cahier</th>
                        <th style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Date de relance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($afficher_relances as $relance): ?>
                        <tr>
                            <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;"><?= htmlspecialchars($relance['Intitule']);?></td>
                            <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;"><?= htmlspecialchars($relance['Created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
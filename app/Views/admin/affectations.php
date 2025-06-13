
<main style="display: flex; min-height: 100vh; background-color: #f3f4f6;">
    <nav style="width: 16rem; background-color: #1f2937; color: white; padding: 1rem;">
        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem;">
            <li><a href="/admin" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; color: inherit; text-decoration: none; transition: background-color 0.2s ease-in-out;">Dashboard</a></li>
            <li><a href="/admin/affectations" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; color: inherit; text-decoration: none; transition: background-color 0.2s ease-in-out;">Affectations</a></li>
            <li><a href="/admin/professeurs" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; color: inherit; text-decoration: none; transition: background-color 0.2s ease-in-out;">Professeurs</a></li>
            <form action="/logout" method="POST" style="padding-top: 1rem;">
                <button type="submit" style="width: 100%; background-color: #dc2626; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; outline: none; box-shadow: 0 0 transparent; transition: background-color 0.2s ease-in-out;">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div style="flex: 1; padding: 2rem;">
        <h1 style="font-size: 1.875rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Dashboard Administrateur</h1>
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Liste des affectations</h2>
        <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; overflow: hidden; margin-bottom: 1.5rem;">
            <table style="min-width: 100%; width: 100%; line-height: 1.5;">
                <thead>
                    <tr>
                        <th style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Intitulé du cahier</th>
                        <th colspan="2" style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Professeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($afficher_affectations as $affectation): ?>
                        <tr>
                            <td style="padding: 1.25rem 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                                <?= htmlspecialchars(strlen($affectation['Intitule']) > 55 ? substr($affectation['Intitule'], 0, 55) . '...' : $affectation['Intitule']); ?>
                            </td>
                            <td style="padding: 1.25rem 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                                <?= htmlspecialchars($affectation['Nom'] . " " .  $affectation['Prenom']); ?>
                            </td>
                            <td style="padding: 1.25rem 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem; text-align: right;">
                                <form action="/admin/affectations/supprimer" method="POST">
                                    <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
                                    <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
                                    <button type="submit" style="background-color: #ef4444; color: white; font-weight: bold; padding: 0.25rem 0.75rem; border-radius: 0.25rem; border: none; font-size: 0.75rem; cursor: pointer; transition: background-color 0.2s ease-in-out;">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div style="margin-top: 0.75rem; padding: 0.75rem; border-radius: 0.375rem;
                <?php echo ($_SESSION['message']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
                <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>
    </div>
</main>
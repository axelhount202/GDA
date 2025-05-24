<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main>
    <nav>
        <ul>                
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/affectations">Affectations</a></li>
            <li><a href="/admin/professeurs">Professeurs</a></li>
            <form action="/logout" method="POST">
                <button type="submit">Se déconnecter</button>
            </form>
        </ul>
    </nav>
    <div class="content">
        <h1>Dashboard Administrateur</h1>
        <form action="/admin/affectations" method="POST">
            <div>
                <div>
                    <h2>Cahiers non affectés</h2>
                    <select name="cahier_id">
                        <?php foreach ($afficher_cahiers as $cahier): ?>
                            <option value = "<?= htmlspecialchars($cahier['ID']); ?>">
                                <?= htmlspecialchars(strlen($cahier['Intitule']) > 35 ? substr($cahier['Intitule'], 0, 35) . '...' : $cahier['Intitule']); ?> ( <?= htmlspecialchars($cahier['Domaine']); ?> )
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <h2>Professeurs non affectés</h2>
                    <select name="professeur_id">
                        <?php foreach ($afficher_professeurs as $professeur): ?>
                            <option value="<?= htmlspecialchars($professeur['ID']); ?>"><?= htmlspecialchars($professeur['Prenom'] . " " . $professeur['Nom']) ?> ( <?= htmlspecialchars($professeur['Competence']); ?> )</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Affichage du message suite à une tentative d'affectation -->
            <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
                <div class="alert <?= $_SESSION['message']['type']; ?> mt-3">
                    <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <button type="submit">Faire une Affectation</button>
        </form>

        <h2>Relances des Étudiants</h2>
        <table>
            <thead>
                <tr>
                    <th>Intitulé du cahier</th>
                    <th>Date de relance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($afficher_relances as $relance): ?>
                    <tr>
                        <td><?= htmlspecialchars($relance['Intitule']); ?></td>
                        <td><?= htmlspecialchars($relance['Created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>
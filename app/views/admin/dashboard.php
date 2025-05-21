<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main>
    <nav>
        <h1>Dashboard Administrateur</h1>
        <ul>                
            <li style="margin-bottom: 24px"><a href="">Dashboard</a></li>
            <li><a href="#">-</a></li>
        </ul>
    </nav>
    <div class="content">
        <h2>Affecter un cahier</h2><br>
        <form action="/admin/affectation" method="POST">
            <div>
                <div class="cahiers" style="margin-right: 25px">
                    <h3>Cahiers Non Affectés</h3>
                    <select name="cahier_id">
                        <?php foreach ($afficher_cahiers as $cahier): ?>
                            <option value = "<?= htmlspecialchars($cahier['ID']); ?>">
                                <?= htmlspecialchars(strlen($cahier['Intitule']) > 40 ? substr($cahier['Intitule'], 0, 40) . '...' : $cahier['Intitule']); ?> ( <?= htmlspecialchars($cahier['Domaine']); ?> )
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <h3>Professeurs Non Affectés</h3>
                    <select name="professeur_id">
                        <?php foreach ($afficher_professeurs as $professeur): ?>
                            <option value="<?= htmlspecialchars($professeur['ID']); ?>"><?= htmlspecialchars($professeur['Prenom'] . " " . $professeur['Nom']) ?> ( <?= htmlspecialchars($professeur['Competence']); ?> )</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit">Faire une Affectation</button>
        </form>

        <!-- Affichage du message suite à une tentative d'affectation -->
        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['message']['type']; ?> mt-3">
                <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <br><br><br>
        <h2>Relances des Étudiants</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Intitule Cahier</th>
                    <th>Date de Relance</th>
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
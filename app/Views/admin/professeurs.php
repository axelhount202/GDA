<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main>
    <nav>
        <ul>                
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/affectations">Affectations</a></li>
            <li><a href="/admin/professeurs">Professeurs</a></li>
            <form action="/logout" method="POST">
                <button type="submit">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div class="professeurs">
        <h1>Dashboard Administrateur</h1>
        <h2>Liste des professeurs</h2>
        <table>
          <thead>
            <tr>
              <th colspan="2">Noms & Prénoms</th>
              <th>Compétences</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($afficher_professeurs as $professeur): ?>
              <tr>
                <td><?= htmlspecialchars($professeur['Nom'] . " " .  $professeur['Prenom']); ?></td>
                <td><?= htmlspecialchars($professeur['Competence']); ?></td>
                <td>
                  <form action="/admin/professeurs/modifier" method="GET">
                    <input type="hidden" name="professeur_id" value="<?= $professeur['ID'] ?>">
                    <button type="submit">Modifier</button>
                  </form>
                  <form action="/admin/professeurs/supprimer" method="POST">
                    <input type="hidden" name="professeur_id" value="<?= $professeur['ID'] ?>">
                    <button type="submit">Supprimer</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
          <div class="alert <?= $_SESSION['message']['type']; ?> mt-3">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
          </div>
        <?php endif; ?>

        <form action="/admin/professeurs/creer" method="GET">
          <button type="submit">Ajouter un professeur</button>
        </form>

        <form action="/admin/professeurs/valeurspardefaut" method="POST">
          <button type="submit">Insérer des professeurs par défaut</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>
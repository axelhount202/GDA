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
    <div class="affectations">
        <h1>Dashboard Administrateur</h1>
        <h2>Liste des affectations</h2>
        <table>
          <thead>
            <tr>
              <th>Intitulé du cahier</th>
              <th colspan="2">Professeur</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($afficher_affectations as $affectation): ?>
              <tr>
                <td><?= htmlspecialchars(strlen($affectation['Intitule']) > 55 ? substr($affectation['Intitule'], 0, 55) . '...' : $affectation['Intitule']); ?></td>
                <td><?= htmlspecialchars($affectation['Nom'] . " " .  $affectation['Prenom']); ?></td>
                <td>
                  <form action="/admin/affectations/supprimer" method="POST">
                    <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
                    <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
                    <button type="submit">Supprimer</button>
                  </form>
                </td>  
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
          <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
          </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>
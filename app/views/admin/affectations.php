<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main>
    <nav>
        <ul>                
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/affectations">Affectations</a></li>
            <!-- <li><a href="#">Professeurs</a></li> -->
            <form action="/logout" method="POST">
                <button type="submit">Se déconnecter</button>
            </form>
        </ul>
    </nav>
    <div class="content affectations">
        <h1>Dashboard Administrateur</h1>
        <h2>Liste des affectations</h2>
        <table>
          <thead>
            <tr>
              <th>Intitulé du cahier</th>
              <th>Professeur</th>
              <th><th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($afficher_affectations as $affectation): ?>
              <tr>
                <td><?= htmlspecialchars(strlen($affectation['Intitule']) > 55 ? substr($affectation['Intitule'], 0, 55) . '...' : $affectation['Intitule']); ?></td>
                <td><?= htmlspecialchars($affectation['Nom'] . " " .  $affectation['Prenom']); ?></td>
                <td class="aff-td">
                  <form class="aff-form" action="/admin/affectations/supprimer" method="POST">
                    <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
                    <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
                    <button class="aff-button" type="submit">Supprimer</button>
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

        <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
        <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
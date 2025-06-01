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
    <div class="creer">
        <h1>Dashboard Administrateur</h1>
        <h2>Nouveau professeur</h2>
        <form action="/admin/professeurs/creer" method="POST">
          <label for="lastname">Nom</label>
          <input type="text" name="lastname" required>

          <label for="surname">Prénom</label>
          <input type="text" name="surname" required>

          <label for="field">Compétence(s)</label>
          <select name="field">
            <option value="AL">AL</option>
            <option value="SI">SI</option>
            <option value="SRC">SRC</option>
            <option value="AL-SI">AL-SI</option>
            <option value="AL-SRC">AL-SRC</option>
            <option value="SI-SRC">SI-SRC</option>
            <option value="AL-SI-SRC">AL-SI-SRC</option>
          </select>

          <label for="phone_number">Téléphone</label>
          <input type="tel" name="phone_number" pattern="[0-9]+" placeholder="Ex: 0199999999" required>

          <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div class="alert <?= $_SESSION['message']['type']; ?>">
              <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
          <?php endif; ?>

          <button type="submit">Créer</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>
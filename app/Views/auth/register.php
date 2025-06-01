<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>App de gestion</title>
  <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
  <link rel="stylesheet" href="/src/styles/style.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body>
  <main>
    <form method="POST" action="/register">
      <h1>Inscription</h1>
      <label for="lastname">Nom</label>
      <input type="text" name="lastname" required>

      <label for="surname">Prénom</label>
      <input type="text" name="surname" required>

      <label for="field">Filière (laisser vide si admin)</label>
      <?php if (isset($_SESSION['message']['field']) && !empty($_SESSION['message']['field'])): ?>
        <div class="alert <?= $_SESSION['message']['field']['type']; ?>">
          <?= htmlspecialchars($_SESSION['message']['field']['message']); unset($_SESSION['message']['field']); ?>
        </div>
      <?php endif; ?>
      <select name="field">
        <option value="">Vide</option>
        <option value="AL">AL</option>
        <option value="SI">SI</option>
        <option value="SRC">SRC</option>
      </select>

      <label for="role" class="gen-label">Rôle</label>
      <select name="role" class="gen-select" required>
        <option value="etudiant">Étudiant</option>
        <option value="admin">Admin</option>
      </select>

      <label for="email">Email</label>
      <?php if (isset($_SESSION['message']['email']) && !empty($_SESSION['message']['email'])): ?>
        <div class="alert <?= $_SESSION['message']['email']['type']; ?>">
          <?= htmlspecialchars($_SESSION['message']['email']['message']); unset($_SESSION['message']['email']); ?>
        </div>
      <?php endif; ?>
      <input type="email" name="email" required>

      <label for="password">Mot de passe</label>
      <input type="text" name="password" required>

      <?php if (isset($_SESSION['message']['require']) && !empty($_SESSION['message']['require'])): ?>
        <div class="alert <?= $_SESSION['message']['require']['type']; ?>">
          <?= htmlspecialchars($_SESSION['message']['require']['message']); unset($_SESSION['message']['require']); ?>
        </div>
      <?php endif; ?>

      <button type="submit" class="spe-button">Valider</button>

      <div class="link spe-link">
        <p>Déjà inscrit ? <a href="/login">Se connecter</a></p>
      </div>
    </form>
  </main>
  
  <footer><p>Affectation des cahiers des charges - Groupe 5</p></footer>
</body>
</html>
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
    <form action="/login" method="POST">
      <h1>Connexion</h1>
      <!-- <h5 style="margin: 0; padding: 0;">Admin : admin1@mail.com adminpass1</h5>
      <h5 style="margin: 10px 0; padding: 0;">Utilisateur : tom.henry10@mail.com password10</h5> -->

      <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
        </div>
      <?php endif; ?>

      <label>Email</label>
      <input type="email" name="email" require>

      <label>Mot de passe</label>
      <input type="password" name="password" require>

      <button type="submit">Se connecter</button>

      <div class="link">
        <p>Pas encore inscrit ? <a href="/register">Créez un compte</a></p> 
      </div>
    </form>
  </main>

  <footer><p>Affectation des cahiers des charges - Groupe 5</p></footer>
</body>
</html>
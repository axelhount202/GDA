<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App de gestion</title>
  <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* Réinitialisation de base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Style du corps de la page */
    body {
      font-family: 'Inter', sans-serif;
      background-color: #e9ecef; /* Un arrière-plan très léger */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #343a40; /* Couleur de texte sombre */
    }

    /* Conteneur principal */
    main {
      width: 100%;
      max-width: 450px; /* Légèrement plus large pour les champs additionnels */
      padding: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Style du formulaire */
    form {
      background-color: #ffffff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      width: 100%;
      display: flex;
      flex-direction: column;
    }

    /* Style du titre */
    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #007bff; /* Bleu primaire */
      font-weight: 600;
      font-size: 2em;
    }

    /* Style des labels */
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
      color: #495057;
    }

    /* Style des champs de saisie et selects */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      font-size: 0.95rem;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
      background-color: #fff; /* Assurer un fond blanc pour les selects */
      appearance: none; /* Supprimer le style par défaut des selects pour une personnalisation */
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007bff%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13.6-6.4H18.6c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2069.4c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2082.3c3.6-3.6%205.4-7.8%205.4-12.9z%22%2F%3E%3C%2Fsvg%3E'); /* Icône de flèche pour les selects */
      background-repeat: no-repeat;
      background-position: right 0.7em top 50%, 0 0;
      background-size: 0.65em auto, 100%;
    }

    input:focus,
    select:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Style du bouton */
    button[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s ease;
      margin-top: 10px;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    /* Style de la section lien */
    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .link p {
      margin: 0;
      color: #6c757d;
    }

    .link a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    .link a:hover {
      text-decoration: underline;
    }

    /* Style des messages d'alerte */
    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      text-align: center;
      font-weight: 400;
      border: 1px solid transparent;
      font-size: 0.9rem;
    }

    .alert.success {
      background-color: #d4edda;
      color: #155724;
      border-color: #c3e6cb;
    }

    .alert.danger {
      background-color: #f8d7da;
      color: #721c24;
      border-color: #f5c6cb;
    }

    /* Style du pied de page */
    footer {
      margin-top: 25px;
      padding: 10px;
      text-align: center;
      color: #888;
      font-size: 0.85rem;
    }

    /* Ajustements responsifs */
    @media (max-width: 600px) {
      main {
        max-width: 100%;
        padding: 10px;
      }
      form {
        padding: 20px;
      }
      h1 {
        font-size: 1.7em;
      }
    }
  </style>
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
      <input type="password" name="password" required> <!-- Changed to type="password" for security -->

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

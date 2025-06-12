<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App de gestion</title>
  <link rel="icon" type="image/x-icon" href="/src/favicon/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #e9ecef;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #343a40;
    }

    main {
      width: 100%;
      max-width: 380px;
      padding: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    form {
      background-color: #ffffff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      width: 100%;
      display: flex;
      flex-direction: column;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #007bff;
      font-weight: 600;
      font-size: 2em;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
      color: #495057;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      font-size: 0.95rem;
      transition: border-color 0.2s ease;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

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

    footer {
      margin-top: 25px;
      padding: 10px;
      text-align: center;
      color: #888;
      font-size: 0.85rem;
    }

    @media (max-width: 480px) {
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
    <form action="/login" method="POST">
      <h1>Connexion</h1>

      <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
        </div>
      <?php endif; ?>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Mot de passe</label>
      <input type="password" name="password" required>

      <button type="submit">Se connecter</button>

      <div class="link">
        <p>Pas encore inscrit ? <a href="/register">Créez un compte</a></p>
      </div>
    </form>
  </main>

  <footer><p>Affectation des cahiers des charges - Groupe 5</p></footer>
</body>
</html>
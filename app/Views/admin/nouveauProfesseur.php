<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main class="flex min-h-screen bg-gray-100">
    <nav class="w-64 bg-gray-800 text-white p-4">
        <ul class="space-y-2">                
            <li><a href="/admin" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a></li>
            <li><a href="/admin/affectations" class="block py-2 px-4 rounded hover:bg-gray-700">Affectations</a></li>
            <li><a href="/admin/professeurs" class="block py-2 px-4 rounded hover:bg-gray-700">Professeurs</a></li>
            <form action="/logout" method="POST" class="pt-4">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard Administrateur</h1>
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Nouveau professeur</h2>
        <form action="/admin/professeurs/creer" method="POST" class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
          <div class="mb-4">
            <label for="lastname" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
            <input type="text" name="lastname" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="mb-4">
            <label for="surname" class="block text-gray-700 text-sm font-bold mb-2">Prénom</label>
            <input type="text" name="surname" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="mb-4">
            <label for="field" class="block text-gray-700 text-sm font-bold mb-2">Compétence(s)</label>
            <select name="field" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
              <option value="AL">AL</option>
              <option value="SI">SI</option>
              <option value="SRC">SRC</option>
              <option value="AL-SI">AL-SI</option>
              <option value="AL-SRC">AL-SRC</option>
              <option value="SI-SRC">SI-SRC</option>
              <option value="AL-SI-SRC">AL-SI-SRC</option>
            </select>
          </div>

          <div class="mb-6">
            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
            <input type="tel" name="phone_number" pattern="[0-9]+" placeholder="Ex: 0199999999" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div class="alert mb-4 p-3 rounded-md 
                <?php echo ($_SESSION['message']['type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
              <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Créer</button>
        </form>
    </div>
</main>


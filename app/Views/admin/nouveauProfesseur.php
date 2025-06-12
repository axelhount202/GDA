<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<main style="display: flex; min-height: 100vh; background-color: #f3f4f6;">
    <nav style="width: 16rem; background-color: #1f2937; color: white; padding: 1rem;">
        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.5rem;">                
            <li><a href="/admin" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Dashboard</a></li>
            <li><a href="/admin/affectations" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Affectations</a></li>
            <li><a href="/admin/professeurs" style="display: block; padding: 0.5rem 1rem; border-radius: 0.25rem; text-decoration: none; color: inherit; transition: background-color 0.2s ease-in-out;">Professeurs</a></li>
            <form action="/logout" method="POST" style="padding-top: 1rem;">
                <button type="submit" style="width: 100%; background-color: #dc2626; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Déconnexion</button>
            </form>
        </ul>
    </nav>
    <div style="flex: 1; padding: 2rem;">
        <h1 style="font-size: 2.25rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Dashboard Administrateur</h1>
        <h2 style="font-size: 1.875rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Nouveau professeur</h2>
        <form action="/admin/professeurs/creer" method="POST" style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 1.5rem; max-width: 28rem; margin-left: auto; margin-right: auto;">
          <div style="margin-bottom: 1rem;">
            <label for="lastname" style="display: block; color: #374151; font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem;">Nom</label>
            <input type="text" name="lastname" required style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
          </div>

          <div style="margin-bottom: 1rem;">
            <label for="surname" style="display: block; color: #374151; font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem;">Prénom</label>
            <input type="text" name="surname" required style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
          </div>

          <div style="margin-bottom: 1rem;">
            <label for="field" style="display: block; color: #374151; font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem;">Compétence(s)</label>
            <select name="field" style="display: block; appearance: none; width: 100%; background-color: white; border: 1px solid #9ca3af; padding: 0.5rem 1rem; border-radius: 0.25rem; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
              <option value="AL">AL</option>
              <option value="SI">SI</option>
              <option value="SRC">SRC</option>
              <option value="AL-SI">AL-SI</option>
              <option value="AL-SRC">AL-SRC</option>
              <option value="SI-SRC">SI-SRC</option>
              <option value="AL-SI-SRC">AL-SI-SRC</option>
            </select>
          </div>

          <div style="margin-bottom: 1.5rem;">
            <label for="phone_number" style="display: block; color: #374151; font-size: 0.875rem; font-weight: bold; margin-bottom: 0.5rem;">Téléphone</label>
            <input type="tel" name="phone_number" pattern="[0-9]+" placeholder="Ex: 0199999999" required style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
          </div>

          <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
            <div style="margin-bottom: 1rem; padding: 0.75rem; border-radius: 0.375rem; 
                <?php echo ($_SESSION['message']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
              <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
            </div>
          <?php endif; ?>

          <button type="submit" style="background-color: #2563eb; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Créer</button>
        </form>
    </div>
</main>
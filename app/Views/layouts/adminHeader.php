<?php include __DIR__ . '/../layouts/adminHeader.php'; ?>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif; /* You might want to define a specific font-family */
        background-color: #f3f4f6; /* Equivalent to bg-gray-100 */
        min-height: 100vh;
        display: flex;
        flex-direction: column; /* Stacks navigation and main content vertically */
    }

    .top-nav {
        background-color: #1f2937; /* Equivalent to bg-gray-800 */
        padding: 1rem; /* Equivalent to p-4 */
        color: white;
        display: flex; /* Makes items inside horizontal */
        justify-content: flex-start; /* Aligns items to the start */
        align-items: center; /* Vertically aligns items */
        flex-wrap: wrap; /* Allows items to wrap on smaller screens */
    }

    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex; /* Horizontal list items */
        gap: 1rem; /* Space between links */
        flex-grow: 1; /* Allows the list to take available space */
        align-items: center;
    }

    .nav-list-item a {
        display: block;
        padding: 0.5rem 1rem; /* Equivalent to py-2 px-4 */
        border-radius: 0.25rem; /* Equivalent to rounded */
        color: inherit;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
    }

    .nav-list-item a:hover {
        background-color: #374151; /* Equivalent to hover:bg-gray-700 */
    }

    .logout-form {
        margin-left: auto; /* Pushes the logout button to the right */
    }

    .logout-button {
        background-color: #dc2626; /* Equivalent to bg-red-600 */
        color: white;
        font-weight: bold;
        padding: 0.5rem 1rem; /* Equivalent to py-2 px-4 */
        border-radius: 0.25rem; /* Equivalent to rounded */
        border: none;
        cursor: pointer;
        outline: none;
        box-shadow: 0 0 transparent;
        transition: background-color 0.2s ease-in-out;
    }

    .logout-button:hover {
        background-color: #b91c1c; /* Equivalent to hover:bg-red-700 */
    }

    .main-content {
        flex: 1; /* Takes remaining vertical space */
        padding: 2rem; /* Equivalent to p-8 */
    }
</style>

<nav class="top-nav">
    <ul class="nav-list">
        <li class="nav-list-item"><a href="/admin">Dashboard</a></li>
        <li class="nav-list-item"><a href="/admin/affectations">Affectations</a></li>
        <li class="nav-list-item"><a href="/admin/professeurs">Professeurs</a></li>
    </ul>
    <div class="logout-form">
        <form action="/logout" method="POST">
            <button type="submit" class="logout-button">Déconnexion</button>
        </form>
    </div>
</nav>

<main class="main-content">
    <h1 style="font-size: 2.25rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Dashboard Administrateur</h1>
    <h2 style="font-size: 1.875rem; font-weight: bold; margin-bottom: 1rem; color: #1f2937;">Liste des affectations</h2>
    <div style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; overflow: hidden; margin-bottom: 1.5rem;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Intitulé du cahier</th>
                    <th colspan="2" style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Professeur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($afficher_affectations as $affectation): ?>
                    <tr>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                            <?= htmlspecialchars(strlen($affectation['Intitule']) > 55 ? substr($affectation['Intitule'], 0, 55) . '...' : $affectation['Intitule']); ?>
                        </td>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                            <?= htmlspecialchars($affectation['Nom'] . " " .  $affectation['Prenom']); ?>
                        </td>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem; text-align: right;">
                            <form action="/admin/affectations/supprimer" method="POST">
                                <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
                                <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
                                <button type="submit" style="background-color: #ef4444; color: white; font-weight: bold; padding: 0.25rem 0.75rem; border-radius: 0.25rem; font-size: 0.75rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div style="margin-top: 0.75rem; padding: 0.75rem; border-radius: 0.375rem;
            <?php echo ($_SESSION['message']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
</main>
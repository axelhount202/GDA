<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background-color: #f3f4f6;
        min-height: 100vh;
        /* Body no longer needs to be a flex container for the main layout */
        /* It can just hold the fixed nav and the scrollable main content */
    }

    .top-nav {
        background-color: #1f2937;
        padding: 1rem;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        flex-shrink: 0;
        width: 200px;
        min-height: 100vh;

        /* --- New/Modified CSS for Fixed Navigation --- */
        position: fixed; /* Makes the navigation fixed relative to the viewport */
        top: 0;          /* Positions it at the top of the viewport */
        left: 0;         /* Positions it at the left of the viewport */
        z-index: 1000;   /* Ensures it stays on top of other content */
        /* --- End New/Modified CSS --- */
    }

    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        flex-grow: 1;
        align-items: flex-start;
        width: 100%;
    }

    .nav-list-item {
        width: 100%;
    }

    .nav-list-item a {
        display: block;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        color: inherit;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
        text-align: left;
    }

    .nav-list-item a:hover {
        background-color: #374151;
    }

    .logout-form {
        margin-top: auto;
        width: 100%;
        padding-top: 1rem;
    }

    .logout-button {
        background-color: #dc2626;
        color: white;
        font-weight: bold;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        border: none;
        cursor: pointer;
        outline: none;
        box-shadow: 0 0 transparent;
        transition: background-color 0.2s ease-in-out;
        width: 100%;
        text-align: center;
    }

    .logout-button:hover {
        background-color: #b91c1c;
    }

    .main-content {
        /* --- New/Modified CSS for Main Content --- */
        margin-left: 200px; /* Adjust this to match the width of your fixed nav */
        flex: 1; /* This will still work if body eventually becomes flex, but not strictly needed now */
        padding: 2rem;
        /* --- End New/Modified CSS --- */
    }

    /* Styles for the table and messages remain unchanged as they are in the main content area */
    .table-container {
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 0.75rem 1.25rem;
        text-align: left;
        font-size: 0.75rem;
    }

    th {
        border-bottom: 2px solid #e5e7eb;
        background-color: #e5e7eb;
        font-weight: 600;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    td {
        border-bottom: 1px solid #e5e7eb;
        background-color: white;
        font-size: 0.875rem;
    }

    .delete-button {
        background-color: #ef4444;
        color: white;
        font-weight: bold;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .delete-button:hover {
        background-color: #dc2626;
    }

    .message-container {
        margin-top: 0.75rem;
        padding: 0.75rem;
        border-radius: 0.375rem;
    }

    .message-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .message-error {
        background-color: #fee2e2;
        color: #991b1b;
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
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Intitulé du cahier</th>
                    <th colspan="2" style="padding: 0.75rem 1.25rem; border-bottom: 2px solid #e5e7eb; background-color: #e5e7eb; text-align: left; font-size: 0.75rem; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em;">Professeur</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifiez si $afficher_affectations est défini et est un tableau, sinon initialisez-le comme un tableau vide
                $afficher_affectations = isset($afficher_affectations) && is_array($afficher_affectations) ? $afficher_affectations : [];
                ?>
                <?php foreach ($afficher_affectations as $affectation): ?>
                    <tr>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                            <?= htmlspecialchars(strlen($affectation['Intitule']) > 55 ? substr($affectation['Intitule'], 0, 55) . '...' : $affectation['Intitule']); ?>
                        </td>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem;">
                            <?= htmlspecialchars($affectation['Nom'] . " " . $affectation['Prenom']); ?>
                        </td>
                        <td style="padding: 1.25rem; border-bottom: 1px solid #e5e7eb; background-color: white; font-size: 0.875rem; text-align: right;">
                            <form action="/admin/affectations/supprimer" method="POST">
                                <input type="hidden" name="cahier_id" value="<?= $affectation['Id_Cahier'] ?>">
                                <input type="hidden" name="professeur_id" value="<?= $affectation['Id_Professeur'] ?>">
                                <button type="submit" class="delete-button">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($afficher_affectations)): ?>
                    <tr>
                        <td colspan="3" style="padding: 1.25rem; text-align: center; color: #6b7280; font-style: italic;">
                            Aucune affectation à afficher pour le moment.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
        <div class="message-container <?php echo ($_SESSION['message']['type'] == 'success') ? 'message-success' : 'message-error'; ?>">
            <?= htmlspecialchars($_SESSION['message']['message']); unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
</main>
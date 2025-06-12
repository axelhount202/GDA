<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<div style="background-color: white; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 2rem; width: 100%; max-width: 42rem; margin-left: auto; margin-right: auto;">
        <h1 style="font-size: 2.25rem; font-weight: bold; color: #1f2937; text-align: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e5e7eb;">Statut du cahier</h1>

        <?php if (!isset($informations) || empty($informations)): ?>
            <div style="background-color: #fffbeb; border: 1px solid #fcd34d; color: #b45309; padding: 0.75rem 1rem; border-radius: 0.25rem; position: relative; margin-bottom: 1.5rem;" role="alert">
                <strong style="font-weight: bold;">Attention!</strong>
                <span style="display: inline;">Aucun cahier des charges soumis pour le moment.</span>
            </div>
            <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.375rem; border: 1px solid #e5e7eb;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem; color: #374151;">Informations cahier</h2>
                <div style="line-height: 1.5; color: #4b5563;">
                    <p>Nom binôme : <strong style="font-weight: bold;">inconnu</strong></p>
                    <p>Prénom binôme : <strong style="font-weight: bold;">inconnu</strong></p>
                    <p>Intitulé du cahier : <strong style="font-weight: bold;">inconnu</strong></p>
                </div>
            </div>
        <?php else: ?>
            <div style="background-color: #f9fafb; padding: 1rem; border-radius: 0.375rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem; color: #374151;">Informations</h2>
                <div style="line-height: 1.5; color: #4b5563;">
                    <p>Nom binôme : <strong style="font-weight: bold;"><?= htmlspecialchars($informations['Nom_binome']); ?></strong></p>
                    <p>Prénom binôme : <strong style="font-weight: bold;"><?= htmlspecialchars($informations['Prenom_binome']); ?></strong></p>
                    <p>Intitulé du cahier : <strong style="font-weight: bold;"><?= htmlspecialchars($informations['Intitule']); ?></strong></p>
                    <p>Statut : <strong style="font-weight: bold; 
                        <?php 
                        if ($informations['Statut'] === 'Affecté') echo 'color: #059669;';
                        elseif ($informations['Statut'] === 'En attente') echo 'color: #d97706;';
                        else echo 'color: #dc2626;';
                        ?>">
                        <?= htmlspecialchars($informations['Statut']); ?>
                    </strong></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message']['notify']) && !empty($_SESSION['message']['notify'])): ?>
            <div style="margin-top: 1.5rem; padding: 0.75rem; border-radius: 0.375rem; 
                <?php echo ($_SESSION['message']['notify']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
                <?= htmlspecialchars($_SESSION['message']['notify']['message']); unset($_SESSION['message']['notify']) ?>
            </div>
        <?php endif; ?>

        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 2rem;">
            <form action="/etudiant/statu/relance" method="POST" style="flex: 1;">
                <button type="submit" style="width: 100%; background-color: #2563eb; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.15s ease-in-out;">Faire une relance</button>
            </form>
            <form action="/etudiant/statu/supprimer" method="POST" style="flex: 1;">
                <button type="submit" style="width: 100%; background-color: #dc2626; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.15s ease-in-out;">Supprimer le cahier</button>
            </form>
        </div>
    </div>
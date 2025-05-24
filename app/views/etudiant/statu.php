<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<main class="main-1">
<h1>Vérification de l'affectation du cahier</h1>
    <!-- Message concernant le statu d'affectation -->
    <?php if (isset($_SESSION['message']['affectation']) && !empty($_SESSION['message']['affectation'])): ?>
        <div class="alert <?= $_SESSION['message']['affectation']['type']; ?>">
            <?= htmlspecialchars($_SESSION['message']['affectation']['message']); unset($_SESSION['message']['affectation'])?>
        </div>
    <?php endif; ?>

    <?php if (!$informations): ?>
        <div class="infos">
            <h1>Informations cahier</h1>
            <div>
                <p>Nom binôme : inconnu</p>
                <p>Prénom binôme : inconnu</p>
                <p>Intitulé du cahier : inconnu</p>
            </div>
        </div>
    <?php else: ?>
        <div class="infos">
            <h1>Informations</h1>
            <div>
                <p>Nom binôme : <?= htmlspecialchars($informations['Nom_binome']); ?></p>
                <p>Prénom binôme : <?= htmlspecialchars($informations['Prenom_binome']); ?></p>
                <p>Intitulé du cahier : <?= htmlspecialchars($informations['Intitule']); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <form action="/etudiant/statu/relance" method="POST" class="statu-form">
        <button type="submit">Faire une relance</button>
    </form>
    <!-- Message concernant la relance -->
    <?php if (isset($_SESSION['message']['notify']) && !empty($_SESSION['message']['notify'])): ?>
        <div class="alert mt-5 <?= $_SESSION['message']['notify']['type']; ?>">
            <?= htmlspecialchars($_SESSION['message']['notify']['message']); unset($_SESSION['message']['notify']) ?>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/../layouts/etuFooter.php'; ?>
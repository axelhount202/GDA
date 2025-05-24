<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<main class="main-1">
    <h1>Soumettre un cahier des charges</h1>
    <form action="/etudiant/envoyer" method="POST" enctype="multipart/form-data">
        <label for="member_2_lastname">Nom du binôme</label>
        <input type="text" name="member_2_lastname" required>

        <label for="member_2_surname">Prénom du binôme</label>
        <input type="text" name="member_2_surname" required>

        <label for="member_2_field">Filière du binôme</label>
        <select name="member_2_field" required>
            <option value="AL">AL</option>
            <option value="SI">SI</option>
            <option value="SRC">SRC</option>
        </select>

        <label for="title">Intitulé du cahier</label>
        <input type="text" name="title" required>

        <label for="pdf_file">Fichier PDF</label>
        <input type="file" name="pdf_file" accept="application/pdf" required>

        <!-- Message d'erreur concernant le formulaire -->
        <?php if (isset($_SESSION['message']['form']) && !empty($_SESSION['message']['form'])): ?>
            <div class="alert <?= $_SESSION['message']['form']['type'];  ?>" style="margin-bottom: 10px">
                <?= htmlspecialchars($_SESSION['message']['form']['message']); unset($_SESSION['message']['form']); ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="spe-button-1">Soumettre</button>
    </form>
</main>

<?php require __DIR__ . '/../layouts/etuFooter.php'; ?>
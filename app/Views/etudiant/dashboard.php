<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<div style="background-color: white; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); border-radius: 0.5rem; padding: 2rem; width: 100%; max-width: 42rem; margin-left: auto; margin-right: auto;">
        <h1 style="font-size: 2.25rem; font-weight: bold; color: #1f2937; text-align: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e5e7eb;">Soumettre un cahier des charges</h1>
        <form action="/etudiant/envoyer" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <label for="member_2_lastname" style="display: block; color: #374151; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Nom du binôme</label>
                <input type="text" name="member_2_lastname" required 
                       style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
            </div>

            <div>
                <label for="member_2_surname" style="display: block; color: #374151; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Prénom du binôme</label>
                <input type="text" name="member_2_surname" required 
                       style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
            </div>

            <div>
                <label for="intitule" style="display: block; color: #374151; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Intitulé du cahier des charges</label>
                <input type="text" name="intitule" required 
                       style="box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); appearance: none; border: 1px solid #d1d5db; border-radius: 0.25rem; width: 100%; padding: 0.5rem 0.75rem; color: #374151; line-height: 1.25; outline: none; transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;">
            </div>

            <div>
                <label for="pdf_file" style="display: block; color: #374151; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Fichier PDF</label>
                <input type="file" name="pdf_file" accept="application/pdf" required 
                       style="display: block; width: 100%; font-size: 0.875rem; color: #1f2937; border: 1px solid #d1d5db; border-radius: 0.375rem; cursor: pointer; background-color: #f9fafb; padding: 0.5rem 0.75rem; outline: none; transition: border-color 0.2s ease-in-out, background-color 0.2s ease-in-out;">
            </div>

            <?php if (isset($_SESSION['message']['form']) && !empty($_SESSION['message']['form'])): ?>
                <div style="margin-top: 1rem; padding: 0.75rem; border-radius: 0.375rem; 
                    <?php echo ($_SESSION['message']['form']['type'] == 'success') ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fee2e2; color: #991b1b;'; ?>">
                    <?= htmlspecialchars($_SESSION['message']['form']['message']); unset($_SESSION['message']['form']); ?>
                </div>
            <?php endif; ?>

            <button type="submit" style="background-color: #2563eb; color: white; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.25rem; border: none; cursor: pointer; transition: background-color 0.2s ease-in-out;">Soumettre</button>
        </form>
    </div>
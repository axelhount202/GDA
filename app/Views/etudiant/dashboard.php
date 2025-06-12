<?php require __DIR__ . '/../layouts/etuHeader.php'; ?>

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-6 pb-4 border-b-2 border-gray-200">Soumettre un cahier des charges</h1>
        <form action="/etudiant/envoyer" method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="member_2_lastname" class="block text-gray-700 text-sm font-semibold mb-2">Nom du binôme</label>
                <input type="text" name="member_2_lastname" required 
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="member_2_surname" class="block text-gray-700 text-sm font-semibold mb-2">Prénom du binôme</label>
                <input type="text" name="member_2_surname" required 
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="member_2_field" class="block text-gray-700 text-sm font-semibold mb-2">Filière du binôme</label>
                <select name="member_2_field" required 
                        class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 rounded shadow-sm leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="AL">AL</option>
                    <option value="SI">SI</option>
                    <option value="SRC">SRC</option>
                </select>
            </div>

            <div>
                <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Intitulé du cahier</label>
                <input type="text" name="title" required 
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="pdf_file" class="block text-gray-700 text-sm font-semibold mb-2">Fichier PDF</label>
                <input type="file" name="pdf_file" accept="application/pdf" required 
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <?php if (isset($_SESSION['message']['form']) && !empty($_SESSION['message']['form'])): ?>
                <div class="alert mt-4 p-3 rounded-md 
                    <?php echo ($_SESSION['message']['form']['type'] == 'success') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?= htmlspecialchars($_SESSION['message']['form']['message']); unset($_SESSION['message']['form']); ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">Soumettre</button>
        </form>
    </div>


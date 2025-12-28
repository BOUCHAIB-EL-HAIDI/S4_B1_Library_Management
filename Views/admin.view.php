<?php
$pageTitle = "Admin Dashboard";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-7xl mx-auto">
    
    <h1 class="text-3xl font-bold mb-8">📊 Admin Dashboard</h1>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
    <div class="grid md:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">➕ Ajouter un Livre</h2>
            
            <form method="POST" action="/admin">
                <input type="hidden" name="action" value="add">
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Titre</label>
                    <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Auteur</label>
                    <input type="text" name="author" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Année</label>
                    <input type="number" name="year" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Ajouter
                </button>
            </form>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">📈 Statistiques</h2>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-blue-50 rounded">
                    <span class="font-bold">Total Livres</span>
                    <span class="text-2xl text-blue-600"><?= count($books) ?></span>
                </div>
                
                <div class="flex justify-between items-center p-4 bg-green-50 rounded">
                    <span class="font-bold">Livres Disponibles</span>
                    <span class="text-2xl text-green-600">
                        <?= count(array_filter($books, fn($b) => $b['status'] === 'available')) ?>
                    </span>
                </div>
                
                <div class="flex justify-between items-center p-4 bg-red-50 rounded">
                    <span class="font-bold">Livres Empruntés</span>
                    <span class="text-2xl text-red-600">
                        <?= count(array_filter($books, fn($b) => $b['status'] === 'borrowed')) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h2 class="text-2xl font-bold mb-4">📚 Gestion des Livres</h2>
        
        <?php if (empty($books)): ?>
            <p class="text-gray-600">Aucun livre dans la bibliothèque</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 text-left">ID</th>
                            <th class="py-2 px-4 text-left">Titre</th>
                            <th class="py-2 px-4 text-left">Auteur</th>
                            <th class="py-2 px-4 text-left">Année</th>
                            <th class="py-2 px-4 text-left">Statut</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4"><?= $book['id'] ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($book['title']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($book['author']) ?></td>
                                <td class="py-2 px-4"><?= $book['year'] ?></td>
                                <td class="py-2 px-4">
                                    <?php if ($book['status'] === 'available'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Disponible</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">Emprunté</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-2 px-4">
                                    <button 
                                        onclick="openEditModal(<?= $book['id'] ?>, '<?= htmlspecialchars($book['title']) ?>', '<?= htmlspecialchars($book['author']) ?>', <?= $book['year'] ?>)"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 mr-2"
                                    >
                                        ✏️ Modifier
                                    </button>
                                    
                                    <form method="POST" action="/admin" class="inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="bookId" value="<?= $book['id'] ?>">
                                        <button 
                                            type="submit" 
                                            onclick="return confirm('Supprimer ce livre?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                        >
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h2 class="text-2xl font-bold mb-4">📋 Tous les Emprunts</h2>
        
        <?php if (empty($borrows)): ?>
            <p class="text-gray-600">Aucun emprunt enregistré</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 text-left">Lecteur</th>
                            <th class="py-2 px-4 text-left">Livre</th>
                            <th class="py-2 px-4 text-left">Date Emprunt</th>
                            <th class="py-2 px-4 text-left">Date Retour</th>
                            <th class="py-2 px-4 text-left">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($borrows as $borrow): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4"><?= htmlspecialchars($borrow['firstName'] . ' ' . $borrow['lastName']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($borrow['title']) ?></td>
                                <td class="py-2 px-4"><?= date('d/m/Y', strtotime($borrow['borrowDate'])) ?></td>
                                <td class="py-2 px-4">
                                    <?= $borrow['returnDate'] ? date('d/m/Y', strtotime($borrow['returnDate'])) : '-' ?>
                                </td>
                                <td class="py-2 px-4">
                                    <?php if ($borrow['returnDate']): ?>
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-sm">Retourné</span>
                                    <?php else: ?>
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">En cours</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4">✏️ Modifier le Livre</h2>
        
        <form method="POST" action="/admin">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="bookId" id="editBookId">
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Titre</label>
                <input type="text" name="title" id="editTitle" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Auteur</label>
                <input type="text" name="author" id="editAuthor" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Année</label>
                <input type="number" name="year" id="editYear" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            
            <div class="flex space-x-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Sauvegarder
                </button>
                <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400">
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, title, author, year) {
    document.getElementById('editBookId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editAuthor').value = author;
    document.getElementById('editYear').value = year;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

<?php
require __DIR__ . '/../Partials/footer.php';
?>
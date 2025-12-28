<?php


$pageTitle = "Livres";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-6xl mx-auto">
    
   
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">📚 Tous les Livres</h1>
        
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
           
            <a href="/admin" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Gérer les livres
            </a>
        <?php endif; ?>
    </div>
    
   
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
    
   
    <?php if (empty($books)): ?>
        
       
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📚</div>
            <p class="text-gray-600">Aucun livre disponible pour le moment</p>
        </div>
        
    <?php else: ?>
        
        
        <div class="grid md:grid-cols-3 gap-6">
            
            <?php foreach ($books as $book): ?>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    
                   
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-6xl">📖</span>
                    </div>
                    
                    <div class="p-4">
                        
                       
                        <h3 class="font-bold text-lg mb-2">
                            <?= htmlspecialchars($book['title']) ?>
                        </h3>
                        
                       
                        <p class="text-gray-600 mb-1">
                            par <?= htmlspecialchars($book['author']) ?>
                        </p>
                        
                    
                        <p class="text-gray-500 text-sm mb-3">
                            Publié en <?= htmlspecialchars($book['year']) ?>
                        </p>
                        
                       
                        <?php if ($book['status'] === 'available'): ?>
                            <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold mb-3">
                                ✓ Disponible
                            </span>
                        <?php else: ?>
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold mb-3">
                                ✗ Emprunté
                            </span>
                        <?php endif; ?>
                        
                       
                        <?php if ($_SESSION['user']['role'] === 'reader' && $book['status'] === 'available'): ?>
                            <form method="POST" action="/borrow" class="mt-3">
                                <input type="hidden" name="bookId" value="<?= $book['id'] ?>">
                                <button 
                                    type="submit"
                                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
                                >
                                    Emprunter
                                </button>
                            </form>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
            <?php endforeach; ?>
            
        </div>
        
    <?php endif; ?>
    
</div>

<?php
require __DIR__ . '/../Partials/footer.php';
?>
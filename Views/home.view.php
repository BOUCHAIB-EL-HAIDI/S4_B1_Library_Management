<?php

$pageTitle = "Accueil";


require __DIR__ . '/../Partials/header.php';
?>


<div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-lg p-12 mb-8">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-5xl font-bold mb-4">
            Bienvenue à la Bibliothèque
        </h1>
        <p class="text-xl mb-8">
            Découvrez des milliers de livres et empruntez facilement en ligne
        </p>
        
        <?php if (isset($_SESSION['user'])): ?>
            
            <a href="/books" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition inline-block">
                Voir les livres 📚
            </a>
        <?php else: ?>
           
            <div class="space-x-4">
                <a href="/signup" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition inline-block">
                    S'inscrire
                </a>
                <a href="/login" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition inline-block">
                    Se connecter
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>


<div class="grid md:grid-cols-3 gap-8 mb-12">
    
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-5xl mb-4">📖</div>
        <h3 class="text-xl font-bold mb-2">Large Collection</h3>
        <p class="text-gray-600">
            Des milliers de livres dans tous les genres
        </p>
    </div>
    
   
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-5xl mb-4">🚀</div>
        <h3 class="text-xl font-bold mb-2">Emprunt Facile</h3>
        <p class="text-gray-600">
            Empruntez en un clic et retournez quand vous voulez
        </p>
    </div>
    
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-5xl mb-4">⏰</div>
        <h3 class="text-xl font-bold mb-2">24/7 Disponible</h3>
        <p class="text-gray-600">
            Accédez à notre catalogue à tout moment
        </p>
    </div>
    
</div>


<div class="bg-white rounded-lg shadow-md p-8">
    <h2 class="text-3xl font-bold text-center mb-8">Nos Statistiques</h2>
    
    <div class="grid md:grid-cols-3 gap-8 text-center">
        <div>
            <div class="text-4xl font-bold text-blue-600 mb-2">1,000+</div>
            <div class="text-gray-600">Livres Disponibles</div>
        </div>
        <div>
            <div class="text-4xl font-bold text-green-600 mb-2">500+</div>
            <div class="text-gray-600">Lecteurs Actifs</div>
        </div>
        <div>
            <div class="text-4xl font-bold text-purple-600 mb-2">2,000+</div>
            <div class="text-gray-600">Emprunts Réalisés</div>
        </div>
    </div>
</div>

<?php

require __DIR__ . '/../Partials/footer.php';
?>
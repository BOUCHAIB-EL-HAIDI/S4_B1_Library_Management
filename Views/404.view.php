<?php


$pageTitle = "Page non trouvée";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-2xl mx-auto text-center py-12">
    
 
    <div class="text-9xl font-bold text-blue-600 mb-4">
        404
    </div>
    

  
    <h1 class="text-4xl font-bold text-gray-800 mb-4">
        Page non trouvée
    </h1>
    
    <p class="text-xl text-gray-600 mb-8">
        Désolé, la page que vous cherchez n'existe pas.
    </p>
    
   
    <a 
        href="/" 
        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition"
    >
        Retour à l'accueil
    </a>
    
</div>

<?php
require __DIR__ . '/../Partials/footer.php';
?>
<?php
/**
 * ABOUT PAGE VIEW
 */

$pageTitle = "À propos";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-4xl mx-auto">
    
    <h1 class="text-3xl font-bold text-center mb-8">À propos de nous</h1>
    
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h2 class="text-2xl font-bold mb-4">Notre Mission</h2>
        <p class="text-gray-700 mb-4">
            Notre bibliothèque s'engage à promouvoir la lecture et l'accès à la connaissance 
            pour tous. Nous croyons que les livres sont des fenêtres ouvertes sur le monde 
            et des outils essentiels pour l'éducation et le développement personnel.
        </p>
        
        <h2 class="text-2xl font-bold mb-4 mt-8">Notre Histoire</h2>
        <p class="text-gray-700 mb-4">
            Fondée en 1990, notre bibliothèque a servi des milliers de lecteurs au fil des ans. 
            Aujourd'hui, nous combinons tradition et modernité en offrant une plateforme en ligne 
            pour faciliter l'accès à notre collection.
        </p>
        
        <h2 class="text-2xl font-bold mb-4 mt-8">Nos Valeurs</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>Accessibilité pour tous</li>
            <li>Promotion de la lecture</li>
            <li>Innovation et modernisation</li>
            <li>Service de qualité</li>
        </ul>
    </div>
    


<?php
require __DIR__ . '/../Partials/footer.php';
?>
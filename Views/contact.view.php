<?php

$pageTitle = "Contact";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-2xl mx-auto">
    
    <h1 class="text-3xl font-bold text-center mb-8">Contactez-nous</h1>
    
    <div class="bg-white rounded-lg shadow-md p-8">
        
     
        <form class="space-y-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Nom</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">Message</label>
                <textarea class="w-full px-4 py-2 border rounded-lg" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700">
                Envoyer
            </button>
        </form>
        
    </div>
</div>

<?php
require __DIR__ . '/../Partials/footer.php';
?>
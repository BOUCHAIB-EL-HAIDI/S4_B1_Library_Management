<?php


$pageTitle = "Inscription";
require __DIR__ . '/../Partials/header.php';
?>

<div class="max-w-md mx-auto">
    
   
    <h1 class="text-3xl font-bold text-center mb-8">Créer un compte</h1>
    
    
    <div class="bg-white rounded-lg shadow-md p-8">
        
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        
        <form method="POST" action="/signup">
            
          
            <div class="mb-4">
                <label for="firstName" class="block text-gray-700 font-bold mb-2">
                    Prénom
                </label>
                <input 
                    type="text" 
                    id="firstName" 
                    name="firstName" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Prenom"
                >
            </div>
            
            
            <div class="mb-4">
                <label for="lastName" class="block text-gray-700 font-bold mb-2">
                    Nom
                </label>
                <input 
                    type="text" 
                    id="lastName" 
                    name="lastName" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Nom"
                >
            </div>
            
           
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="votre@email.com"
                >
            </div>
            
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">
                    Mot de passe
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    minlength="6"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="••••••••"
                >
               
            </div>
            
            
            <div class="mb-6">
                <label for="confirmPassword" class="block text-gray-700 font-bold mb-2">
                    Confirmer le mot de passe
                </label>
                <input 
                    type="password" 
                    id="confirmPassword" 
                    name="confirmPassword" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="••••••••"
                >
            </div>
            
            
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition"
            >
                S'inscrire
            </button>
            
        </form>
    
        
    </div>
</div>

<?php
require __DIR__ . '/../Partials/footer.php';
?>
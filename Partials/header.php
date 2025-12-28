<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$isLoggedIn = isset($_SESSION['user']);
$userRole = $_SESSION['user']['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - <?= $pageTitle ?? 'Accueil' ?></title>
    
   
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">


    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
              
                <a href="/" class="text-2xl font-bold">
                    📚 Library
                </a>
                
                
                <div class="flex items-center space-x-6">
                    
                   
                    <a href="/" class="hover:text-blue-200 transition">Accueil</a>
                    <a href="/about" class="hover:text-blue-200 transition">À propos</a>
                    <a href="/contact" class="hover:text-blue-200 transition">Contact</a>
                    
                    <?php if ($isLoggedIn): ?>
                        
                        <a href="/books" class="hover:text-blue-200 transition">Livres</a>
                        
                        <?php if ($userRole === 'admin'): ?>
                        
                            <a href="/admin" class="hover:text-blue-200 transition">Admin</a>
                        <?php endif; ?>
                        
                        <a href="/profile" class="hover:text-blue-200 transition">Profil</a>
                        <a href="/logout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition">
                            Déconnexion
                        </a>
                    <?php else: ?>
                       
                        <a href="/login" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600 transition">
                            Connexion
                        </a>
                        <a href="/signup" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-700 transition">
                            Inscription
                        </a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </nav>

    
    <main class="container mx-auto px-4 py-8">

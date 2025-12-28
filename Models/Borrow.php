
<?php

session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Vous devez vous connecter!";
    header('Location: /login');
    exit;
}

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Reader.php';

$db = new Database();
$pdo = $db->getConnection();

$reader = new Reader($pdo);
$reader->id = $_SESSION['user']['id'];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($url === '/borrow' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $bookId = $_POST['bookId'] ?? null;
    
    if (!$bookId) {
        $_SESSION['error'] = "ID du livre manquant!";
        header('Location: /books');
        exit;
    }
    
    if ($reader->borrowBook($bookId)) {
        $_SESSION['success'] = "Livre emprunté avec succès!";
        header('Location: /profile');
    } else {
        $_SESSION['error'] = "Ce livre n'est pas disponible!";
        header('Location: /books');
    }
    exit;
    
} elseif ($url === '/return' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $borrowId = $_POST['borrowId'] ?? null;
    
    if (!$borrowId) {
        $_SESSION['error'] = "ID d'emprunt manquant!";
        header('Location: /profile');
        exit;
    }
    
    if ($reader->returnBook($borrowId)) {
        $_SESSION['success'] = "Livre retourné avec succès!";
    } else {
        $_SESSION['error'] = "Erreur lors du retour!";
    }
    header('Location: /profile');
    exit;
    
} else {
    header('Location: /books');
    exit;
}
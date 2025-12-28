<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    die('Accès refusé');
}

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Admin.php';

$db = new Database();
$pdo = $db->getConnection();
$admin = new Admin($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $data = [
            'title' => trim($_POST['title']),
            'author' => trim($_POST['author']),
            'year' => intval($_POST['year'])
        ];
        
        if ($admin->addBook($data)) {
            $_SESSION['success'] = "Livre ajouté avec succès!";
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout du livre!";
        }
        header('Location: /admin');
        exit;
    }
    
    if ($action === 'edit') {
        $bookId = intval($_POST['bookId']);
        $data = [
            'title' => trim($_POST['title']),
            'author' => trim($_POST['author']),
            'year' => intval($_POST['year'])
        ];
        
        if ($admin->updateBook($bookId, $data)) {
            $_SESSION['success'] = "Livre modifié avec succès!";
        } else {
            $_SESSION['error'] = "Erreur lors de la modification!";
        }
        header('Location: /admin');
        exit;
    }
    
    if ($action === 'delete') {
        $bookId = intval($_POST['bookId']);
        
        if ($admin->deleteBook($bookId)) {
            $_SESSION['success'] = "Livre supprimé avec succès!";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression!";
        }
        header('Location: /admin');
        exit;
    }
}

$books = $admin->getAllBooks();
$borrows = $admin->getAllBorrows();

require __DIR__ . "/../Views/admin.view.php";
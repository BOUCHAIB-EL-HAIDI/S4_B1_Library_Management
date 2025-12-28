<?php
session_start();

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Reader.php';
require_once __DIR__ . '/../Models/Admin.php';

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Simple validation
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont requis!";
        header('Location: /login');
        exit;
    }

    // Get user data 
    $userData = User::findByEmail($pdo, $email);

    if (!$userData) {
        $_SESSION['error'] = "Email ou mot de passe incorrect!";
        header('Location: /login');
        exit;
    }

   
    if ($userData['role'] === 'reader') {
        $user = new Reader($pdo);
    } else if ($userData['role'] === 'admin') {
        $user = new Admin($pdo);
    } else {
        $_SESSION['error'] = "Utilisateur invalide!";
        header('Location: /login');
        exit;
    }

   
    if ($user->login($email, $password)) {
   
        $_SESSION['user'] = [
            'id' => $userData['id'],
            'role' => $userData['role']
        ];

        // Redirect based on role
        if ($userData['role'] === 'admin') {
            header('Location: /admin');
        } else {
            header('Location: /');
        }
        exit;
    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect!";
        header('Location: /login');
        exit;
    }

} else {
    // Already logged in
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] === 'admin') {
            header('Location: /admin');
        } else {
            header('Location: /');
        }
        exit;
    }

    require __DIR__ . '/../Views/login.view.php';
}

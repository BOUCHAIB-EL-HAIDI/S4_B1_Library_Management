<?php


session_start();

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Reader.php';

$db = new Database();
$pdo = $db->getConnection();
$user = new Reader($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    
    // Validate
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont requis!";
        header('Location: /signup');
        exit;
    }
    
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas!";
        header('Location: /signup');
        exit;
    }
    
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
        $_SESSION['error'] = "the password should at least 8 charater long can contain special charater";
        header('Location: /signup');
        exit;
    }
      

    //check if the the email is a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Email invalide!";
    header('Location: /signup');
    exit;
    }

     
    // Check if email exists
    if (User::findByEmail($pdo , $email)) {
        $_SESSION['error'] = "invalid email choose a diffrent one";
        header('Location: /signup');
        exit;
    }
    
    // Create user
    $userData = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'password' => $password,
        'role' => 'reader'
    ];
    
    if ($user->create($userData)) {
        $_SESSION['success'] = "Compte créé avec succès! Vous pouvez vous connecter.";
        header('Location: /login');
        exit;
    } else {
        $_SESSION['error'] = "Erreur lors de la création du compte!";
        header('Location: /signup');
        exit;
    }
    
} else {
    
    
    if (isset($_SESSION['user'])) {
        header('Location: /');
        exit;
    }
    
    require __DIR__ . '/../Views/signup.view.php';
}
<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Admin.php';

$db = new Database();
$pdo = $db->getConnection();

$admin = new Admin($pdo);
$books = $admin->getAllBooks();

require __DIR__ . '/../Views/books.view.php';
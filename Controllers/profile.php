<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}

require_once __DIR__ . '/../Config/Connection.php';
require_once __DIR__ . '/../Models/Reader.php';

$db = new Database();
$pdo = $db->getConnection();

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

$reader = new Reader($pdo);
$reader->id = $_SESSION['user']['id'];
$borrows = $reader->myBorrows();

require __DIR__ . '/../Partials/header.php';
require __DIR__ . '/../Views/profile.view.php';
require __DIR__ . '/../Partials/footer.php';
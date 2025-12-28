<?php


session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['success'] = "Vous êtes déconnecté!";

header('Location: /');
exit;
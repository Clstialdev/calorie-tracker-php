<?php

require 'vendor/autoload.php';

use Manger\Controller\Users;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$controller = new Users();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
}

if (isset($_GET['q'])) {
    switch ($_GET['q']) {
        case 'logout':
            $controller->logout();
            break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
}


if (isset($_GET['action'])) {
    $ajaxAction = $_GET['action'];
    switch ($ajaxAction) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
            // ... autres actions ...
        default:
            // Gérer les actions inconnues ou non autorisées
            break;
    }
    exit; // Assurez-vous de quitter après le traitement AJAX.
}

if (isset($_GET['view'])) {
    include __DIR__ . '/app/Views/' . $_GET['view'] . '.php';
}

// vue par défaut
include __DIR__ . '/app/Views/login.php';

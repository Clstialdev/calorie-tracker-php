<?php
session_start();
require 'vendor/autoload.php';

use Manger\Controller\Users;
use Manger\Controller\ResetPasswords;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$controller = new Users();
$controllerPasswordLost = new ResetPasswords(); 

if (empty($_GET) && empty($_POST)) {
    include __DIR__ . '/app/Views/login.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'register':
            $controller->register();
            break;
        case 'login':
            $controller->login();
            break;
        case 'resetPassword': 
            $controllerPasswordLost->sendEmail();
            break;
        case 'newPassword':
            $controllerPasswordLost->resetPassword();
            break;
        case 'update-user-details':
            $controller->update_user_details();
            break;
        case 'update-user-credentials':
            $controller->update_user_credentials();
            break;
        case 'first-login':
            $controller->update_user_first_login();
            break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
}

if (isset($_GET['action'])) {
    $ajaxAction = $_GET['action'];
    switch ($ajaxAction) {
        case 'logout':
            $controller->logout();
            // ... autres actions ...
        default:
            // Gérer les actions inconnues ou non autorisées
            break;
    }
    exit; // Assurez-vous de quitter après le traitement AJAX.
}

if (isset($_GET['view'])) {
    $view = $_GET['view'];
  //  $allowedViews = ['settings', 'create-new-password', /* other allowed views */];

    
        $filePath = __DIR__ . '/app/Views/';

        // Special case for user settings
        if ($view == 'settings') {
            $filePath .= 'user/';
        }

        $filePath .= $view . '.php';

        // Check if file exists before including
        if (file_exists($filePath)) {
            include $filePath;
        } else {
            // Handle error or redirect if the file does not exist
            echo "Page not found";
        }
    
}


<?php

require 'vendor/autoload.php';

use Manger\Controller\Users;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$controller = new Users();


function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'register':
            console_log("dans register index");
            $controller->register();
            break;
        case 'login':
            console_log("dans login index");
            $controller->login();
            break;
        case 'resetPassword': // à modifier (appel du controller etc)
            include __DIR__ . '/../Views/reset-password.php';
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
    if ($_GET['view'] == 'settings') {
        include __DIR__ . '/app/Views/user/' . $_GET['view'] . '.php';
    } else {
        include __DIR__ . '/app/Views/' . $_GET['view'] . '.php';
    }
}

// vue par défaut
include __DIR__ . '/app/Views/login.php';

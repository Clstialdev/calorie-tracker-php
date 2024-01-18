<?php

require 'vendor/autoload.php';

use Manger\Controller\Users;

//include_once 'app/Controller/Users.php';


$view = isset($_GET['view']) ? $_GET['view'] : 'login';

if (isset($_GET['ajax_action'])) {
    $ajaxAction = $_GET['ajax_action'];
    switch ($ajaxAction) {
        case 'register':
            $controller = new Users();
            $controller->register();
            break;
        case 'login':
            $controller = new Users();
            $controller->login();
            break;
            // ... autres actions ...
        default:
            // Gérer les actions inconnues ou non autorisées
            break;
    }
    exit; // Assurez-vous de quitter après le traitement AJAX.
} else {
    switch ($view) {
        case 'login':
            include_once 'app/Views/login.php';
            break;
        case 'register':
            include_once 'app/Views/register.php';
            break;
            // ... Ajoutez d'autres vues au besoin ...
        default:
            include_once 'app/Views/login.php';
            break;
    }
}

<?php

require_once CONTROLLERSDIR . DS . 'Users.php';
require_once CONTROLLERSDIR . DS . 'ResetPasswords.php';

use Manger\Controller;


class Router {
    private $userController;
    private $resetPasswordController;

    public function __construct() {
        $this->userController = new \Manger\Controller\Users();
        $this->resetPasswordController = new \Manger\Controller\ResetPasswords();             
    }

    
    public function manageRequest() {

        if (empty($_GET) && empty($_POST)) {
            include VIEWSDIR. DS . 'login.php';
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_POST['action']) {
        case 'register':
            $this->userController->register();
            break;
        case 'login':
            $this->userController->login();
            break;
        case 'resetPassword': 
            $this->resetPasswordController->sendEmail();
            break;
        case 'newPassword':
            $this->resetPasswordController->resetPassword();
            break;
        case 'update-user-details':
            $this->userController->update_user_details();
            break;
        case 'update-user-credentials':
            $this->userController->update_user_credentials();
            break;
        case 'first-login':
            $this->userController->update_user_first_login();
            break;
        case 'showAllUsers':
                $this->userController->showAllUsers();
                break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Handling GET requests
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'logout':
                        $this->userController->logout();
                        break;
                    // Add more cases as needed
                    default:
                        // Default action or error handling
                        break;
                }
            }
            elseif (isset($_GET['view'])) {
                $this->userController->loadView($_GET['view']);
            }
        }
        // Additional request handling can be added here
    }
    
    
    
    
    
}
    

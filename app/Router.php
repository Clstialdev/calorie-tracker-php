<?php

require_once __DIR__ . DS . 'Controller' . DS . 'Users.php';
require_once __DIR__ . DS . 'Controller' . DS . 'ResetPasswords.php';
require_once __DIR__ . DS . 'Controller' . DS . 'recipesController.php';


use Manger\Controller;


class Router {
    private $userController;
    private $resetPasswordController;
    private $RecipeController;

    public function __construct() {
        $this->userController = new \Manger\Controller\Users();
        $this->resetPasswordController = new \Manger\Controller\ResetPasswords();  
        $this->RecipeController = new \Manger\Controller\RecipesController();           
    }

    
    public function manageRequest() {
       
        if (empty($_GET) && empty($_POST)) {
            include __DIR__ . '/app/Views/login.php';
            exit;
        }


   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
     switch ($_POST['action']) {
        case 'addRecipe':
            $this->RecipeController->addNewRecipe();
            break;
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
                    case 'showAllRecipes':
                        $this->RecipeController->recipesCont();
                        break;
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
                $this->loadView($_GET['view']);
            }
        }
        // Additional request handling can be added here
    }
    
    private function loadView($view) {
        $filePath = VIEWSDIR . DS . ($view == 'settings' ? 'user' . DS : '') . $view . '.php';
        
        if (file_exists($filePath)) {
            include $filePath;
        } else {
            echo "Page not found";
        }
    }
    
    
    
}
    

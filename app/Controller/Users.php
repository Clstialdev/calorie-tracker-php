<?php

namespace Manger\Controller;

use Manger\Model\User; // fonctionnel
use Manger\Helpers\Session_Helper; // fonctionnel

//require_once 'app/Helpers/Session_helper.php';
//require_once 'app/Model/User.php';

class Users
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        //Process form
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'fullname' => trim($_POST['fullname']),
            'password' => trim($_POST['password']),
            'email' => trim($_POST['email'])
        ];

        //User with the same email already exists
        if ($this->userModel->findUserByEmail($data['email'])) {


            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            return;
        }

        //Passed valdiation checks
        //Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        //Register User
        header('Content-Type: application/json');
        if ($this->userModel->register($data)) {
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong']);
            exit;
        }
    }

    public function login()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];

        if ($this->userModel->findUserByEmail($data['email'])) {
            //User found
            $loggerInUser = $this->userModel->login($data['email'], $data['password']);
            if ($loggerInUser) {
                $this->createUserSession($loggerInUser);
                echo json_encode(['success' => true]);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Password Incorrect']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No user found']);
            exit;
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['id'] = $user->id;
        $_SESSION['fullname'] = $user->fullname;
        $_SESSION['email'] = $user->email;
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['fullname']);
        unset($_SESSION['email']);
        session_destroy();
        echo json_encode(['success' => true]);
    }
}

$init = new Users;

//Ensure that user is sending a POST request.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            include __DIR__ . '/../Views/login.php';
            exit;
    }
}

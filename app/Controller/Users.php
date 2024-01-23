<?php


namespace Manger\Controller;

use Manger\Model\User; // fonctionnel
use Manger\Helpers\Session_Helper; // fonctionnel
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
        $_SESSION['id']=$user->id;
        $_SESSION['fullname']=$user->fullname;
        $_SESSION['email']=$user->email;
        $_SESSION['height']=$user->height;
        $_SESSION['age']=$user->age;
        $_SESSION['weight']=$user->weight;
        $_SESSION['goal']=$user->goal;
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['fullname']);
        unset($_SESSION['email']);
        unset($_SESSION['height']);
        unset($_SESSION['age']);
        unset($_SESSION['weight']);
        unset($_SESSION['goal']);

        session_destroy();
        echo json_encode(['success' => true]);
        exit;
    }

    /////////////////////////// USER SETTINGS /////////////////////////////////////
    public function update_user_details()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'user_id' => trim($_POST['user_id']),
            'fullname' => trim($_POST['fullname']),
            'goal' => trim($_POST['goal']),
            'height' => trim($_POST['height']),
            'weight' => trim($_POST['weight']),
            'age' => trim($_POST['age'])
        ];

        if ($this->userModel->update_user_details($data)) {
            $updatedUser = $this->userModel->getUserById($data['user_id']);
            $this->createUserSession($updatedUser);
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'No user found']);
            exit;
        }
    }


    public function update_user_credentials()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'user_id' => $_SESSION['id'],
            'email' => trim($_POST['email']),
            'old_password' => trim($_POST['old_password']),
            'new_password' => trim($_POST['new_password']),
        ];

        if ($this->userModel->update_user_credentials($data)) {
            $updatedUser = $this->userModel->getUserById($data['user_id']);
            $this->createUserSession($updatedUser);
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Old password incorrect']);
            exit;
        }
    }



    public function update_user_first_login()
    {
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'id' => trim($_POST['id']),
            'fullname' => trim($_SESSION['fullname']),
            'goal' => trim($_POST['goal']),
            'height' => trim($_POST['height']),
            'weight' => trim($_POST['weight']),
            'age' => trim($_POST['age']),
            'gender' => trim($_POST['gender']),
            'dailyCalories' => trim($_POST['dailyCalories'])
        ];

        if ($this->userModel->update_user_first_login($data)) {
            $updatedUser = $this->userModel->getUserById($data['id']);
            $this->createUserSession($updatedUser);
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Something went wrong']);
            exit;
        }
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
        case 'update-user-details':
            $init->update_user_details();
            break;
        case 'update-user-credentials':
            $init->update_user_credentials();
            break;
        case 'first-login':
            $init->update_user_first_login();
            break;
        default:
            header("Location: login.php"); // Redirect to login.php
            exit;
    }
} 
/*
else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            header("Location: login.php"); // Redirect to login.php
            exit;
    }
}
*/

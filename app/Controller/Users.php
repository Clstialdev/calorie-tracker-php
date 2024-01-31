<?php

namespace Manger\Controller;

use Manger\Model\User; // fonctionnel

use Manger\Helpers\Session_Helper; 
use Manger\Views\LoginView;// fonctionnel

class Users
{

    private $userModel;
    private $userView;

    public function __construct()
    {

        $this->userModel = new User();
        
    }

   

    public function showAllUsers(){
       
       
        header('Content-Type: application/json');
        $data = $this->userModel->getAllUsers();

   if($data){
    $output = '';
    
    
    //print_r($data);

    $output .= '<table class="table table-striped table-sm table-bordered">
    <thead>
      <tr class="text-center">
        <th>ID</th>
        <th>Full name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>';
    foreach($data as $row){
      $output .='<tr class="text-center text-secondary">
        <td > '.$row['id'].'</td>
        <td > '.$row['fullname'].'</td>
        <td > '.$row['email'].'</td>
        <td>
              <a href="#" title="View Details" class="text-success infoBtn" id="'.$row['id'].'"><i class="fas fa-info-circle fa-lg"></i>&nbsp;&nbsp;</a>
              <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'"><i class="fas fa-edit fa-lg"></i>&nbsp;&nbsp;</a>
              <a href="#" title="Delete" class="text-danger delBtn" id="'.$row['id'].'"><i class="fas fa-trash-alt fa-lg"></i></a>
            </td>
          </tr>
      ';
    }
    $output .='</tbody></table>';
    echo json_encode(['message' =>  $output ]);
    exit;
   }else{
    echo json_encode(['message' => '<h3 class="text-center text-secondary mt-5"> :( No any user present in teh database !!  </h3>']);
    exit;
   }
    }
    public function register()
    {
        //Process form
        // Sanitize email
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $fullname = trim($_POST['fullname'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Initialize data
        $data =
         [
            'fullname' => $fullname,
            'password' => $password,
            'email' => $email
        ];


        //User with the same email already exists
        if ($this->userModel->findUserByEmail($data['email'])) {
            header('Content-Type: application/json');
          //  http_response_code(400); 
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            return;
        }

        //Passed validation checks
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
         // Sanitize email
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

    // Passwords should not be altered too much but trim whitespace
    $password = trim($_POST['password'] ?? '');

    // Initialize data
    $data = [
        'email' => $email,
        'password' => $password
    ];

        if ($this->userModel->findUserByEmail($data['email'])) {
            //User found
            $loggerInUser = $this->userModel->login($data['email'], $data['password']);
            if ($loggerInUser) {
                $this->createUserSession($loggerInUser);
                $this->userView->logView();
                //echo json_encode(['success' => true]);
               // exit;
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
        $_SESSION['height'] = $user->height;
        $_SESSION['age'] = $user->age;
        $_SESSION['weight'] = $user->weight;
        $_SESSION['goal'] = $user->goal;
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
        // Sanitize each POST field individually
        $id = filter_var(trim($_POST['id'] ?? ''), FILTER_SANITIZE_NUMBER_INT);
        $fullname = filter_var(trim($_SESSION['fullname'] ?? ''), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $goal = filter_var(trim($_POST['goal'] ?? ''), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $height = filter_var(trim($_POST['height'] ?? ''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $weight = filter_var(trim($_POST['weight'] ?? ''), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $age = filter_var(trim($_POST['age'] ?? ''), FILTER_SANITIZE_NUMBER_INT);
        $gender = filter_var(trim($_POST['gender'] ?? ''), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dailyCalories = filter_var(trim($_POST['dailyCalories'] ?? ''), FILTER_SANITIZE_NUMBER_INT);

        // Initialize data
        $data = [
            'id' => $id,
            'fullname' => $fullname,
            'goal' => $goal,
            'height' => $height,
            'weight' => $weight,
            'age' => $age,
            'gender' => $gender,
            'dailyCalories' => $dailyCalories
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


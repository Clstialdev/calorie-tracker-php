<?php

require_once '../../config/Database.php';

class User {

    private $db ;

    public function __construct(){

        $this->db = new Database;
        
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = :user_id";

        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        
        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }

    public function register($data){
        $this->db->query('INSERT INTO users (fullname, password,email,active,creation_date)
        VALUES ( :fullname, :password , :email , 1 , NOW() )' ) ;

        // Bind the data from the $data array to the named placeholders
            $this->db->bind(':fullname', $data['fullname']);
            $this->db->bind(':password', $data['password']); 
            $this->db->bind(':email', $data['email']);

            try {
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                // Handle exception
                echo "Database error: " . $e->getMessage();
                return false;
            }
    }

    //Login user
    public function login($email,$password){
        $row = $this->findUserByEmail($email);

        if($row==false)return false;

        $hashedPassword = $row->password;
        if(password_verify($password,$hashedPassword)){
            return $row;

        }else{
            return false;
        }
    }


    public function update_user_details($data){
            $this->db->query('UPDATE users SET fullname = :fullname, goal = :goal, height = :height, weight = :weight, age = :age WHERE id = :user_id');
            $this->db->bind(':fullname', $data['fullname']);
            $this->db->bind(':goal', $data['goal']);
            $this->db->bind(':height', $data['height']);
            $this->db->bind(':weight', $data['weight']);
            $this->db->bind(':age', $data['age']);
            $this->db->bind(':user_id', $data['user_id']);
            
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

    }
    
    
    public function update_user_credentials($data){
        $this->db->query('SELECT password FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->execute();
        $currentPassword = $this->db->single()->password;
    
        // Verify old password
        if (!password_verify($data['old_password'], $currentPassword)) {
            return false; // Old password does not match
        }
    
        // Hash new password
        $hashedPassword = password_hash($data['new_password'], PASSWORD_DEFAULT);
    
        // Update credentials in the database
        $this->db->query('UPDATE users SET email = :email, password = :password WHERE id = :user_id');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':user_id', $data['user_id']);
    
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail){
        $this->db->query('UPDATE users SET password=:pwd WHERE email=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email',$tokenEmail);

        //Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>
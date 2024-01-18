<?php

namespace Manger\Model;

use Config\Database;

require_once 'Config/Database.php';

class User
{

    private $db;

    public function __construct()
    {

        $this->db = new Database();
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (fullname, password,email,active,creation_date)
        VALUES ( :fullname, :password , :email , 1 , NOW() )');

        // Bind the data from the $data array to the named placeholders
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email']);

        try {
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            // Handle exception
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }

    //Login user
    public function login($email, $password)
    {
        $row = $this->findUserByEmail($email);

        if ($row == false) return false;

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Reset Password
    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE users SET password=:pwd WHERE email=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

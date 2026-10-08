<?php

require_once 'userModel.php';

class UserController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function showLogin()
    {
        require 'pages/login.php';
    }

    public function showSignup()
    {
        require 'pages/signup.php';
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $name = trim($_POST['user_name'] ?? '');
            $password = $_POST['user_pwd'] ?? '';
            $email = trim($_POST['user_email'] ?? '');
    
            $name = preg_replace('/[^\p{L}\p{N}\s\'-]/u', '', $name);
            $name = preg_replace('/\s+/', ' ', $name);
    
            if (strlen($name) < 4 || strlen($name) > 12) {
                die("Username may be between 4 and 12 characters long. (Special characters do not count as they are deleted)");
            }
    
            $model = new UserModel($this->pdo);
    
            if ($model->usernameExists($name)) {
                die("That username is already taken.");
            }
    
            if ($model->emailExists($email)) {
                die("That email is already registered.");
            }
    
            $model->createUser($name, $password, $email);
    
            header("Location: index.php?page=login");
            exit();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['user_name'];
            $password = $_POST['user_pwd'];

            $model = new UserModel($this->pdo);

            $user = $model->getUserByName($name);

            if ($user && password_verify($password, $user['user_pwd'])) {

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['username'];

                header("Location: index.php?page=dashboard");
                exit();

            } else {
                echo "Invalid username or password.";
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: index.php?page=dashboard");
        exit();
    }

    public function helpPage()
    {
        require 'pages/help.php';
    }
}
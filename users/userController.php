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

            $name = $_POST['user_name'];
            $password = $_POST['user_pwd'];
            $email = $_POST['user_email'];

            $model = new UserModel($this->pdo);

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
}
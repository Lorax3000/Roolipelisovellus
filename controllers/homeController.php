<?php

class homeController {
    public function showHome(){
        include __DIR__ . '/pages/home.php';
    }

    public function showLogin(){
        include __DIR__ . '/pages/login.php';

        require_once __DIR__ . '../models/users.php';
    
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $existing = getUser($pdo, $username);
        if ($existing) {
            die("USER ALREADY EXISTS");
        }
    
        createUser($pdo, $username, $password);
    
        header("Location: /index.php?page=login");
        exit();
    }

    public function loginUser($pdo) {

        require_once __DIR__ . '/../models/users.php';

        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $user = getUserByName($pdo, $username);
    
        if ($user && password_verify($password, $user['pwd'])) {
    
            $_SESSION['user'] = $user;
    
            header("Location: index.php?page=home");
            exit();
    
        } else {
            die("INVALID LOGIN");
        }
    }
    public function logout(){
        include __DIR__ . '/../CONTROLLERS/userController.php';
        logout();
    }

}
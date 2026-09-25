<?php

class UserModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($name, $password, $email)
    {
        $sql = "INSERT INTO users (
                    username,
                    user_pwd,
                    user_email
                ) VALUES (
                    :name,
                    :password,
                    :email
                )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':email' => $email
        ]);
    }

    public function getUserByName($name)
    {
        $sql = "SELECT * FROM users
                WHERE username = :name";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
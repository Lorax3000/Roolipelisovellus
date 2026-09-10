<?php

function registerUser($pdo) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$username || !$password) {
        die("ALL FIELDS REQUIRED");
    }

    $existing = getUser($pdo, $username);
    if ($existing) {
        die("USERNAME ALREADY EXISTS");
    }

    try {

        $stmt = $pdo->prepare("
            INSERT INTO users (user_name, pwd)
            VALUES (?, ?)
        ");

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([
            $username,
            $hashed
        ]);

    } catch (PDOException $e) {

        if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
            die("USERNAME ALREADY EXISTS");
        }

        die("DB error: " . $e->getMessage());
    }

    $user_id = $pdo->lastInsertId();
    $_SESSION['user'] = [
        'user_id' => $user_id,
        'user_name' => $username
    ];

    header("Location: index.php");
    exit();
}

function loginUser($pdo) {

    session_start();

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$username || !$password) {
        die("USERNAME AND PASSWORD REQUIRED");
    }

    $user = getUserByName($pdo, $username);

    if ($user && password_verify($password, $user['user_pwd'])) {

        $_SESSION['id'] = [
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name']
        ];

        header("Location: index.php?page=home");
        exit();

    } else {
        die("INVALID LOGIN");
    }
}

function logout() {
    session_destroy();
    header("Location: index.php");
}

?>
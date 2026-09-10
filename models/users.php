<?php 

function createUser($pdo, $user_name, $pwd) {
    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO users
        (user_name, pwd)
        VALUES (?, ?)
    ");

    $stmt->execute([
        $user_name,
        $hash
    ]);
}


function loginUser($username, $password) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}
 
function getUser($pdo, $user_name) {
    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE user_name = ?
    ");

    $stmt->execute([
        $user_name
    ]);

    return $stmt->fetch();
}

function getUserByName($pdo, $user_name) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name = ?");
    $stmt->execute([$user_name]);
    return $stmt->fetch();
}

?>
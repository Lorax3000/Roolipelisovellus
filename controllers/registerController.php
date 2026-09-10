<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // VALIDATIONS

  //  if (strlen($username) < 3) {
  //      $errors[] = "Käyttäjänimi liian lyhyt";
  //  }

  //  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  //      $errors[] = "Virheellinen sähköposti";
  //  }

  //  if (strlen($password) < 6) {
  //      $errors[] = "Salasanan tulee olla vähintään 6 merkkiä";
  //  }

    // CHECK IF USER EXISTS
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$email, $username]);

    if ($stmt->fetch()) {
        $errors[] = "Käyttäjä tai sähköposti on jo olemassa";
    }

    // SAVE USER
    if (empty($errors)) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            INSERT INTO users (username, email, password)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$username, $email, $hash]);

        header("Location: index.php?page=login");
        exit();
    }
}

require_once __DIR__ . '/../register.php';
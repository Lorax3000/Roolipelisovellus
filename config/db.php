<?php
function connectDB(){
    static $connection;
    if(!isset($connection)) {
        $connection = connect();
    }      
    return $connection;
}

function connect() {
    $host = getenv('DB_HOST', true) ?: "elilep25.treok.io";
    $port = getenv('DB_PORT', true) ?: 3306; 
    $dbname = getenv('DB_NAME', true) ?: "elilep25_roolipelisovellus"; 
    $user = getenv('DB_USERNAME', true) ?: "elilep25_roolipelisovellus"; 
    $password = getenv('DB_PASSWORD', true) ?: "roolipelisovellus12345678"; 

    $connectionString = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8";

    try {       
            $pdo = new PDO($connectionString, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    } catch (PDOException $e){
            echo "Virhe tietokantayhteydessä: " . $e->getMessage();
            die();
    }
}
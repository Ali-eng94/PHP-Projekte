<?php
session_start();
require './connection.php';

if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)){
    die("Access Denied");
}

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong Method");
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if(empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
    die("Missing Parameter");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Wrong email format");
}

$sql = "SELECT password FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
    if(password_verify($password, $user['password'])){

        $sql ="UPDATE users SET email = :email, name = :name WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        header("Location: ../home.php");
        exit;

    } else {
        die("Wrong Password");
    }
} else {
    die("Wrong id");
}
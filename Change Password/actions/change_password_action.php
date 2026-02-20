<?php
session_start();
require './connection.php';

if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)){
    die("Access Denied");
}

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong Method");
}


$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];

if(empty(trim($oldpass)) || empty(trim($newpass))) {
    die("Missing Parameter");
}

$sql = "SELECT password FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = $user['password'];

if(!password_verify($oldpass, $password)){
        die("Wrong oassword");
    }   

if(strlen($newpass) < 8 ){
        die("Password should be a min of 8 characters");
}


$hashed_password = password_hash($newpass, PASSWORD_BCRYPT);

$sql = "UPDATE users SET password = :pass WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':pass', $hashed_password);
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
exit();
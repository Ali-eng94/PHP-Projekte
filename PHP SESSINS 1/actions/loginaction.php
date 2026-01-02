<?php
session_start();

// 0. If the user is logged in, log them out immediately
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
    header("Location: index.php");
    exit();
}

// 1. POST ????
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['loginError'] = "Invalid request method";
    header('Location: ../login.php');
    exit();
}

// 2.Obtain the data provided that there are no gaps at the beginning and end.
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// 3.Check for empty values
if(empty($username) || empty($password)){
    echo "Wrong Parameters";
    exit();
}

// 4.Login verification
if($username == "admin" && $password == "pass123"){
    $_SESSION['loggedIn'] = true;
    $_SESSION['name'] = "ALi";
    $_SESSION['role'] = "admin"; // create user
    header('Location: ../home.php');
    exit();
} else if($username == "user" && $password == "pass12345"){
    $_SESSION['loggedIn'] = true;
    $_SESSION['name'] = "Christian";
    $_SESSION['role'] = "user"; // Create user
    header('Location: ../home.php');
    exit();
} else {
    $_SESSION['loginError'] = "Wrong username or password"; //to print the error
    header('Location: ../login.php');
    exit();
}
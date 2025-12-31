<?php
session_start();

// 1.Obtain the data provided that there are no gaps at the beginning and end.
$username = trim($_POST['uname']);
$password = trim($_POST['pass']);

// 2. Check for empty values
if(empty($username) || empty($password)){
    $_SESSION['loginError'] = "Please enter both username and password";
    header('Location: ../login.php');
    exit();
}

// 3. Login verification
if($username == "admin" && $password == "pass123"){
    $_SESSION['loggedIn'] = true;
    $_SESSION['name'] = "ALi"; 
    header('Location: ../home.php');
    exit();
} else if($username == "user" && $password == "pass12345"){
    $_SESSION['loggedIn'] = true;
    $_SESSION['name'] = "Christian";
    header('Location: ../home.php');
    exit();
} else {
    $_SESSION['loginError'] = "Wrong username or password"; //to print the error
    header('Location: ../login.php'); 
    exit();
}
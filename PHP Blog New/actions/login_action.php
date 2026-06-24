<?php

require '../connection.php';
session_start();
require '../components/is_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- GET DATA -------- */
$email = trim($_POST["email"] ?? '');
$password = trim($_POST["password"] ?? '');

/* -------- CHECK EMPTY FIELDS -------- */
if(empty($email) || empty($password)){

    header("Location: ../login.php?err=1");
    exit();
}

/* -------- SAVE EMAIL -------- */
$_SESSION['email'] = htmlspecialchars($email);

try {

    /* -------- FIND USER -------- */
    $sql = "SELECT id, name, password
            FROM users
            WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":email",
        $email,
        PDO::PARAM_STR
    );

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    /* -------- USER NOT FOUND -------- */
    if(!$user){

        header("Location: ../login.php?err=2");
        exit();
    }

    /* -------- CHECK PASSWORD -------- */
    if(!password_verify(
        $password,
        $user['password']
    )){
        header("Location: ../login.php?err=2");
        exit();
    }

    /* -------- LOGIN SUCCESS -------- */
    $_SESSION["loggedIn"] = true;
    $_SESSION["user_id"] = $user['id'];
    $_SESSION["username"] = $user['name'];

    /* -------- CLEAR LOGIN EMAIL -------- */
    unset($_SESSION['email']);

    header("Location: ../index.php");
    exit();

}
catch(PDOException $e){

    header("Location: ../login.php?err=3");
    exit();
}
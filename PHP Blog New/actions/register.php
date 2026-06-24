<?php

require '../connection.php';
session_start();

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- GET DATA -------- */
$name = htmlspecialchars(trim($_POST["name"]));
$email = htmlspecialchars(trim($_POST["email"]));
$password = htmlspecialchars(trim($_POST["password"]));
$confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));

/* -------- CHECK EMPTY FIELDS -------- */
if(
    empty($name) ||
    empty($email) ||
    empty($password) ||
    empty($confirm_password)
){
    header("Location: ../signup.php?err=1");
    exit();
}

/* -------- SAVE SESSION -------- */
$_SESSION["register_name"] = $name;
$_SESSION["register_email"] = $email;

/* -------- VALIDATE EMAIL -------- */
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?err=2");
    exit();
}

/* -------- CHECK PASSWORD MATCH -------- */
if($password !== $confirm_password){
    header("Location: ../signup.php?err=3");
    exit();
}

/* -------- PASSWORD LENGTH -------- */
if(strlen($password) < 8){
    header("Location: ../signup.php?err=4");
    exit();
}

/* -------- HASH PASSWORD -------- */
$hashed_password = password_hash(
    $password,
    PASSWORD_BCRYPT
);

/* -------- INSERT USER -------- */
try {

    $sql = "INSERT INTO users (name, email, password)
            VALUES (:n, :e, :p)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":n", $name, PDO::PARAM_STR);
    $stmt->bindParam(":e", $email, PDO::PARAM_STR);
    $stmt->bindParam(":p", $hashed_password, PDO::PARAM_STR);

    if($stmt->execute()){

        $_SESSION["loggedIn"] = true;
        $_SESSION["user_id"] = $pdo->lastInsertId();
        $_SESSION["username"] = $name;

        header("Location: ../index.php");
        exit();
    }

}
catch(PDOException $e){

    if($e->errorInfo[1] == 1062){
        header("Location: ../signup.php?err=5");
        exit();
    }

    die($e->getMessage());
}
<?php

session_start();

require "../connection.php";
require "../components/not_logged_in.php";

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- GET DATA -------- */
$name = htmlspecialchars(trim($_POST["name"]));
$email = htmlspecialchars(trim($_POST["email"]));
$password = htmlspecialchars(trim($_POST["password"]));

/* -------- CHECK EMPTY FIELDS -------- */
if(
    empty($name) ||
    empty($email)
){
    header("Location: ../change_info.php?err=1");
    exit();
}

/* -------- VALIDATE EMAIL -------- */
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../change_info.php?err=2");
    exit();
}

/* -------- PASSWORD LENGTH -------- */
if(!empty($password) && strlen($password) < 8){
    header("Location: ../change_info.php?err=4");
    exit();
}

try {

    /* -------- UPDATE USER -------- */
    if(!empty($password)){

        $hashed_password = password_hash(
            $password,
            PASSWORD_BCRYPT
        );

        $sql = "
        UPDATE users
        SET
        name = :name,
        email = :email,
        password = :password
        WHERE id = :id
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(
            ":password",
            $hashed_password
        );

    } else {

        $sql = "
        UPDATE users
        SET
        name = :name,
        email = :email
        WHERE id = :id
        ";

        $stmt = $pdo->prepare($sql);
    }

    $stmt->bindParam(
        ":name",
        $name
    );

    $stmt->bindParam(
        ":email",
        $email
    );

    $stmt->bindParam(
        ":id",
        $_SESSION['user_id']
    );

    $stmt->execute();

    $_SESSION["username"] = $name;

    header("Location: ../index.php");
    exit();

}
catch(PDOException $e){

    if($e->errorInfo[1] == 1062){
        header("Location: ../change_info.php?err=5");
        exit();
    }

    die($e->getMessage());
}
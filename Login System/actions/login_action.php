<?php

require "./connection.php";

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];
    if(empty(trim($email)) || empty(trim($password))) {
        echo "Missing Paramater";
    }
    try {
        $sql = "SELECT id, name, password FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if($password === $user['password']){
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header("Location: ../home.php");
            }else {
                header("Location: ../login.php?err=1");
            }
        } else {
            header("Location: ../login.php?err=2");
        }
    }catch(PDOException $exc){
        echo "Error adding user:" .$exc->getMessage();
    }
}

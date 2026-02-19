<?php
require "../connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
        echo "Missing Paramater";
    }
    try {

        $hashed_password = password_hash($password, PASSWORD_BCRYPT); # the password is encrypted.
        
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password); 
        $stmt->execute();
        echo "New user added";
    }catch(PDOException $exc){
        echo "Error adding user:" .$exc->getMessage();
    }
}

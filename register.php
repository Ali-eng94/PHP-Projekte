<?php
require '../connection.php';
session_start();

if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("wrong method");

}

// $name="";

$name=htmlspecialchars(trim($_POST["name"]));
$email=htmlspecialchars(trim($_POST["email"]));
$password=htmlspecialchars(trim($_POST["password"]));
$confirm_password=htmlspecialchars(trim($_POST["confirm_password"]));

 // to save the input values 
$_SESSION["register_name"]=$name;
$_SESSION["register_email"]=$email;



if((!isset($email)) || empty($email) ||
(!isset($name)) || empty($name)||
(!isset($password)) || empty($password)||
(!isset($confirm_password)) || empty($confirm_password)
){
header("Location:../signup.php?err=1");
exit();

}


if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    header("Location:../signup.php?err=2");
    exit();

}
if($password != $confirm_password){
    header("Location:../signup.php?err=3");
    exit();
}



if(strlen($password)<8){
    header("Location:../signup.php?err=4");
    exit();
}

$hashed_password=password_hash($password,PASSWORD_DEFAULT);

try{
    $sql="INSERT INTO users (name, email,password) VALUES (:n,:e,:p)";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":n",$name,PDO::PARAM_STR);
    $stmt->bindParam(":e",$email,PDO::PARAM_STR);
    $stmt->bindParam(":p",$hashed_password,PDO::PARAM_STR);
    if($stmt->execute()){
      $_SESSION["loggedIn"]=true;
      $_SESSION["userId"]=$pdo->lastInsertId();
      $_SESSION["username"]=$name;
      header("Location:../index.php");
      exit();


    }

}
catch(PDOException $e){
   if($e->getCode()==23000){
    header("Location:../signup.php?err=5");
   }

}


<?php
session_start();

require "../connection.php" ;
require "../components/is_logged_in.php";
if($_SERVER["REQUEST_METHOD"]=!"POST"){
    die("wrong method");

}
$email=trim($_POST["email"]);
$password=(trim($_POST["password"]));

if((!isset($email)) || empty($email) ||
(!isset($password)) || empty($password)){

header("Location:../login.php?err=1");
exit();
}


try{
    $sql="SELECT id,name,password,is_admin FROM users WHERE email=:email";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        header("Location:../login.php?err=2");
        exit();
    }
    if(password_verify($password,$user["password"])){
        $_SESSION["loggedIn"]=true;
        $_SESSION["userId"]=$user["id"];
        $_SESSION["username"]=$user["name"];
        $_SESSION["role"]=$user["is_admin"];
        header("Location:../index.php");
        exit();
    }
    
    else{
        
        header("Location:../login.php?err=3");
        exit();
    }

}
catch(PDOException $e){
    header("Location:../login.php?err=0");
    exit();
}
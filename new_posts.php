<?php
require "../connection.php";
session_start();
if($_SERVER["REQUEST_METHOD"] !="POST"){
    die("wrong method");

}

$subject=htmlspecialchars(trim($_POST["subject"]));
$content=htmlspecialchars(trim($_POST["content"]));
$user_id=$_SESSION["userId"];
 // to save the input values 
$_SESSION["old_subject"]=$subject;
$_SESSION["old_content"]=$content;

if((!isset($subject)) || empty($subject) ||
(!isset($content)) || empty($content)

){
header("Location:../newpost.php?err=1");
exit();

}
try{

 $sql="INSERT INTO posts (subject,content,user_id) VALUES (:s,:c,:user_id) ";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":s",$subject,PDO::PARAM_STR);
    $stmt->bindParam(":c",$content,PDO::PARAM_STR);
    $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
    if($stmt->execute()){
      header("Location:../newpost.php?succ=1");
      exit();
    }
    else{
        header("Location:../newpost.php?err=4");
        exit();
    }

}
catch(PDOException $e){
    //
    header("Location:../newpost.php?error=2");
    exit();
}
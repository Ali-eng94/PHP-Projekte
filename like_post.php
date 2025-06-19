<?php

session_start();

require "../connection.php";

header("Content-Type:application/json");

// we will check if the user is logged in or not  


$data=json_decode(file_get_contents("php://input"),true);

$post_id=$data["post_id"];
$user_id=$_SESSION["userId"];


//step  1: check if the user has alkreaddy liked this post 
try{
    $stmt=$pdo->prepare("SELECT * FROM post_likes WHERE user_id=:user_id AND post_id=:post_id");
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":post_id",$post_id);
    $stmt->execute();
    $exisiting_like=$stmt->fetch(PDO::FETCH_ASSOC);



    if($exisiting_like){
        $stmt=$pdo->prepare("DELETE FROM post_likes WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":post_id",$post_id);
        $stmt->execute();
       // $liked=false;
    }
    else{
        $stmt=$pdo->prepare("INSERT INTO post_likes (user_id,post_id) VALUES (:user_id,:post_id)");
        $stmt->bindParam(":user_id",$user_id);
        $stmt->bindParam(":post_id",$post_id);
        $stmt->execute(); 
       // $liked=
       true;
    }

    //step 4 :count the likes
    $stmt=$pdo->prepare("SELECT COUNT(*) as like_count FROM post_likes WHERE post_id=:post_id");
    $stmt->bindParam(":post_id",$post_id);
    $stmt->execute(); 
    $like_count=$stmt->fetch(PDO::FETCH_ASSOC)["like_count"];


    echo json_encode(["success"=>true,"likes"=>$like_count]);

    


}
catch(PDOException $e){
    echo  $e;
}

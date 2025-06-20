<?php
session_start();
require "connection.php";

$user_id=$_SESSION["userId"];


if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST["update_profile"])){
        $name=htmlspecialchars(trim($_POST["name"]));
        $email=htmlspecialchars(trim($_POST["email"]));
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           
            exit();
        
        }

        $sql="UPDATE users SET name=:n ,email=:e WHERE id=:user_id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":n",$name,PDO::PARAM_STR);
        $stmt->bindParam(":e",$email,PDO::PARAM_STR);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();

    }
    //change paswword form submit

    if(isset($_POST["change_password"])){

        $current_password=$_POST["current_password"]; // pass123
        $new_password=$_POST["new_password"];
        $confirm_password=$_POST["confirm_password"];

        if(strlen($new_password)<8){
            exit();
        }

        $sql="SELECT password FROM users WHERE id=:user_id";
        $stmt=$pdo->prepare($sql);
     $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
     $stmt->execute();
     $user=$stmt->fetch(PDO::FETCH_ASSOC);  //user[Password]=pass123

     if(password_verify($current_password,$user["password"])){
        if($new_password===$confirm_password){
            $hashed_password=password_hash($new_password,PASSWORD_DEFAULT);
            
        $sql="UPDATE users SET password=:p WHERE id=:user_id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":p",$hashed_password,PDO::PARAM_STR);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION["success_password"]="password changed succefully";
        }
        else{
            $_SESSION["error"]="passwords doesnt match";
        }
     }
     else{
        $_SESSION["error"]="current password is incorrect";
     } 
    }
    if(isset($_POST["upload_image"])){
        $target_dir="uploads/";
        if(!is_dir($target_dir)){
            mkdir($target_dir,0777,true);
        }

        $profile=$_FILES["profile_image"];
        $file_name=basename($profile["name"]);
        $target_file=$target_dir.$file_name;
        $image_file_type=pathinfo($target_file,PATHINFO_EXTENSION);

        if($profile["size"]>5000000){
            $_SESSION["error"]="image size is too large";
            exit();
        }

        $array_types=["jpg","jpeg","png"];
        if(!in_array($image_file_type,$array_types)){
            $_SESSION["error"]="image type is not allowed";
            exit();
        }
       if(move_uploaded_file($profile["tmp_name"],$target_file)){

        $sql="UPDATE users SET profile=:p WHERE id=:user_id";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":p",$target_file,PDO::PARAM_STR);
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();

       }



        // $image_file_type(pathinfo())
    }
    
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
// require "components/navbar.php";

?>
    <div class="container mt-5" style="margin-top:50px">
        <h1>Edit Profile</h1>
        <?php
        if(isset($_SESSION["error"])){
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }



?>




        <!-- Profile Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
        </form>

        <hr>

        <!-- Change Password -->
        <h2>Change Password</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <button  type="submit" class="btn btn-primary" name="change_password">Change Password</button>
        </form>

        <hr>

        <!-- Update Profile Image -->
        <h2>Update Profile Image</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_image">Choose Image</label>
                <input type="file" class="form-control" name="profile_image" required>
            </div>
            <button type="submit" class="btn btn-primary" name="upload_image">Upload Image</button>
        </form>
    </div>
    <?php
require "components/footer.php";

?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
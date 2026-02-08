<?php
    require 'User.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // class user {   #it should be defined everywhere now print : ALi Haji
        //     //Prperties
        //     public $name;                #Alternatively , a new file can be created with the username or class and used require in the top page bervor session_start()
        //     public $email;
        //     public $password;
        // }
        $user = unserialize($_SESSION['user']); # for the user to empty here as string 
            // echo "<h1>Hello " . $user->name . "</h1>";
            $user->displayInfo();
    ?>
</body>
</html>


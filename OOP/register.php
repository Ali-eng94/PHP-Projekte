<?php
    require 'User.php';
    session_start();

    // class user {
    //     //Prperties
    //     public $name;
    //     public $email;
    //     public $password;
    // }
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $user = new User($_POST['name'], $_POST['email'],$_POST['password']); 

        // $user->name = $_POST['name'];
        // $user->email = $_POST['email'];
        // $user->password = $_POST['password'];

        $_SESSION['user'] = serialize($user);                   # to send the object or user in full
        header("Location: test.php ");                          # serialize() ist if i have object to navigate between pages or send as string
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h1>Register User</h1>
    <form action="" method="POST">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>
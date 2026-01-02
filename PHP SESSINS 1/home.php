<?php
session_start(); //It must be present in order for the user to log in or to identify the user.

if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){  //If the user is not logged in
    die("Access Denied");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['name']; ?>! You are now logged in</h1> 
</body>
</html>
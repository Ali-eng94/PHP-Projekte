<?php
session_start();

if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false){
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
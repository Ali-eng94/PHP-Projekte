<?php
session_start();
require 'actions/connection.php';
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)){
    die("Access Denied");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Change Password</h1>
    <form action="actions/change_password_action.php" method="POST">
        <input type="password" placeholder="Old Password" name="oldpass">
        <input type="password" placeholder="New Password" name="newpass">
        <input type="submit" value="Change">
    </form>
</body>
</html>
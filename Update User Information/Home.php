<?php
session_start();
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
    <h1>You are logged in as <?php echo $_SESSION['name']; ?></h1>
    <h1>Secret Page</h1>
    <a href="edit.php">Change Profile Info</a>
    <a href="logout.php">Logout</a>
</body>
</html>
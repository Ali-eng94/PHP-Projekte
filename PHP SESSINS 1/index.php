<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
  
    
    <h1>Welcome to My Page</h1>
    
    <?php

    if(isset($_SESSION['name']) && !empty($_SESSION['name'])) {
        echo '<h2>' . htmlspecialchars($_SESSION['name']) . '</h2>';
    }
    ?>
    
    <?php
    
    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
        echo '<a href="login.php">Login</a>';
    } else {
        echo '<a href="logout.php">Logout</a>';
    }
    
    ?>
    
</body>
</html>
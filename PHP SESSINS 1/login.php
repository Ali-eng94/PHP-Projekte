<?php
session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
    header("Location: index.php");    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="actions/loginaction.php">
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" vlaue="Login">
    </form>
    <?php
    if(isset($_SESSION['loginError'])){
        echo '<p style = "color:red;">'. $_SESSION['loginError'] . '</p>'; //to print the error
        $_SESSION['loginError'] = "";
    }
    ?>
</body>
</html>
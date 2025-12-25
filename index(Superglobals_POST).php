<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['username'] == "admin" && $_POST['password'] == "12345"){
        echo "Correct Login";
    } else {
        echo "Worng Login";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get vs Post Requests</title>
</head>
<body>
    <h1>SuperGlobals</h1>
    <br>
    <h1>Login</h1>
    <form method="Post" action="index(Superglobals_POST)"> 
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" vlaue="Login">
    </form>
</body>
</html>



    
    
<h1>Search</h1>  
<form method="GET" action="Search(SuperGlobals_GET).php">
    <input type="search" placeholder="Search" name="query" required>
    <input type="submit" vlaue="Search">
</form>
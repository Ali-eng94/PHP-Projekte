<?php
session_start();
require 'actions/connection.php';
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)){
    die("Access Denied");
}
$sql = "SELECT name, email FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $user['name'];
$email = $user['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="actions/edit_action.php" method="POST">
        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
        <input type="submit">
    </form>
</body>
</html>
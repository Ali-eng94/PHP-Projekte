<?php

require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];

    if (empty(trim($name))) {
        echo "Missing parameter";
    } else {
        $name = "%$name%";
        $sql = "SELECT * FROM users WHERE name LIKE :name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<h1>Search</h1>

<form action="Binding Parameters.php" method="POST">
    <input type="text" placeholder="Enter name to search" name="name" required>
    <input type="submit" value="Search">
</form>

<?php
if (!empty($users)) {
    foreach ($users as $user) {
        echo "User ID: " . htmlspecialchars($user['id']) . "<br>";
        echo "Name: " . htmlspecialchars($user['name']) . "<br>";
        echo "Email: " . htmlspecialchars($user['email']) . "<br><hr>";
    }
}
?>
</body>
</html>
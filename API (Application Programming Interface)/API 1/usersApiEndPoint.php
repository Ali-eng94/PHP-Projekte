<?php

header("Content-Type: application/json");

require "connection.php";

$sql = "SELECT * FROM course";

$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($users);
// echo "</pre>";

echo json_encode([
    "message" => "add item in a table",
    'data' => $users
    ]);
?>
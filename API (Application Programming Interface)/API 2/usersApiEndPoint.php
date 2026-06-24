<?php

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");

require "connection.php";

$sql = "SELECT * FROM course";

$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "message" => "Add items in a table",
    "data" => $users
]);

?>
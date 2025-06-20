<?php
$host = 'localhost';
$dbname = 'Ali Haji';
$user = 'root';
$pass = '';

try {
    // $conn=new mysqli(host,dbanaem,user,pass);
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<?php
session_start();
require './connection.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    die("Access Denied");
}

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    die("Wrong Method");
}

/* -------- CHECK FILE -------- */
if (!isset($_FILES['profile'])) {
    die("No file uploaded");
}

/* -------- GET FILE EXTENSION -------- */
$fileType = strtolower(
    pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION)
);

/* -------- CREATE UNIQUE IMAGE NAME -------- */
$imageName = "IMG_" . bin2hex(random_bytes(10)) . "." . $fileType;

/* -------- CHECK FILE EXTENSION -------- */
if ($fileType != "png" && $fileType != "jpeg" && $fileType != "jpg"){
    die("Wrong format");
}

/* -------- CHECK IF REAL IMAGE -------- */
if (!getimagesize($_FILES['profile']['tmp_name'])){
    die("Not a real picture");
}

/* -------- CHECK FILE SIZE -------- */
if($_FILES['profile']['size'] > 5000000){
    die("File too large");
}

/* -------- CHECK IF FILE EXISTS -------- */
while(file_exists("../uploads/" . $imageName)){
    $imageName = "IMG_" . bin2hex(random_bytes(10)) . "." . $fileType;
}

/* -------- MOVE FILE -------- */
if(
    move_uploaded_file(
        $_FILES['profile']['tmp_name'],
        "../uploads/" . $imageName
    )
){

    /* -------- UPDATE DATABASE -------- */
    $sql ="UPDATE users 
           SET profile = :profile 
           WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->bindParam(':profile', $imageName);

    $stmt->execute();

    header("Location: ../home.php");
    exit;

}
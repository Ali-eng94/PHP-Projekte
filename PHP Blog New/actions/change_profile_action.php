<?php

require '../connection.php';

session_start();

require '../components/not_logged_in.php';

/* -------- CHECK METHOD -------- */
if($_SERVER["REQUEST_METHOD"] !== "POST"){
    die("Wrong Method");
}

/* -------- CHECK FILE -------- */
if(!isset($_FILES['profile'])){
    die("No file selected");
}

/* -------- GET FILE EXTENSION -------- */
$fileType = strtolower(
    pathinfo(
        $_FILES['profile']['name'],
        PATHINFO_EXTENSION
    )
);

/* -------- ALLOWED TYPES -------- */
$allowedTypes = [
    "jpg",
    "jpeg",
    "png",
    "gif"
];

if(!in_array($fileType, $allowedTypes)){
    die("Wrong file type");
}

/* -------- CREATE FILE NAME -------- */
$image_name =
"IMG_" .
$_SESSION['user_id'] .
"_" .
bin2hex(random_bytes(10))
.
"." .
$fileType;

/* -------- CREATE TARGET -------- */
$target =
"../uploads/" .
$image_name;

/* -------- CHECK FILE SIZE -------- */
if($_FILES['profile']['size'] > 5000000){
    die("File too large");
}

/* -------- CHECK REAL IMAGE -------- */
if(
    !getimagesize(
        $_FILES['profile']['tmp_name']
    )
){
    die("Not a real image");
}

try{

    /* -------- MOVE IMAGE -------- */
    if(
        move_uploaded_file(
            $_FILES['profile']['tmp_name'],
            $target
        )
    ){
        die("Failed to upload image");
    }

    /* -------- SAVE TO DATABASE -------- */
    $sql = "
    UPDATE users
    SET profile = :profile
    WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(
        ":profile",
        $image_name
    );

    $stmt->bindParam(
        ":id",
        $_SESSION['user_id']
    );

    $stmt->execute();

    header("Location: ../index.php");
    exit();

}
catch(PDOException $e){
    die($e->getMessage());
}